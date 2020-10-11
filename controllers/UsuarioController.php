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

        public function Index($message = "")
        {
            UsuarioController::verifUserLogueado();
            
        }   
        
        public function ShowLoginView()
        {
            require_once(VIEWS_PATH."login.php");
        }

        public function ShowDashboard() {
            require_once(VIEWS_PATH."dashboard.php");
        }
        public function ShowRegisterView()
        {
            require_once(VIEWS_PATH."registrarUser.php");
        }

        public function loguear($email = '', $pass = '') {
            $userAux = $this->UsuarioDAO->verifExistenciaUser($email, $pass);
           
            if(!empty($userAux) && $userAux[0]['clave'] == $pass)
            {
                $userObject = new Usuario($userAux[0]['email'],$userAux[0]['clave'], $userAux[0]['admin']);
                $_SESSION['loggedUser'] = $userObject;
                require_once(VIEWS_PATH."dashboard.php");
                
            }
            else {
                
                echo "<script>alert('ERROR! USUARIO Y/O CLAVE INCORRECTOS')</script>";
                $this->ShowLoginView();
            }
        }

        public function destroySession() {
            session_destroy();
            $this->ShowLoginView();
        }



        //  ### VERIFICA SI USUARIO ESTA LOGUEADO ### 
        public static function verifUserLogueado() {
            if(isset($_SESSION['loggedUser'])) {
                if($_SESSION['loggedUser']->getAdmin()==1) {
                    require_once(VIEWS_PATH."navAdmin.php");
                }
                else {
                    require_once(VIEWS_PATH."nav.php");
                }
            }else {
               // echo "<script>alert('ERROR! DEBE ESTAR LOGUEADO')</script>";
                require_once(VIEWS_PATH."login.php");
            }
        }

        

    }
    

?>