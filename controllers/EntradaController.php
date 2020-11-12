<?php

      namespace Controllers;
      
      use DAO\PDO\FuncionDAO;
      use DAO\PDO\TarjetaDAO;
      use DAO\PDO\ButacaDAO;
      use DAO\PDO\CompraDAO;
      use DAO\PDO\EntradaDAO;
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
              try {
                 $descuentos = 0;
                 $datosEntrada = $this->funcionDAO->getDatosEntrada($id_funcion);
                 if(($cantidadEntradas >=2) && (date("l")=="Tuesday" || date("l")== "Wednesday")) {
                    $descuentos = (($datosEntrada["valor_entrada"] * 0.25) * $cantidadEntradas);
                 }
                 
                
                $total_a_pagar = ($datosEntrada["valor_entrada"] * $cantidadEntradas)- $descuentos;
                
                require_once(VIEWS_PATH.'realizarCompra.php');
              }catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
              }
               
          }

          public function procesaPago($numeroTarjeta, $nombreTitular, $mes, $anio, $ccv, $butacas, $id_funcion, $valor_entrada) {
            
            $tarjeta = new Tarjeta('',$numeroTarjeta,$nombreTitular,$mes,$anio,$ccv);
            try {
              if(!empty($this->tarjetaDAO->verificaTarjeta($tarjeta))) {
                $_SESSION['Alertmessage'] = "FELICITACIONES! Su compra ha sido Exitosa, a continuacion podra visualizar las entradas, Tambien recibira una copia de las mismas a su mail registrado.";
                $arrButacas = $this->ArmaArrayButacasYguarda($id_funcion, $butacas);
                $descuentoTotal = $this->calcularDescuento($valor_entrada,count($butacas));
                $this->compraDAO->Add(new Compra('',$_SESSION['loggedUser']->getId_usuario(),count($butacas),$descuentoTotal,($valor_entrada*count($butacas)) - $descuentoTotal));
                $arrEntradas = $this->sacaEntradas($id_funcion,count($butacas));
               
                $datosEntrada = $this->funcionDAO->getDatosEntrada($id_funcion);
                $arrAbecedario = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
                $valorEdescuento = $valor_entrada - ($descuentoTotal/count($butacas));
                $this->enviaMail($datosEntrada,$arrButacas,$arrAbecedario,$arrEntradas,$valorEdescuento);
                require_once(VIEWS_PATH.'verMisEntradas.php');
              }else {
              //error, esa tarjeta no es valida
                $_SESSION['Alertmessage'] = "ERROR! tarjeta no valida!";
              
                $this->procesaEntrada($id_funcion,count($butacas),$butacas);
              }
            }
            catch(Exception $ex) {
              $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
          
          }
          
          private function calcularDescuento($valor_entrada, $cantidad_entradas) {
            $descuento_total = 0;
            $dia_actual = date("l");
            if($dia_actual == "Tuesday" || $dia_actual == "Wednesday") {
              $descuentoXentrada = $valor_entrada * 0.25;
              $descuento_total = $descuentoXentrada * $cantidad_entradas;
            }
            return $descuento_total;
           
          }

          private function sacaEntradas($id_funcion,$cantidad) {
            try {
              $ultimoIDcompra = $this->compraDAO->obtenerUltimoId_compra();
              $arrEntradas = array();
              for($x=0; $x<$cantidad; $x++) {
                $qrRandom = uniqid();
                $entrada = new Entrada('',$ultimoIDcompra,$id_funcion,$qrRandom);
                $this->generaQr($qrRandom);
                $this->entradaDAO->Add($entrada);
                
                array_push($arrEntradas,$entrada);
              }
            }
            catch(Exception $ex) {
              $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
            
            return $arrEntradas;
          }
          private function ArmaArrayButacasYguarda($id_funcion,$arrButacas) {
            $arr = array();
            try {
              foreach ($arrButacas as $key => $value) {
                $FilCol = explode("+",$value);
                $butaca = new Butaca();
                $butaca->setId_funcion($id_funcion);
                $butaca->setFila($FilCol[0]);
                $butaca->setColumna($FilCol[1]);
                $this->butacaDAO->Add($butaca);
                array_push($arr,$butaca);   
              }
            }
              catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
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

          public function enviaMail($datosEntrada, $arrButacas, $arrAbecedario, $arrEntradas, $valorEntrada) {
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
                  
                 $mail->Body .= "
                 <table style='border: 8px dashed orange;width: 600px;height: 300px;margin: 15px auto 0px auto;'>
                    <tr>
                      <td style='display:flex;vertical-align:baseline;'>".$value->getQr_code()."</td>
                      <td style='font-size:40px; text-align:center;'>MOVIE PASS</td>
                      <td style='text-align:right;'><img alt='phpMailer' src='cid:".$value->getQr_code()."'></td>
                    </tr>
                    <tr> 
                      <td style='text-align:center;font-size:25px;' colspan='3'>".$datosEntrada["titulo"]."<br>".date("d/m/Y H:i:s", strtotime($datosEntrada["horaYdia"]))."</td>
                    </tr>
                    <tr>
                      <td style='font-size:20px;'><strong>CINE: </strong>".$datosEntrada["nombre"]."<br><strong>SALA: </strong>". $datosEntrada["nombre_sala"]."</td>
                      <td style='text-align:center;font-size:15px;'><strong>BUTACA: </strong>
                      <br>
                       <label>".$strButaca."</label></td>
                      <td style='text-align:right;font-size:45px;'><label>$".$valorEntrada."</label></td>
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