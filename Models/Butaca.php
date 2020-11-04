<?php
    namespace Models;
    use JsonSerializable;

    class Butaca implements JsonSerializable {
        private $id_butaca;
        private $id_sala;
        private $fila;
        private $columna;
       

        public function __construct($id_butaca = '',$id_sala = '',$fila = '',$columna = '') {
           $this->id_butaca = $id_butaca;
           $this->id_sala = $id_sala;
           $this->fila = $fila;
           $this->columna = $columna;
            
        }

           
        public function getId_butaca()
        {
            return $this->id_butaca;
        }

        
        public function setId_butaca($id_butaca)
        {
            $this->id_butaca = $id_butaca;
        }

       
        public function getId_sala()
        {
            return $this->id_sala;
        }

      
        public function setId_sala($id_sala)
        {
            $this->id_sala = $id_sala;
        }

    
        public function getFila()
        {
            return $this->fila;
        }

  
        public function setFila($fila)
        {
            $this->fila = $fila;
        }

        public function getColumna()
        {
            return $this->columna;
        }

        public function setColumna($columna)
        {
            $this->columna = $columna;
        }

        public function jsonSerialize()
        {
            return array(
                 'id_butaca' => $this->id_butaca,
                 'id_sala' => $this->id_sala,
                 'fila' => $this->fila,
                 'columna' => $this->columna
            );
        }

    }

?>