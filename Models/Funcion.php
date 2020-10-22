<?php
    namespace Models;
   
    class Funcion {
        private $id_funcion;
        private $titulo_pelicula;
        private $idioma;
        private $duracion;
        private $fechaYhora;
        
        function __construct($id_funcion = '',$titulo_pelicula = '',$idioma = '', $duracion = '', $fechaYhora = '')
        {  
            $this->id_funcion = $id_funcion;
            $this->titulo_pelicula = $titulo_pelicula;
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
    }

?>