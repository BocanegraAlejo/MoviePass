<?php
      namespace Controllers;
     
      use DAO\FuncionDAO;
      use DAO\TarjetaDAO;
      use DAO\ButacaDAO;
      use Models\Tarjeta;
      use Models\Butaca;
      class EntradaController
      {
         private $funcionDAO;
         private $tarjetaDAO;
         private $butacaDAO;
          public function __construct()
          {
            $this->funcionDAO = new FuncionDAO();
            $this->tarjetaDAO = new TarjetaDAO();
            $this->butacaDAO = new ButacaDAO();
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
              
            }else {
              //error, esa tarjeta no es valida
              
              $_SESSION['Alertmessage'] = "ERROR! tarjeta no valida!";
              
              $this->procesaEntrada($id_funcion,count($butacas),$butacas);
            }
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
          
    }
      


?>