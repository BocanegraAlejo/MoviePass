<?php
      namespace Controllers;

use DAO\FuncionDAO;
use DAO\PeliculaDAO;
use DAO\IdiomaDAO;  
use DAO\Lenguaje_x_peliculaDAO; 
      class PeliculaController
      {
          private $PeliculaDAO;
          private $idiomaDAO;
          private $lenguaje_x_peliculaDAO;
          private $arrGeneros;
          private $cantPaginas;
          private $arrPeliculas;
          private $generoActual;
          private $pagActual;
          private $fecha_ini;
          private $fecha_fin;

          public function __construct()
          {
              
              $this->PeliculaDAO = new PeliculaDAO();
              $this->idiomaDAO = new IdiomaDAO();
              $this->lenguaje_x_peliculaDAO = new Lenguaje_x_peliculaDAO();
              $this->arrGeneros = $this->PeliculaDAO->GetAllGeneros();
              $this->cantPaginas = $this->getCantidadPaginas();
              $this->arrPeliculas = array();
              
             
          }

          public function index() {
            
              //$this->getPeliculasActuales(1);
          }

       

          public function getLenguajesFromPelicula($id_pelicula) {

               $datos =  $this->PeliculaDAO->GetPeliculaByID($id_pelicula);
               $originalLanguage = $datos->{'original_language'};
                $x=0; $flag = 0;

               while($x<count($datos->{'spoken_languages'}) && $flag == 0) {
                   if($originalLanguage == $datos->{'spoken_languages'}[$x]->{'iso_639_1'}) {
                        $flag = 1;
                   }
                   $x++;
               }
               $arrIdiomas = array();
               foreach ($datos->{'spoken_languages'} as $key => $value) {
                   $objectIdioma = $this->idiomaDAO->buscarIdiomaXid($datos->{'spoken_languages'}[$key]->{'iso_639_1'});
                   array_push($arrIdiomas,$objectIdioma);
               }
               if($flag == 0) {
                   $objectIdioma = $this->idiomaDAO->buscarIdiomaXid($datos->{'original_language'});
                   array_push($arrIdiomas,$objectIdioma);
               }
              // print_r($arrIdiomas);
               echo json_encode($arrIdiomas);
               
          }

          public function getPeliculasActualesBTN() {
              $_SESSION['btnPeli'] = 1;
              $this->getPeliculasActuales();
          }
          public function getPeliculasActuales($id_cine = '', $id_sala = '', $page = 1, $genero = '', $fecha_ini = '', $fecha_fin = '')
          {
              
              $this->fecha_ini = $fecha_ini;
              $this->fecha_fin = $fecha_fin;
              $this->generoActual = $genero;
              $this->pagActual = $page;
              $this->cantPaginas = $this->getCantidadPaginas($genero, $fecha_ini, $fecha_fin);
              $this->arrPeliculas = $this->PeliculaDAO->GetAllPeliculasActuales($page, $genero, $fecha_ini, $fecha_fin);
              require_once(VIEWS_PATH."peliculas-listado.php");
          }
          
          private function getCantidadPaginas($genero = '', $fecha_ini = '', $fecha_fin = '') {
              return $this->PeliculaDAO->getCantidadPaginas($genero, $fecha_ini, $fecha_fin);
          }
          

          public function cortarCadena($cadena,$limite) {
                // Si la longitud es mayor que el límite...
                if(strlen($cadena) > $limite){
                    // Entonces corta la cadena y ponle el sufijo
                    return substr($cadena, 0, $limite) . '...';
                }
                
                // Si no, entonces devuelve la cadena normal
                return $cadena;
            }
    }
      


?>