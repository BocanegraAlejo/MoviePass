<?php

      namespace Controllers;
      use Models\Pelicula;
      use DAO\FuncionDAO;
      use DAO\SalaDAO;
      use DAO\PeliculaDAO;
      use DAO\GeneroDAO;
      use DAO\IdiomaDAO;
use DateTime;
use Models\FuncionDB;
      use Models\Funcion;
      use Models\Idioma;
      use helpers\FuncionesUtiles;
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
            $this->salaDAO = new SalaDAO();
            $this->funcionDAO = new FuncionDAO();
            $this->peliculaDAO = new PeliculaDAO();
            $this->generoDAO = new GeneroDAO();
            $this->idiomaDAO = new IdiomaDAO();
            
          }

          public function index() {
            //UsuarioController::verifUserLogueado();
           

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
                $pelicula = new Pelicula($id_pelicula,$peliculaAPI->{'title'},$peliculaAPI->{'overview'},$peliculaAPI->{'genres'}[0]->{'id'}, date("G:i", $peliculaAPI->{'runtime'}),'https://image.tmdb.org/t/p/w500/'.$peliculaAPI->{'poster_path'},$peliculaAPI->{'spoken_languages'}[0]->{'iso_639_1'},$peliculaAPI->{'release_date'});
                $this->peliculaDAO->Add($pelicula);
              }
              
              $diaYhora = $dia." ".$horario;
               
                $funcion = new FuncionDB('', $_SESSION['cineActual'], $_SESSION['salaActual'], $id_pelicula,$diaYhora);
                
                $this->funcionDAO->AddFuncion($funcion);
             
              

              $this->verFuncionOneSala($_SESSION['salaActual']);

          }

          public function buscarFuncionesXdia($id_pelicula, $dia) {
              return $this->funcionDAO->BuscarDiasXPelicula($_SESSION['cineActual'],$id_pelicula,$dia);
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
          
          
          public function BuscarDiasXPelicula($id) {
            return array_column($this->funcionDAO->BuscarDiasXPelicula($_SESSION['cineActual'],$id),0);
          }

          public function BuscarHorariosXdia($dia, $id_pelicula) {
            $pelicula = $this->peliculaDAO->GetPeliculaByID($id_pelicula);
           
            $duracionPelicula = date("i:s", $pelicula->{'runtime'}+15);
            $arrHorarioFuncion = $this->funcionDAO->BuscarHorasOcupadasSala($_SESSION['salaActual'],$dia);
            $arr24horas = $this->cargarArr24Hs();
            $arrdefinitivo = array();
            
            foreach ($arrHorarioFuncion as $key => $valueHorario) {
              
              foreach( $arr24horas as $key => $value24hs ){
                  if((strtotime($this->FuncionRestarHoras($valueHorario->gethora_inicio(),$duracionPelicula)) <  strtotime($value24hs)) && (strtotime($value24hs) < strtotime($valueHorario->getHora_fin()))) //mas15
                  {
                 //   echo "entro al if";
                    
                    unset($arr24horas[$key]);
                  }
                  else {
                      array_push($arrdefinitivo,$value24hs);
                  }
              }
            }
            if(empty($arrHorarioFuncion))
            {
              echo json_encode($arr24horas);
            }
            else {
              echo json_encode($arrdefinitivo);
            }
            
          }

          private function FuncionRestarHoras($horarioInic,$duracionPelicula){
            //echo 'horarioInic:'.$horarioInic;
            //echo '<br>';
            //echo 'duracionPelicula:'. $duracionPelicula;
            //echo '<br>';

              $horarioInic = new DateTime($horarioInic);
              $duracionPelicula = new DateTime($duracionPelicula);
            
              
              $result = $horarioInic->diff($duracionPelicula);
             // echo 'resultado:'.$result->format('%H:%i:%s');
              return $result->format('%H:%i:%s0');
              
          }

          private function cargarArr24Hs() {
            $arr24horas = array();
            $pos = 0;
            for($h=0; $h<24; $h++) {
              for($m=0; $m<60; $m+=5)
              {
                $arr24horas[$pos] = date('H:i:s',strtotime($h.":".$m.':00'));
                $pos++;
              }
            }
            return $arr24horas; 
          }
          
    }
      


?>