<?php
      namespace Controllers;
      use DAO\PeliculaDAO;
      
      class PeliculaController
      {
          private $PeliculaDAO;
  
          public function __construct()
          {
              $this->PeliculaDAO = new PeliculaDAO();
          }
  
          private function mostrarListadoPeliculas()
          {
              require_once(VIEWS_PATH."peliculas-listado.php");
          }
  
          public function ShowListView()
          {
              $studentList = $this->studentDAO->GetAll();
  
              require_once(VIEWS_PATH."student-list.php");
          }
  
        
      }


?>