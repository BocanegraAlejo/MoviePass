<?php
    namespace Controllers;
    use DAO\CineDAO;
    use DAO\FuncionDAO;
    use DAO\PeliculaDAO;

class CarteleraController
    {
        private $arrCines;
        private $cineDAO;
        private $funcionDAO;
        private $peliculaDAO;

        public function __construct()
        {
            UsuarioController::verifUserLogueado();
            $this->cineDAO = new CineDAO();
            $this->funcionDAO = new FuncionDAO();
            $this->peliculaDAO = new PeliculaDAO();
            $this->arrCines = $this->cineDAO->GetAllCines();
        }

        public function index() {
            UsuarioController::verifUserLogueado();
            $this->ShowCartelera();
        }

        public function ShowCartelera() { 
            require_once(VIEWS_PATH.'cartelera_cines.php');
        }

        public function verCarteleraCine($id_cine) {
            $_SESSION['cineActual'] = $id_cine;
            $arrFunciones = $this->funcionDAO->getAll_FuncionconDatosPeli_XCine($id_cine);
            $this->ShowCartelera();
            
        }
        


    }
      


?>