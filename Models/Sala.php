<?php
    namespace Models;

    class Sala{
        private $id_sala;
        private $id_cine;
        private $capacidad;
        private $nombre_sala;

        function __construct($id_sala = '',$id_cine = '',$capacidad = '',$nombre_sala = '')
        {
            $this->id_sala = $id_sala;
            $this->id_cine = $id_cine;
            $this->capacidad = $capacidad;
            $this->nombre_sala = $nombre_sala;
        }


       
        public function getId_sala()
        {
                return $this->id_sala;
        }

        
        public function setId_sala($id_sala)
        {
                $this->id_sala = $id_sala;

        }
 
        public function getId_cine()
        {
                return $this->id_cine;
        }
        
        public function setId_cine($id_cine)
        {
                $this->id_cine = $id_cine;

        }

        public function getCapacidad()
        {
                return $this->capacidad;
        }

       
        public function setCapacidad($capacidad)
        {
                $this->capacidad = $capacidad;

        }

        public function getNombre_sala()
        {
                return $this->nombre_sala;
        }

        
        public function setNombre_sala($nombre_sala)
        {
                $this->nombre_sala = $nombre_sala;

        }
    }



