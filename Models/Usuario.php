<?php
    namespace Models; 
    
    class Usuario {
        private $email;
        private $pass;
        private $admin;
        
        public function __construct($email = '', $pass = '', $admin = 0) {
            $this->email = $email;
            $this->pass = $pass;
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

        public function getPass()
        {
            return $this->pass;
        }

       
        public function setPass($pass)
        {
            $this->pass = $pass;
        }

       
        public function getAdmin()
        {
            return $this->admin;
        }


        public function setAdmin($admin)
        {
            $this->admin = $admin;
        }
    }

?>