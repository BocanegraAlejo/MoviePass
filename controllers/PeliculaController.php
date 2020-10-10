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
  
          public function getPeliculasActuales($page = 1, $genero = '')
          {
              $this->generoActual = $genero;
              $this->cantPaginas = $this->getCantidadPaginas($genero);
              $this->arrPeliculas = $this->PeliculaDAO->GetAllPeliculasActuales($page, $genero);
             
              require_once(VIEWS_PATH."peliculas-listado.php");
          }
          
          private function getCantidadPaginas($genero = '') {
              return $this->PeliculaDAO->getCantidadPaginas($genero);
          }
          
  
      }


?>