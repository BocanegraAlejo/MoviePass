<?php
      namespace Controllers;
      use Models\Pelicula;
      use DAO\FuncionDAO;
      use DAO\SalaDAO;
      use DAO\PeliculaDAO;

      class CarteleraController
      {
          private $salaDAO;
          private $funcionDAO;
          private $peliculaDAO;
          private $arrSalas;
          private $salaActual;
          private $cineActual;

          public function __construct()
          {
            UsuarioController::verifUserLogueado();
            $this->salaDAO = new SalaDAO();
            $this->funcionDAO = new FuncionDAO();
            $this->peliculaDAO = new PeliculaDAO();
          }

          public function index() {
            UsuarioController::verifUserLogueado();
           

          }
          
          public function verCarteleraAllSalas($id_cine = '') {
            $this->cineActual = $id_cine;
            $this->salaActual = "";
            $arrSalas = $this->salaDAO->getAllSalasXcine($id_cine);
            $arrFunciones = $this->funcionDAO->getAllFuncionesXCine($id_cine);
            require_once(VIEWS_PATH.'verCartelera.php');   
            
          }

          public function verCarteleraOneSala($id_cine = '', $id_sala = '') {
            
            if($id_sala == "") {
              $this->verCarteleraAllSalas($id_cine);
            }
            $this->cineActual = $id_cine;
            $this->salaActual = $id_sala;
            $arrSalas = $this->salaDAO->getAllSalasXcine($id_cine);
            $arrFunciones = $this->funcionDAO->getAllFuncionesXsala($id_sala, $id_cine);
            require_once(VIEWS_PATH.'verCartelera.php'); 
            
          }
        
          public function addFuncionToCartelera($id_pelicula,  $id_cine, $id_sala, $dia, $horario) {
             
              $peliculaAPI = $this->peliculaDAO->GetPeliculaByID($id_pelicula);

              
              $pelicula = new Pelicula('',$peliculaAPI->{'title'},$peliculaAPI->{'overview'},$peliculaAPI->{'genres'},$peliculaAPI->{'runtime'},'https://image.tmdb.org/t/p/w500'.$peliculaAPI->{'poster_path'},$peliculaAPI->{'spoken_languages'});
              
              $this->peliculaDAO->Add($pelicula);
              $funcion = new FuncionDB('', $id_cine, $id_sala,$id_pelicula,$dia." ".$horario);


          public function ElimFuncion($id_funcion, $id_cine) {
            $this->funcionDAO->eliminarFuncion($id_funcion);
            $this->verCarteleraAllSalas($id_cine); 
          }

          public function getAllCines() {
              return $this->cineDAO->getAll();
          }


         

          
    }
      


?>