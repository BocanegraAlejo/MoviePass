<?php
    namespace Models;
    

    class Compra  {
        private $id_compra;
        private $id_usuario;
        private $cantidad;
        private $descuento;
        private $total;
        private $dia_y_hora;
       

        public function __construct($id_compra, $id_usuario, $cantidad, $descuento, $total) {
            $this->id_compra = $id_compra;
            $this->id_usuario = $id_usuario;
            $this->cantidad = $cantidad;
            $this->descuento = $descuento;
            $this->total = $total;
        }

        

        
        public function getId_compra()
        {
            return $this->id_compra;
        }

     
        public function setId_compra($id_compra)
        {
            $this->id_compra = $id_compra;
        }

        
        public function getId_usuario()
        {
            return $this->id_usuario;
        }

        public function setId_usuario($id_usuario)
        {
            $this->id_usuario = $id_usuario;
        }
     
        public function getCantidad()
        {
            return $this->cantidad;
        }

    
        public function setCantidad($cantidad)
        {
            $this->cantidad = $cantidad;
        }

     
        public function getDescuento()
        {
            return $this->descuento;
        }

   
        public function setDescuento($descuento)
        {
            $this->descuento = $descuento;
        }

        public function getTotal()
        {
            return $this->total;
        }

        public function setTotal($total)
        {
            $this->total = $total;
        }

        public function getDia_y_hora()
        {
            return $this->dia_y_hora;
        }

 
        public function setDia_y_hora($dia_y_hora)
        {
            $this->dia_y_hora = $dia_y_hora;
        }
    }

?>