<?php
    namespace Models;

    class HorarioFuncion {
        private $hora_inicio;
        private $hora_fin;
        private $duracion;
       

        public function __construct($hora_inicio = '', $hora_fin = '', $duracion = '')
        {
            $this->hora_inicio = $hora_inicio;
            $this->hora_fin = $hora_fin;
            $this->duracion = $duracion;        
        }

        
        public function gethora_inicio()
        {
            return $this->hora_inicio;
        }

     
        public function sethora_inicio($hora_inicio)
        {
            $this->hora_inicio = $hora_inicio;
        }

        public function getDuracion()
        {
            return $this->duracion;
        }

        public function setDuracion($duracion)
        {
            $this->duracion = $duracion;
        }

        public function getHora_fin()
        {
            return $this->hora_fin;
        }

        public function setHora_fin($hora_fin)
        {
            $this->hora_fin = $hora_fin;
        }
    }

    
?>
