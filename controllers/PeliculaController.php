<?php
      namespace Controllers;
      use DAO\PeliculaDAO;
      
      class PeliculaController
      {
          private $PeliculaDAO;
          private $arrGeneros;
          private $cantPaginas;
          private $arrPeliculas;
          private $generoActual;
          private $pagActual;
          private $fecha_ini;
          private $fecha_fin;

          public function __construct()
          {
              UsuarioController::verifUserLogueado();
              $this->PeliculaDAO = new PeliculaDAO();
              $this->arrGeneros = $this->PeliculaDAO->GetAllGeneros();
              $this->cantPaginas = $this->getCantidadPaginas();
              $this->arrPeliculas = array();
              
             
          }

          public function index() {
            UsuarioController::verifUserLogueado();
              //$this->getPeliculasActuales(1);
          }
  
          public function getPeliculasActuales($page = 1, $genero = '', $fecha_ini = '', $fecha_fin = '')
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