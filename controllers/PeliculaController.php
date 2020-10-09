<?php
      namespace Controllers;
      use DAO\PeliculaDAO;
      
      class PeliculaController
      {
          private $PeliculaDAO;
          private $arrGeneros;
          private $cantPaginas;
          private $arrPeliculas;
          public function __construct()
          {
              $this->PeliculaDAO = new PeliculaDAO();
              $this->arrGeneros = $this->PeliculaDAO->GetAllGeneros();
              $this->cantPaginas = $this->getCantidadPaginas();
              $this->arrPeliculas = array();
          }

          public function index() {
              $this->getPeliculasActuales(1);
          }
  
          public function getPeliculasActuales($page = 1)
          {
              
              $this->arrPeliculas = $this->PeliculaDAO->GetAllPeliculasActuales($page);
             
              require_once(VIEWS_PATH."peliculas-listado.php");
          }
          
          private function getCantidadPaginas() {
              return $this->PeliculaDAO->getCantidadPaginas();
          }
          
  
          public function peliculasXgenero($genero) {
            $this->arrPeliculas = $this->PeliculaDAO->getAllPeliculasGenero($genero);
            require_once(VIEWS_PATH."peliculas-listado.php");
          }
      }


?>