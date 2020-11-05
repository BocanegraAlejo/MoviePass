<?php
      namespace Controllers;
     
      use DAO\FuncionDAO;
      use DAO\TarjetaDAO;
      use Models\Tarjeta;
    
      class EntradaController
      {
         private $funcionDAO;
         private $tarjetaDAO;
          public function __construct()
          {
            $this->funcionDAO = new FuncionDAO();
            $this->tarjetaDAO = new TarjetaDAO();
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
              
            }else {
              //error, esa tarjeta no es valida
              $_SESSION['Alertmessage'] = "ERROR! tarjeta no valida!";
              require_once(VIEWS_PATH.'realizarCompra.php');
            }
          }
          
          
    }
      


?>