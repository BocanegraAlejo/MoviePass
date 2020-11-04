<?php
    namespace Models;
    use JsonSerializable;

    class Sala implements JsonSerializable{
        private $id_sala;
        private $id_cine;
        private $cant_filas;
        private $cant_columnas;
        private $nombre_sala;

        function __construct($id_sala = '',$id_cine = '',$nombre_sala = '', $cant_filas = '',$cant_columnas = '')
        {
            $this->id_sala = $id_sala;
            $this->id_cine = $id_cine;
            $this->cant_filas = $cant_filas;
            $this->cant_columnas = $cant_columnas;
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

        public function getNombre_sala()
        {
                return $this->nombre_sala;
        }

        
        public function setNombre_sala($nombre_sala)
        {
                $this->nombre_sala = $nombre_sala;

        }

   
        public function getCant_filas()
        {
                return $this->cant_filas;
        }

   
        public function setCant_filas($cant_filas)
        {
                $this->cant_filas = $cant_filas;

        }

        public function getCant_columnas()
        {
                return $this->cant_columnas;
        }

        public function setCant_columnas($cant_columnas)
        {
                $this->cant_columnas = $cant_columnas;
        }

        public function jsonSerialize()
        {
            return array(
                 'id_sala' => $this->id_sala,
                 'id_cine' => $this->id_cine,
                 'cant_filas' => $this->cant_filas,
                 'cant_columnas' => $this->cant_columnas,
                 'nombre_sala' => $this->nombre_sala
            );
        }
    }



