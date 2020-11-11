<?php
    namespace Controllers;
    use DAO\PDO\CineDAO;
    use DAO\PDO\FuncionDAO;
    use DAO\PDO\Genero_x_peliculaDAO;
    use DAO\PDO\PeliculaDAO;
    use DAO\PDO\SalaDAO;
    use DAO\PDO\ButacaDAO;
    use Exception;

class CarteleraController
    {
        private $arrCines;
        private $cineDAO;
        private $funcionDAO;
        private $peliculaDAO;
        private $genero_x_peliculaDAO;
        private $butacaDAO;
        private $salaDAO;
        public function __construct()
        {
            
            $this->cineDAO = new CineDAO();
            $this->funcionDAO = new FuncionDAO();
            $this->peliculaDAO = new PeliculaDAO();
            $this->genero_x_peliculaDAO = new Genero_x_peliculaDAO();
            $this->salaDAO = new SalaDAO();
            $this->butacaDAO = new ButacaDAO();
            $this->arrCines = $this->cineDAO->GetAllCines();
        }

        public function index() {
            
            $this->ShowCartelera();
        }

        public function ShowCartelera() { 
            require_once(VIEWS_PATH.'cartelera_cines.php');
        }

        public function VerUnaFuncionEnCartelera($id_cine, $id_pelicula) {
            try {
                $arrFunciones = $this->funcionDAO->buscaFuncionesXpeliculaEncine($id_cine,$id_pelicula);
                $cine = $this->cineDAO->BuscarId($id_cine);
                $pelicula = $this->peliculaDAO->getOnePelicula($id_pelicula);
                $generosDePeli = implode(", ",$this->genero_x_peliculaDAO->getGenerosOnePelicula($id_pelicula));
                require_once(VIEWS_PATH.'verUnaFuncionEnCartelera.php');
            }
            catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
        }
        
        public function obtenerButacasOcupadas($id_funcion) {
           try {
                $sala = $this->funcionDAO->buscarSalaXid_funcion($id_funcion);
                $ArrButacasOcupadas = $this->butacaDAO->getAllXid_funcion($id_funcion);
                $arrDatos[] = array("sala" => $sala, "arrButacasOcupadas" => $ArrButacasOcupadas);
           }
           catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
           }
            echo json_encode($arrDatos);
        }

        public function verCarteleraCine($id_cine) {
            try {
                $arrFunciones = $this->funcionDAO->getAll_FuncionconDatosPeli_XCine($id_cine);
                $this->ShowCartelera();
            }
            catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
            
            
        }
        


    }
      


?>