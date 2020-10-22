<?php
      namespace Controllers;
      use Models\Pelicula;
      use DAO\FuncionDAO;
      use DAO\SalaDAO;
      use DAO\PeliculaDAO;
      use DAO\GeneroDAO;
      use Models\FuncionDB;
      
      class CarteleraController
      {
          private $salaDAO;
          private $funcionDAO;
          private $peliculaDAO;
          private $generoDAO;
          private $arrSalas;
         

          public function __construct()
          {
            UsuarioController::verifUserLogueado();
            $this->salaDAO = new SalaDAO();
            $this->funcionDAO = new FuncionDAO();
            $this->peliculaDAO = new PeliculaDAO();
            $this->generoDAO = new GeneroDAO();
          }

          public function index() {
            UsuarioController::verifUserLogueado();
           

          }
          
          public function verCarteleraAllSalas($id_cine = '') {
            $_SESSION['cineActual'] = $id_cine;
            $_SESSION['salaActual'] = "";
            $arrSalas = $this->salaDAO->getAllSalasXcine($id_cine);
            $arrFunciones = $this->funcionDAO->getAllFuncionesXCine($id_cine);
            require_once(VIEWS_PATH.'verCartelera.php');   
            
          }

          public function verCarteleraOneSala($id_cine = '', $id_sala = '') {
            
            if($id_sala == "") {
              $this->verCarteleraAllSalas($id_cine);
            }
            $_SESSION['cineActual'] = $id_cine;
            $_SESSION['salaActual'] = $id_sala;
            $arrSalas = $this->salaDAO->getAllSalasXcine($id_cine);
            $arrFunciones = $this->funcionDAO->getAllFuncionesXsala($id_sala, $id_cine);
            require_once(VIEWS_PATH.'verCartelera.php'); 
            
          }
        
          public function addFuncionToCartelera($id_pelicula,  $dia, $horario) {
             
             // $peliculaAPI = $this->peliculaDAO->GetPeliculaByID($id_pelicula);
              $this->generoDAO->PasarAllgenerosToDB();
              //$this->peliculaDAO->obtenerIDXtitulo($peliculaAPI->{'title'});
             // $pelicula = new Pelicula('',$peliculaAPI->{'title'},$peliculaAPI->{'overview'},$peliculaAPI->{'genres'},$peliculaAPI->{'runtime'},'https://image.tmdb.org/t/p/w500'.$peliculaAPI->{'poster_path'},$peliculaAPI->{'spoken_languages'});
              
             // $this->peliculaDAO->Add($pelicula);
              //$funcion = new FuncionDB('', $_SESSION['cineActual'], $_SESSION['salaActual'],$id_pelicula,$dia." ".$horario);

          }

          public function ElimFuncion($id_funcion, $id_cine) {
            $this->funcionDAO->eliminarFuncion($id_funcion);
            $this->verCarteleraAllSalas($id_cine); 
          }

          public function getAllCines() {
              return $this->cineDAO->getAll();
          }


         

          
    }
      


?>