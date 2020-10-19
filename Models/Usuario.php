<?php
    namespace Models; 
    
    class Usuario {
        private $email;
        private $clave;
        private $nombre;
        private $admin;
        
        public function __construct($email = '', $clave = '', $nombre = '', $admin = 0) {
            $this->email = $email;
            $this->clave = $clave;
            $this->nombre = $nombre;
            $this->admin = $admin;
        }


        public function getEmail()
        {
            return $this->email;
        }

       
        public function setEmail($email)
        {
            $this->email = $email;
        }

        public function getClave()
        {
            return $this->clave;
        }

       
        public function setClave($clave)
        {
            $this->clave = $clave;
        }

       
        public function getAdmin()
        {
            return $this->admin;
        }


        public function setAdmin($admin)
        {
            $this->admin = $admin;
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