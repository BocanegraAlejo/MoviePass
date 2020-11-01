<?php
    namespace Models;
   
    class Funcion  {
      
        private $id_funcion;
        private $id_pelicula;
        private $titulo_pelicula;
        private $descripcion_pelicula;
        private $fecha_lanzamiento_pelicula;
        private $idioma;
        private $duracion;
        private $fechaYhora;
        
        function __construct($id_funcion = '',$id_pelicula = '', $titulo_pelicula = '', $descripcion_pelicula = '', $fecha_lanzamiento_pelicula = '',$idioma = '', $duracion = '', $fechaYhora = '')
        {  
            $this->id_funcion = $id_funcion;
            $this->id_pelicula = $id_pelicula;
            $this->titulo_pelicula = $titulo_pelicula;
            $this->descripcion_pelicula = $descripcion_pelicula;
            $this->fecha_lanzamiento_pelicula = $fecha_lanzamiento_pelicula;
            $this->idioma = $idioma;
            $this->duracion = $duracion;
            $this->fechaYhora = $fechaYhora;
                       
        }               

        public function getId_funcion()
        {
            return $this->id_funcion;
        }

        
        public function setId_funcion($id_funcion)
        {
            $this->id_funcion = $id_funcion;  
        }

        public function getId_pelicula()
        {
            return $this->id_pelicula;
        }

        
        public function setId_pelicula($id_pelicula)
        {
            $this->id_pelicula = $id_pelicula;  
        }
        public function getTitulo_pelicula()
        {
            return $this->titulo_pelicula;
        }

        public function setTitulo_pelicula($titulo_pelicula)
        {
            $this->titulo_pelicula = $titulo_pelicula;
        }

       
        public function getIdioma()
        {
            return $this->idioma;
        }

     
        public function setIdioma($idioma)
        {
            $this->idioma = $idioma;
        }

        
        public function getDuracion()
        {
                return $this->duracion;
        }

        public function setDuracion($duracion)
        {
                $this->duracion = $duracion;

                return $this;
        }

        public function getFechaYhora()
        {
                return $this->fechaYhora;
        }

        public function setFechaYhora($fechaYhora)
        {
            $this->fechaYhora = $fechaYhora;
        }

        public function getFecha()
        {
            $aux = explode(" ",$this->fechaYhora);
            return $aux[0];
        }

        public function getHora()
        {
            $aux = explode(" ",$this->fechaYhora);
            return $aux[1];
        }

     
        public function getDescripcion_pelicula()
        {
            return $this->descripcion_pelicula;
        }

        public function setDescripcion_pelicula($descripcion_pelicula)
        {
            $this->descripcion_pelicula = $descripcion_pelicula;
        }

        public function getFecha_lanzamiento_pelicula()
        {
            return $this->fecha_lanzamiento_pelicula;
        }

        public function setFecha_lanzamiento_pelicula($fecha_lanzamiento_pelicula)
        {
            $this->fecha_lanzamiento_pelicula = $fecha_lanzamiento_pelicula;
        }
    }

?>