<?php
    namespace Models;

    class Idioma {
        private $id_lenguaje;
        private $nombre;
       

        public function __construct($id_lenguaje = '', $nombre = "")
        {
            $this->id_lenguaje = $id_lenguaje;
            $this->nombre = $nombre;        
        }

    
      
        public function getId_lenguaje()
        {
            return $this->id_lenguaje;
        }

        public function setId_lenguaje($id_lenguaje)
        {
            $this->id_lenguaje = $id_lenguaje;
        }

        public function getNombre()
        {
            return $this->nombre;
        }

        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }
    }

    
?>
