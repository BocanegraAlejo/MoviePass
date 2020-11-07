<?php

      namespace Controllers;
      
      use DAO\FuncionDAO;
      use DAO\TarjetaDAO;
      use DAO\ButacaDAO;
      use DAO\CompraDAO;
      use DAO\EntradaDAO;
      use Models\Tarjeta;
      use Models\Butaca;
      use Models\Compra;
      use models\entrada;
      use QRcode;
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\SMTP;
      use PHPMailer\PHPMailer\Exception;
      

class EntradaController
      {
         private $funcionDAO;
         private $tarjetaDAO;
         private $butacaDAO;
         private $compraDAO;
         private $entradaDAO;
          public function __construct()
          {
            $this->funcionDAO = new FuncionDAO();
            $this->tarjetaDAO = new TarjetaDAO();
            $this->butacaDAO = new ButacaDAO();
            $this->compraDAO = new CompraDAO();
            $this->entradaDAO = new EntradaDAO();
          }

          public function ShowViewVerMisEntradas() {
            
            require_once(VIEWS_PATH.'verMisEntradas.php');
          }
          public function procesaEntrada($id_funcion, $cantidadEntradas, $butacas) 
          {

                $datosEntrada = $this->funcionDAO->getDatosEntrada($id_funcion);
                $total_a_pagar = $datosEntrada["valor_entrada"] * $cantidadEntradas;
                
                require_once(VIEWS_PATH.'realizarCompra.php');
          }

          public function procesaPago($numeroTarjeta, $nombreTitular, $mes, $anio, $ccv, $butacas, $id_funcion, $valor_entrada) {
            
            $tarjeta = new Tarjeta('',$numeroTarjeta,$nombreTitular,$mes,$anio,$ccv);
            if(!empty($this->tarjetaDAO->verificaTarjeta($tarjeta))) {
                $_SESSION['Alertmessage'] = "INGRESO DE TARJETA EXITOSO!";
                $arrButacas = $this->ArmaArrayButacasYguarda($id_funcion, $butacas);
                $this->compraDAO->Add(new Compra('',$_SESSION['loggedUser']->getId_usuario(),count($butacas),0,$valor_entrada*count($butacas)));
                $arrEntradas = $this->sacaEntradas($id_funcion,count($butacas));
                
                $datosEntrada = $this->funcionDAO->getDatosEntrada($id_funcion);
                $arrAbecedario = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
                $this->enviaMail($datosEntrada,$arrButacas,$arrAbecedario,$arrEntradas);
                require_once(VIEWS_PATH.'verMisEntradas.php');
            }else {
              //error, esa tarjeta no es valida
              
              $_SESSION['Alertmessage'] = "ERROR! tarjeta no valida!";
              
              $this->procesaEntrada($id_funcion,count($butacas),$butacas);
            }
          }
          
          private function sacaEntradas($id_funcion,$cantidad) {
            $ultimoIDcompra = $this->compraDAO->obtenerUltimoId_compra();
            $arrEntradas = array();
            for($x=0; $x<$cantidad; $x++) {
              $qrRandom = uniqid();
              $entrada = new Entrada('',$ultimoIDcompra,$id_funcion,$qrRandom);
              $this->generaQr($qrRandom);
              $this->entradaDAO->Add($entrada);
              
              array_push($arrEntradas,$entrada);
            }
            return $arrEntradas;
          }
          private function ArmaArrayButacasYguarda($id_funcion,$arrButacas) {
            $arr = array();
            foreach ($arrButacas as $key => $value) {
              $FilCol = explode("+",$value);
              $butaca = new Butaca();
              $butaca->setId_funcion($id_funcion);
              $butaca->setFila($FilCol[0]);
              $butaca->setColumna($FilCol[1]);
              array_push($arr,$butaca);
              $this->butacaDAO->Add($butaca);
            }
            return $arr;
          }

          public function generaQr($codeqr) {
            //Agregamos la libreria para genera códigos QR
            require_once(ROOT."phpqrcode/qrlib.php");    
            
            //Declaramos una carpeta temporal para guardar la imagenes generadas
            $dir = FRONT_ROOT.'views/img/temp/';
            
            /*Si no existe la carpeta la creamos
            if (!file_exists($dir))
                  mkdir($dir); */
            
                  //Declaramos la ruta y nombre del archivo a generar
            $filename = 'views/img/temp/'.$codeqr.'.png';
          
                  //Parametros de Condiguración
            
            $tamaño = 4; //Tamaño de Pixel
            $level = 'L'; //Precisión Baja
            $framSize = 1; //Tamaño en blanco
            $contenido = $codeqr; //Texto
            
                  //Enviamos los parametros a la Función para generar código QR 
            QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
            
                  //Mostramos la imagen generada
                  
            return $dir.basename($filename);  
           
          }

          public function enviaMail($datosEntrada, $arrButacas, $arrAbecedario, $arrEntradas) {
            require_once(ROOT.'PHPMailer/PHPMailer.php');
            require_once(ROOT.'PHPMailer/SMTP.php');
            require_once(ROOT.'PHPMailer/Exception.php');
           
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'moviepass908@gmail.com';                     // SMTP username
                $mail->Password   = 'MoviePass2000';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; 
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for 
                //Recipients
                $mail->setFrom('moviepass908@gmail.com', 'MoviePass');
                $mail->addAddress($_SESSION['loggedUser']->getEmail(), 'Usuario');     // Add a recipient
                // Content
                
               
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Imprima sus Entradas';
                $mail->Body = "<body>";
                foreach ($arrEntradas as $key => $value) {
                  $strButaca =  $arrAbecedario[$arrButacas[$key]->getFila()]. "  ".$arrButacas[$key]->getColumna();
                  $mail->AddEmbeddedImage(VIEWS_PATH."img/temp/".$value->getQr_code().'.png', $value->getQr_code(), $value->getQr_code().".png");
                  
                 /*<img style='margin-left: 490px;margin-top: -55px;' src='/TP_LabIV/views/img/temp/'".$value->getQr_code()."'.png'>*/
                 $mail->Body .= "
                 <table style='border: 8px dashed orange;width: 600px;height: 300px;margin: 15px auto 0px auto;'>
                    <tr>
                      <td style='display:flex;vertical-align:baseline;'>".$value->getQr_code()."</td>
                      <td style='font-size:40px; text-align:center;'>MOVIE PASS</td>
                      <td style='text-align:right;'><img alt='phpMailer' src='cid:".$value->getQr_code()."'></td>
                    </tr>
                    <tr> 
                      <td style='text-align:center;font-size:25px;' colspan='3'>".$datosEntrada["titulo"]."<br>".$datosEntrada["horaYdia"]."</td>
                    </tr>
                    <tr>
                      <td style='font-size:20px;'><strong>CINE: </strong>".$datosEntrada["nombre"]."<br><strong>SALA: </strong>". $datosEntrada["nombre_sala"]."</td>
                      <td style='text-align:center;font-size:15px;'><strong>BUTACA: </strong>
                      <br>
                       <label>".$strButaca."</label></td>
                      <td style='text-align:right;font-size:45px;'><label>$".$datosEntrada["valor_entrada"]."</label></td>
                    </tr>
                    
                  </table>";
                
              }
                $mail->Body.="</body>";
                $mail->send();
               
            } catch (Exception $e) {
                echo "Error: {$mail->ErrorInfo}";
            }
      }

}
          
    
      


?>