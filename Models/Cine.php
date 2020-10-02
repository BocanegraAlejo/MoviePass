<?php
    namespace models;
    class Cine {
        private $nombre;
        private $capacidadTotal;
        private $direccion;
        private $valorEntrada;

        public function __construct($nombre, $capacidadTotal, $direccion, $valorEntrada) {
            $this->nombre = $nombre;
            $this->capacidadTotal = $capacidadTotal;
            $this->direccion = $direccion;
            $this->valorEntrada = $valorEntrada;
        }
        
    }

?>