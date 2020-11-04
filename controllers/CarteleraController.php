<?php
    namespace Controllers;
    use DAO\CineDAO;
    use DAO\FuncionDAO;
    use DAO\Genero_x_peliculaDAO;
    use DAO\PeliculaDAO;
    use DAO\SalaDAO;
class CarteleraController
    {
        private $arrCines;
        private $cineDAO;
        private $funcionDAO;
        private $peliculaDAO;
        private $genero_x_peliculaDAO;
        private $salaDAO;
        public function __construct()
        {
            
            $this->cineDAO = new CineDAO();
            $this->funcionDAO = new FuncionDAO();
            $this->peliculaDAO = new PeliculaDAO();
            $this->genero_x_peliculaDAO = new Genero_x_peliculaDAO();
            $this->salaDAO = new SalaDAO();
            $this->arrCines = $this->cineDAO->GetAllCines();
        }

        public function index() {
            
            $this->ShowCartelera();
        }

        public function ShowCartelera() { 
            require_once(VIEWS_PATH.'cartelera_cines.php');
        }

        public function VerUnaFuncionEnCartelera($id_cine, $id_pelicula) {
            $arrFunciones = $this->funcionDAO->buscaFuncionesXpeliculaEncine($id_cine,$id_pelicula);
            $cine = $this->cineDAO->BuscarId($id_cine);
            $pelicula = $this->peliculaDAO->getOnePelicula($id_pelicula);
            $generosDePeli = implode(", ",$this->genero_x_peliculaDAO->getGenerosOnePelicula($id_pelicula));
            
            require_once(VIEWS_PATH.'verUnaFuncionEnCartelera.php');
        }
        
        public function obtenerButacasOcupadas($id_funcion) {
            $Sala = $this->funcionDAO->buscarSalaXid_funcion($id_funcion);
            $ArrButacasOcupadas = DAObutacas->getButacasOcupadas($Sala->id_sala);

            echo json_encode($ArrButacasOcupadas);
        }

        public function verCarteleraCine($id_cine) {
            $arrFunciones = $this->funcionDAO->getAll_FuncionconDatosPeli_XCine($id_cine);
            $this->ShowCartelera();
            
        }
        


    }
      


?>