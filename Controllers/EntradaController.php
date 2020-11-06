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
                $this->ArmaArrayButacasYguarda($id_funcion, $butacas);
                $this->compraDAO->Add(new Compra('',$_SESSION['loggedUser']->getId_usuario(),count($butacas),0,$valor_entrada*count($butacas)));
                $arrEntradas = $this->sacaEntradas($id_funcion,count($butacas));
                $datosEntrada = $this->funcionDAO->getDatosEntrada($id_funcion);
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
              $entrada = new Entrada('',$ultimoIDcompra,$id_funcion,$this->generaQr($qrRandom));
              $this->entradaDAO->Add($entrada);
              
              array_push($arrEntradas,$entrada);
            }
            return $arrEntradas;
          }
          private function ArmaArrayButacasYguarda($id_funcion,$arrButacas) {
            
            foreach ($arrButacas as $key => $value) {
              $FilCol = explode("+",$value);
              $butaca = new Butaca();
              $butaca->setId_funcion($id_funcion);
              $butaca->setFila($FilCol[0]);
              $butaca->setColumna($FilCol[1]);

              $this->butacaDAO->Add($butaca);
            }
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
          
    }
      


?>