<?php
    namespace Models;

    class entrada {
        private $id_entrada;
        private $id_compra;
        private $id_funcion;
        private $qr_code;

        public function __construct($id_entrada, $id_compra, $id_funcion, $qr_code) {
            $this->id_entrada = $id_entrada;
            $this->id_compra = $id_compra;
            $this->id_funcion = $id_funcion;
            $this->qr_code = $qr_code;
        }

        public function getId_entrada()
        {
                return $this->id_entrada;
        }

        public function setId_entrada($id_entrada)
        {
                $this->id_entrada = $id_entrada;

                return $this;
        }

        public function getId_compra()
        {
                return $this->id_compra;
        }

        public function setId_compra($id_compra)
        {
                $this->id_compra = $id_compra;

                return $this;
        }

        public function getId_funcion()
        {
                return $this->id_funcion;
        }

        public function setId_funcion($id_funcion)
        {
                $this->id_funcion = $id_funcion;

                return $this;
        }

        public function getQr_code()
        {
                return $this->qr_code;
        }

        public function setQr_code($qr_code)
        {
            $this->qr_code = $qr_code;
        }
    }


?>