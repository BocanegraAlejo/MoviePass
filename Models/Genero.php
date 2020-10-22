<?php
    namespace Models;

    class Genero {
        private $id_genero;
        private $nombre;
       

        public function __construct($id_genero = '', $nombre = "")
        {
            $this->id_genero = $id_genero;
            $this->nombre = $nombre;        
        }

    
        public function getId_genero()
        {
            return $this->id_genero;
        }

        public function setId_genero($id_genero)
        {
            $this->id_genero = $id_genero;
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
