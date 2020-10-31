<?php

      namespace Controllers;
      use Models\Pelicula;
      use DAO\FuncionDAO;
      use DAO\SalaDAO;
      use DAO\PeliculaDAO;
      use DAO\GeneroDAO;
      use DAO\IdiomaDAO;
      use DAO\Lenguaje_x_peliculaDAO;
      use Models\FuncionDB;
      use DateTime;
class FuncionController
      {
          private $salaDAO;
          private $funcionDAO;
          private $peliculaDAO;
          private $generoDAO;
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
            $arrFunciones = $this->funcionDAO->getAllFuncionesXsala($id_sala);
            
            require_once(VIEWS_PATH.'verCartelera.php'); 
            
          }
        
          public function addFuncionToCartelera($id_pelicula,  $dia, $horario, $idioma) {
           
              $peliculaAPI = $this->peliculaDAO->GetPeliculaByID($id_pelicula);
              $objectPeli = $this->peliculaDAO->buscarPelicula($id_pelicula);
              if(empty($objectPeli)) {
                $pelicula = new Pelicula($id_pelicula,$peliculaAPI->{'title'},$peliculaAPI->{'overview'},date("G:i", $peliculaAPI->{'runtime'}),'https://image.tmdb.org/t/p/w500/'.$peliculaAPI->{'poster_path'},$peliculaAPI->{'release_date'});
                $this->peliculaDAO->Add($pelicula);
                $this->AddIdiomasByIDPelicula($id_pelicula);
                
              }
              
              $diaYhora = $dia." ".$horario;
               
                $funcion = new FuncionDB('', $_SESSION['salaActual'], $idioma, $id_pelicula,$diaYhora);
                $this->funcionDAO->AddFuncion($funcion);
              $this->verFuncionOneSala($_SESSION['salaActual']);

          }


          private function AddIdiomasByIDPelicula($id_pelicula) {
              $arrIdiomas = $this->peliculaDAO->GetIdiomasByIDpelicula($id_pelicula);
              foreach ($arrIdiomas as $key => $value) {
                  $this->lenguaje_x_peliculaDAO->add($value,$id_pelicula);
              }
          }


          public function buscarFuncionesXdia($id_pelicula, $dia) {
              return $this->funcionDAO->BuscarDiasXPelicula($_SESSION['cineActual'],$id_pelicula,$dia);
          }


          public function modificaFuncion($id_funcion) {
            $resultado = $this->funcionDAO->BuscarFuncionXid($id_funcion);
            if(!empty($resultado))
            {
                $ObjectFuncion = new FuncionDB($resultado['id_funcion'],$resultado['id_sala'],$resultado['id_pelicula'],$resultado['horaYdia']);
            }
            return $ObjectFuncion;
        }
        
        public function ModificarFuncion2($id_funcion,$fecha, $hora) {
            $ObjectFuncion = new FuncionDB($id_funcion,'','',$fecha." ".$hora);
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