<?php
    namespace Controllers;
    use DAO\CineDAO;
    use DAO\FuncionDAO;
use DAO\Genero_x_peliculaDAO;
use DAO\PeliculaDAO;

class CarteleraController
    {
        private $arrCines;
        private $cineDAO;
        private $funcionDAO;
        private $peliculaDAO;
        private $genero_x_peliculaDAO;
        public function __construct()
        {
            
            $this->cineDAO = new CineDAO();
            $this->funcionDAO = new FuncionDAO();
            $this->peliculaDAO = new PeliculaDAO();
            $this->genero_x_peliculaDAO = new Genero_x_peliculaDAO();
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
        
        public function verCarteleraCine($id_cine) {
            $_SESSION['cineActual'] = $id_cine;
            $arrFunciones = $this->funcionDAO->getAll_FuncionconDatosPeli_XCine($id_cine);
            $this->ShowCartelera();
            
        }
        


    }
      


?>