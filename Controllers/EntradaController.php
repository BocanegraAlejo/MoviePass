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
                $this->sacaEntradas($id_funcion,count($butacas));
                require_once(VIEWS_PATH.'verMisEntradas.php');
            }else {
              //error, esa tarjeta no es valida
              
              $_SESSION['Alertmessage'] = "ERROR! tarjeta no valida!";
              
              $this->procesaEntrada($id_funcion,count($butacas),$butacas);
            }
          }
          
          private function sacaEntradas($id_funcion,$cantidad) {
            $ultimoIDcompra = $this->compraDAO->obtenerUltimoId_compra();
            for($x=0; $x<$cantidad; $x++) {
              $qrRandom = uniqid();
              $this->entradaDAO->Add(new Entrada('',$ultimoIDcompra,$id_funcion,$qrRandom));
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