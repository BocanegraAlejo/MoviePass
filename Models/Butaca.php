<?php
    namespace Models;
    use JsonSerializable;

    class Butaca implements JsonSerializable {
        private $id_butaca;
        private $id_funcion;
        private $fila;
        private $columna;
       

        public function __construct($id_butaca = '',$id_funcion = '',$fila = '',$columna = '') {
           $this->id_butaca = $id_butaca;
           $this->id_sala = $id_funcion;
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

       
        public function getId_funcion()
        {
            return $this->id_funcion;
        }

      
        public function setId_funcion($id_funcion)
        {
            $this->id_funcion = $id_funcion;
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