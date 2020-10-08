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

          public function index() {
              $this->getPeliculasActuales();
          }
  
          public function getPeliculasActuales()
          {
              $arrPeliculas = $this->PeliculaDAO->GetAllPeliculasActuales();
              require_once(VIEWS_PATH."peliculas-listado.php");
              return $arrPeliculas;
          }
  
          public function ShowListView()
          {
              $studentList = $this->studentDAO->GetAll();

              require_once(VIEWS_PATH."student-list.php");
          }
  
        
      }


?>