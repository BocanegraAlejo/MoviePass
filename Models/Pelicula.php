<?php
    namespace Models;

    class Pelicula {
        private $id_pelicula;
        private $titulo;
        private $descripcion;
        private $duracion;
        private $imagen;
        private $fecha;
        private $adultos;
        private $trailer;
        private $vote_average;

        public function __construct($id_pelicula = '',$titulo = '',$descripcion = '', $duracion = "", $imagen = '', $fecha = '', $adultos = '', $trailer = '', $vote_average = '')
        {
            $this->id_pelicula = $id_pelicula;
            $this->titulo = $titulo;  
            $this->descripcion = $descripcion; 
            $this->duracion = $duracion;
            $this->imagen = $imagen;
            $this->fecha = $fecha;
            $this->adultos = $adultos;
            $this->trailer = $trailer;
            $this->vote_average = $vote_average;
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
        

         
        public function getFecha()
        {
                return $this->fecha;
        }

        
        public function setFecha($fecha)
        {
                $this->fecha = $fecha;
           
        }

         

        public function getAdultos()
        {
                return $this->adultos;
        }

        public function setAdultos($adultos)
        {
                $this->adultos = $adultos;
        }

   
        public function getTrailer()
        {
                return $this->trailer;
        }

     
        public function setTrailer($trailer)
        {
                $this->trailer = $trailer;
        }

    
        public function getVote_average()
        {
                return $this->vote_average;
        }

        public function setVote_average($vote_average)
        {
                $this->vote_average = $vote_average;
        }
    }

    
?>


