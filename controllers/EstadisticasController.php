<?php
    namespace Controllers;
    use DAO\PDO\CineDAO;
    use DAO\PDO\CompraDAO;
    use DAO\PDO\FuncionDAO;
    use Exception;

class EstadisticasController
    {
        private $cineDAO;
        private $compraDAO;
        private $entradaDAO;
        private $funcionDAO;
        private $arrCines;
        private $cineActual;
        private $fecha_ini;
        private $fecha_fin;
        public function __construct()
        {
            $this->cineDAO = new CineDAO();
            $this->compraDAO = new CompraDAO();
            $this->funcionDAO = new FuncionDAO();
            $this->arrCines = $this->cineDAO->GetAll($_SESSION['loggedUser']->getId_usuario());
            
        }

        public function index() {
            
            $this->calculaEstadisticas();
        }

        public function calculaEstadisticas($id_cine = '', $fecha_ini = '2019-01-01', $fecha_fin = '2022-01-01') {
            $this->cineActual = $id_cine;
            $this->fecha_ini = $fecha_ini;
            $this->fecha_fin = $fecha_fin;
            $Total_cantPeliculas = 0;
            $Total_cantTicketsVendidos = 0;
            $Total_cantidadTicketsRemanentes = 0;
            $Total_totalButacas = 0;
            $Total_cantFunciones = 0;
            $Total_dineroRecaudado = 0;
            try {
                if($id_cine == "") {
                    $estadisticas =  $this->funcionDAO->calcularEstadisticasAllCinesUser($_SESSION['loggedUser']->getId_usuario(), $fecha_ini, $fecha_fin);
                 }
                 else {
                     $estadisticas = $this->funcionDAO->calcularEstadisticasXcine($id_cine, $fecha_ini, $fecha_fin);
                 }
                
                 require_once(VIEWS_PATH.'estadisticas.php');
            }
            catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
           
        }
       
        


    }
      

?>