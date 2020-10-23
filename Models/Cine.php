<?php
    namespace Models;

    class Cine {
        private $id_cine;
        private $id_usuario;
        private $nombre;
        private $direccion;
        private $horario_apertura;
        private $horario_cierre;
        private $capacidadTotal;
        private $valorEntrada;

        public function __construct($id_cine = '',$id_usuario = '', $nombre = '',$direccion = '', $horario_apertura = '', $horario_cierre = '',  $valorEntrada = '', $capacidadTotal = '') {
            $this->id_cine = $id_cine;
            $this->id_usuario = $id_usuario;
            $this->nombre = $nombre;
            $this->direccion = $direccion;
            $this->horario_apertura = $horario_apertura;
            $this->horario_cierre = $horario_cierre;
            $this->valorEntrada = $valorEntrada;
            $this->capacidadTotal = $capacidadTotal;
            
        }

           
        public function getNombre()
        {
            return $this->nombre;
        }

       
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }

     
        public function getDireccion()
        {
            return $this->direccion;
        }

        
        public function setDireccion($direccion)
        {
            $this->direccion = $direccion;
        }

     
        public function getHorario_apertura()
        {
            return $this->horario_apertura;
        }

       
        public function setHorario_apertura($horario_apertura)
        {
            $this->horario_apertura = $horario_apertura;
        }

        
        public function getHorario_cierre()
        {
            return $this->horario_cierre;
        }

        
        public function setHorario_cierre($horario_cierre)
        {
            $this->horario_cierre = $horario_cierre;
        }

       
        public function getCapacidadTotal()
        {
            return $this->capacidadTotal;
        }

        public function setCapacidadTotal($capacidadTotal)
        {
            $this->capacidadTotal = $capacidadTotal;
        }

        public function getValorEntrada()
        {
            return $this->valorEntrada;
        }

        public function setValorEntrada($valorEntrada)
        {
            $this->valorEntrada = $valorEntrada;
        }

     
        public function getId()
        {
            return $this->id_cine;
        }

        public function setId($id_cine)
        {
            $this->id_cine = $id_cine;
        }

        public function getId_usuario()
        {
            return $this->id_usuario;
        }

        public function setId_usuario($id_usuario)
        {
            $this->id_usuario = $id_usuario;
        }
    }

?>