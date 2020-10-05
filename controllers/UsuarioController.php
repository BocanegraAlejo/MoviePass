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
            $userAux = $this->verifExistenciaUser($email, $pass);
            if($userAux != null)
            {
                $_SESSION['loggedUser'] = $userAux;
                if($userAux->getAdmin() == 1) {
                    require_once(VIEWS_PATH."dashboardAdmin.php");
                }else {
                    require_once(VIEWS_PATH."dashboard.php");
                }
            }
            else {
                echo "<script>alert('ERROR! USUARIO Y/O CLAVE INCORRECTOS')</script>";
                $this->ShowLoginView();
            }
           
        }

        
       private function verifExistenciaUser($email, $pass) {
           
            $arrUsuarios = $this->UsuarioDAO->GetAll();
            foreach ($arrUsuarios as $value) {
                if($value->getEmail() == $email && $value->getPass() == $pass)
                {
                    return $value;
                }
                else
                {
                    return null;
                }
            }
       }
    }
    

?>