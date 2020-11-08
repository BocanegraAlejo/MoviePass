<?php

      namespace Controllers;
      use Models\Pelicula;
      use DAO\PDO\FuncionDAO;
      use DAO\PDO\SalaDAO;
      use DAO\PDO\PeliculaDAO;
      use DAO\PDO\GeneroDAO;
      use DAO\PDO\IdiomaDAO;
      use DAO\PDO\Lenguaje_x_peliculaDAO;
      use DAO\PDO\Genero_x_peliculaDAO;
      use Models\FuncionDB;
      use DateTime;
use Exception;

class FuncionController
      {
          private $salaDAO;
          private $funcionDAO;
          private $peliculaDAO;
          private $generoDAO;
          private $genero_x_peliculaDAO;
          private $idiomaDAO;
          private $lenguaje_x_peliculaDAO;
          private $arrSalas;

          public function __construct()
          {
            $this->salaDAO = new SalaDAO();
            $this->funcionDAO = new FuncionDAO();
            $this->peliculaDAO = new PeliculaDAO();
            $this->generoDAO = new GeneroDAO();
            $this->idiomaDAO = new IdiomaDAO();
            $this->lenguaje_x_peliculaDAO = new Lenguaje_x_peliculaDAO();
            $this->genero_x_peliculaDAO = new Genero_x_peliculaDAO();
          }

          public function index() {
            //UsuarioController::verifUserLogueado();
           

          }
          
          public function verFuncionAllSalas($id_cine = '', $id_sala = '') {
            try {
              $arrSalas = $this->salaDAO->getAllSalasXcine($id_cine);
              $arrFunciones = $this->funcionDAO->getAllFuncionesXCine($id_cine);
              require_once(VIEWS_PATH.'verCartelera.php');   
            }
            catch(Exception $ex) {
              $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
           
            
          }

          public function verFuncionOneSala($id_cine = '', $id_sala = '') {
            
            if($id_sala == "") {
              $this->verFuncionAllSalas($id_cine, $id_sala);
            }
            try {
              $arrSalas = $this->salaDAO->getAllSalasXcine($id_cine);
            
              $arrFunciones = $this->funcionDAO->getAllFuncionesXsala($id_sala);
            
              require_once(VIEWS_PATH.'verCartelera.php'); 
            }
            catch(Exception $ex) {
              $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
            
            
          }

          public function buscarLenguajesXidPelicula($id_pelicula) {
            try {
              return $this->lenguaje_x_peliculaDAO->buscarLenguajesXidPelicula($id_pelicula);
            }
            catch(Exception $ex) {
              $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
            
        }
        
          public function addFuncionToCartelera($id_cine, $id_sala, $id_pelicula,  $dia, $horario, $idioma) {
            try {
              $peliculaAPI = $this->peliculaDAO->GetPeliculaByID($id_pelicula);
              
              $objectPeli = $this->peliculaDAO->buscarPelicula($id_pelicula);
              
              if(empty($objectPeli)) {
                if(empty($peliculaAPI->{'videos'}->{'results'}[0]->{'key'})) {
                  $trailer = '';
                } else {
                  $trailer = $peliculaAPI->{'videos'}->{'results'}[0]->{'key'};
                }
                $pelicula = new Pelicula($id_pelicula,$peliculaAPI->{'title'},$peliculaAPI->{'overview'},date("i:s", $peliculaAPI->{'runtime'}),'https://image.tmdb.org/t/p/w400/'.$peliculaAPI->{'poster_path'},$peliculaAPI->{'release_date'},$peliculaAPI->{'adult'},$trailer,$peliculaAPI->{'vote_average'});
                $this->peliculaDAO->Add($pelicula);
                $this->AddIdiomasByIDPelicula($id_pelicula);
                $this->AddGenerosByIDPelicula($id_pelicula,$peliculaAPI->{'genres'});
                
              }
              $dia =  date("Y-d-m", strtotime($dia));
              $diaYhora = $dia." ".$horario;
               var_dump($diaYhora);
                $funcion = new FuncionDB('', $id_sala, $idioma, $id_pelicula,$diaYhora);
                $this->funcionDAO->AddFuncion($funcion);
                $this->verFuncionOneSala($id_cine, $id_sala);
            }catch(Exception $ex) {
              $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
          }

          private function AddGenerosByIDPelicula($id_pelicula, $generos) {
            try {
              foreach ($generos as $key => $value) {
                $this->genero_x_peliculaDAO->add($value->{'id'}, $id_pelicula);
              }
            }
            catch(Exception $ex) {
              $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
              
          }
          private function AddIdiomasByIDPelicula($id_pelicula) {
            try {
              $arrIdiomas = $this->peliculaDAO->GetIdiomasByIDpelicula($id_pelicula);
              foreach ($arrIdiomas as $key => $value) {
                  $this->lenguaje_x_peliculaDAO->add($value,$id_pelicula);
              }
            }
            catch(Exception $ex) {
              $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
              
          }
          
          public function modificaFuncion($id_funcion) {
            try {
              $ObjectFuncion = $this->funcionDAO->BuscarFuncionXid($id_funcion);
              if(!empty($ObjectFuncion))
              {
                  return $ObjectFuncion;
              }
              
            }
            catch(Exception $ex) {
              $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
        }
        
        public function ModificarFuncion2($id_cine, $id_sala, $id_funcion,$fecha, $hora, $idioma) {
          
            $diaYhora = $fecha." ".$hora;
            try {
              $ObjectFuncion = new FuncionDB($id_funcion,'',$idioma,'',$diaYhora);
              $this->funcionDAO->ModificarFuncion($ObjectFuncion);
              $this->verFuncionOneSala($id_cine, $id_sala);
            }
            catch(Exception $ex) {
              $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
            
        }


          public function ElimFuncion($id_cine, $id_sala, $id_funcion) {
            try {
               $this->funcionDAO->eliminarFuncion($id_funcion);
              $this->verFuncionOneSala($id_cine,$id_sala); 
            }
            catch(Exception $ex) {
              $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
           
          }

          public function getAllCines() {
              try {return $this->cineDAO->getAll(); } 
              catch(Exception $ex) { $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}"; }
          }
          
        
          public function BuscarDiasXPelicula($id_cine, $id_pelicula) {
            try {
              $arr = array();
              $arrDias =  array_column($this->funcionDAO->BuscarDiasXPelicula($id_cine,$id_pelicula),0);
              foreach ($arrDias as $key => $value) {
                $fech = date("d/m/Y", strtotime($value));
                array_push($arr,$fech);
              }
              
              echo json_encode($arr);
            }catch(Exception $ex) {
              $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
          }

          
          public function BuscarHorariosXdia($id_sala, $dia, $id_pelicula) {
            
            try {
              $pelicula = $this->peliculaDAO->GetPeliculaByID($id_pelicula);
           
            $duracionPelicula = date("i:s", $pelicula->{'runtime'}+15);
            $arrHorarioFuncion = $this->funcionDAO->BuscarHorasOcupadasSala($id_sala,$dia);
           
            $arr24horas = $this->cargarArr24Hs();
            $arrdefinitivo = array();
            
            foreach ($arrHorarioFuncion as $key => $valueHorario) {
              
              foreach( $arr24horas as $key => $value24hs ){
                  if((strtotime($this->FuncionRestarHoras($valueHorario->gethora_inicio(),$duracionPelicula)) <  strtotime($value24hs)) && (strtotime($value24hs) < strtotime($valueHorario->getHora_fin()))) //mas15
                  {
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
            catch(Exception $ex) {
              $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            } 
          }

          private function FuncionRestarHoras($horarioInic,$duracionPelicula){

              $horarioInic = new DateTime($horarioInic);
              $duracionPelicula = new DateTime($duracionPelicula);
              $result = $horarioInic->diff($duracionPelicula);
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