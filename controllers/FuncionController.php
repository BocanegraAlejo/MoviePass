<?php
      namespace Controllers;
      use Models\Pelicula;
      use DAO\FuncionDAO;
      use DAO\SalaDAO;
      use DAO\PeliculaDAO;
      use DAO\GeneroDAO;
      use DAO\IdiomaDAO;
      use Models\FuncionDB;
      use Models\Funcion;
    use Models\Idioma;

class FuncionController
      {
          private $salaDAO;
          private $funcionDAO;
          private $peliculaDAO;
          private $generoDAO;
          private $idiomaDAO;
          private $arrSalas;
         

          public function __construct()
          {
            UsuarioController::verifUserLogueado();
            $this->salaDAO = new SalaDAO();
            $this->funcionDAO = new FuncionDAO();
            $this->peliculaDAO = new PeliculaDAO();
            $this->generoDAO = new GeneroDAO();
            $this->idiomaDAO = new IdiomaDAO();
          }

          public function index() {
            UsuarioController::verifUserLogueado();
           

          }
          
          public function verFuncionAllSalas($id_cine = '') {
            $_SESSION['cineActual'] = $id_cine;
            $_SESSION['salaActual'] = "";
            $arrSalas = $this->salaDAO->getAllSalasXcine($id_cine);
            $arrFunciones = $this->funcionDAO->getAllFuncionesXCine($id_cine);
            require_once(VIEWS_PATH.'verCartelera.php');   
            
          }

          public function verFuncionOneSala($id_sala = '') {
            
            if($id_sala == "") {
              $this->verFuncionAllSalas($_SESSION['cineActual']);
            }
            $_SESSION['salaActual'] = $id_sala;
            
            $arrSalas = $this->salaDAO->getAllSalasXcine($_SESSION['cineActual']);
            $arrFunciones = $this->funcionDAO->getAllFuncionesXsala($id_sala, $_SESSION['cineActual']);
            require_once(VIEWS_PATH.'verCartelera.php'); 
            
          }
        
          public function addFuncionToCartelera($id_pelicula,  $dia, $horario) {
             
              $peliculaAPI = $this->peliculaDAO->GetPeliculaByID($id_pelicula);
              //$this->generoDAO->PasarAllgenerosToDB();
              $objectPeli = $this->peliculaDAO->buscarPelicula($id_pelicula);
              if(empty($objectPeli)) {
                if(empty($this->idiomaDAO->buscarIdiomaXid($peliculaAPI->{'spoken_languages'}[0]->{'iso_639_1'}))) {
                  $tempIdioma = new Idioma($peliculaAPI->{'spoken_languages'}[0]->{'iso_639_1'},$peliculaAPI->{'spoken_languages'}[0]->{'name'});
                  $this->idiomaDAO->Add($tempIdioma);
                }
              
                $pelicula = new Pelicula($id_pelicula,$peliculaAPI->{'title'},$peliculaAPI->{'overview'},$peliculaAPI->{'genres'}[0]->{'id'},$peliculaAPI->{'runtime'},'https://image.tmdb.org/t/p/w500'.$peliculaAPI->{'poster_path'},$peliculaAPI->{'spoken_languages'}[0]->{'iso_639_1'},$peliculaAPI->{'release_date'});
                $this->peliculaDAO->Add($pelicula);
              }
              
              $diaYhora = $dia." ".$horario;
              $funcion = new FuncionDB('', $_SESSION['cineActual'], $_SESSION['salaActual'], $id_pelicula,$diaYhora);
              $this->funcionDAO->AddFuncion($funcion);

              $this->verFuncionOneSala($_SESSION['salaActual']);

          }

          public function modificaFuncion($id_funcion) {
            $resultado = $this->funcionDAO->BuscarFuncionXid($id_funcion);
            if(!empty($resultado))
            {
                $ObjectFuncion = new FuncionDB($resultado['id_funcion'],$resultado['id_cine'],$resultado['id_sala'],$resultado['id_pelicula'],$resultado['horaYdia']);
            }
            return $ObjectFuncion;
        }
        
        public function ModificarFuncion2($id_funcion,$fecha, $hora) {
            $ObjectFuncion = new FuncionDB($id_funcion,'','','',$fecha." ".$hora);
            $this->funcionDAO->ModificarFuncion($ObjectFuncion);
            $this->verFuncionOneSala($_SESSION['salaActual']);
           
        }

          public function ElimFuncion($id_funcion) {
            $this->funcionDAO->eliminarFuncion($id_funcion);
            $this->verFuncionAllSalas($_SESSION['cineActual']); 
          }

          public function getAllCines() {
              return $this->cineDAO->getAll();
          }
          
    }
      


?>