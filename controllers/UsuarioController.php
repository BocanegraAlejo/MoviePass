<?php
    namespace Controllers;
    use Models\Usuario;
    use DAO\UsuarioDAO;

    class UsuarioController {
        private $UsuarioDAO;
    
        public function __construct()
        {
            $this->UsuarioDAO = new UsuarioDAO();
        }

        public function ShowLoginView()
        {
            require_once(VIEWS_PATH."login.php");
        }

        public function loguear($email, $pass) {
            echo $email;
            echo $pass;
            
        }

        
        public function Add($recordId, $firstName, $lastName)
        {
            
        }
    }
    

?>