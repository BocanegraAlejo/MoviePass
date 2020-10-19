<?php
    namespace Models;

    class Pelicula {
        private $id_pelicula;
        private $titulo;
        private $descripcion;
        private $genero;
        private $duracion;
        private $imagen;
        private $lenguaje;
        private $fecha;

        public function __construct($id_pelicula = '', $duracion = "", $imagen = '', $lenguaje = '', $titulo = '', $descripcion = '', $genero = '', $fecha = '')
        {
            $this->id_peliculas = $id_pelicula;
            $this->duracion = $duracion;
            $this->imagen = $imagen;
            $this->lenguaje = $lenguaje;
            $this->titulo = $titulo;
            $this->descripcion = $descripcion;
            $this->genero = $genero;
            $this->fecha = $fecha;
        }


       
        public function getId_pelicula()
        {
                return $this->id_pelicula;
        }

        
        public function setId_peliculas($id_pelicula)
        {
                $this->id_peliculas = $id_pelicula;

        }

       
        public function getDuracion()
        {
                return $this->duracion;
        }

       
        public function setDuracion($duracion)
        {
                $this->duracion = $duracion;
         
        }

        
        public function getImagen()
        {
                return $this->imagen;
        }

       
        public function setImagen($imagen)
        {
                $this->imagen = $imagen;

        }

       
        public function getLenguaje()
        {
                return $this->lenguaje;
        }

       
        public function setLenguaje($lenguaje)
        {
                $this->lenguaje = $lenguaje;
               
        }

        
        public function getTitulo()
        {
                return $this->titulo;
        }

       
        public function setTitulo($titulo)
        {
                $this->titulo = $titulo;
                
        }        

        public function getDescripcion()
        {
                return $this->descripcion;
        }

       
        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;
              
        }
        
        public function getGenero()
        {
                return $this->genero;
        }

        
        public function setGenero($genero)
        {
                $this->genero = $genero;
                
        }

         
        public function getFecha()
        {
                return $this->fecha;
        }

        
        public function setFecha($fecha)
        {
                $this->fecha = $fecha;
           
        }

         
       
    }

    
?>


