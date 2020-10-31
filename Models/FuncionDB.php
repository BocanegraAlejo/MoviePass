<?php
    namespace Models;
   
    class FuncionDB {
        private $id_funcion;    
        private $id_sala;
        private $id_idioma;
        private $id_pelicula;
        private $horaYdia;
       
        

        function __construct($id_funcion = '',$id_sala = '', $id_idioma, $id_pelicula = '', $horaYdia = '')
        {  
            $this->id_funcion = $id_funcion;
            $this->id_sala = $id_sala;
            $this->id_idioma = $id_idioma;
            $this->id_pelicula = $id_pelicula;
            $this->horaYdia = $horaYdia;
                       
        }               

       
        public function getId_funcion()
        {
                return $this->id_funcion;
        }

        
        public function setId_funcion($id_funcion)
        {
                $this->id_funcion = $id_funcion;
               
        }

         
        public function getId_sala()
        {
                return $this->id_sala;
        }

       
        public function setId_sala($id_sala)
        {
                $this->id_sala = $id_sala;
              
        }

         
        public function getId_pelicula()
        {
                return $this->id_pelicula;
        }

        
        public function setId_pelicula($id_pelicula)
        {
                $this->id_pelicula = $id_pelicula;
               
        }
 
        public function gethoraYdia()
        {
                return $this->horaYdia;
        }

       
        public function sethoraYdia($horaYdia)
        {
                $this->horaYdia = $horaYdia;
               
        }

        public function getFecha()
        {
            $aux = explode(" ",$this->horaYdia);
            return $aux[0];
        }

        public function getHora()
        {
            $aux = explode(" ",$this->horaYdia);
            return $aux[1];
        }

        public function getId_idioma()
        {
                return $this->id_idioma;
        }

        public function setId_idioma($id_idioma)
        {
                $this->id_idioma = $id_idioma;
        }
    }

?>