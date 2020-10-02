<?php
    namespace Models; 
    
    class Usuario {
        private $email;
        private $pass;

        public function __construct($email, $pass) {
            $this->email = $email;
            $this->pass = $pass;
        }


    }

?>