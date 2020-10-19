<?php
    namespace Controllers;
    use Models\Usuario;
    use DAO\UsuarioDAO;

    class UsuarioController {
        private $UsuarioDAO;
        private $loginURL;
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
            $this->mostrarAlerta();
        }
        public function ShowRegisterView()
        {
            require_once(VIEWS_PATH."registrarUser.php");
        }

        public function loguear($email = '', $clave = '') {
            $userAux = $this->UsuarioDAO->verifExistenciaUser($email, $clave);
            //var_dump($userAux);
            if(!empty($userAux) && $userAux[0]['clave'] == $clave)
            {
                $userObject = new Usuario($userAux[0]['email'],$userAux[0]['clave'],'',$userAux[0]['admin']);
                $_SESSION['loggedUser'] = $userObject;
                $this->mostrarAlerta();
                require_once(VIEWS_PATH."dashboard.php");
            }
            else {
                
                echo "<script>alert('ERROR! USUARIO Y/O CLAVE INCORRECTOS')</script>";
                $this->ShowLoginView();
            }
        }

        public function loguearFacebook() {
            require_once(ROOT.'config/configFB.php');
            if(isset($accessToken)){
                if(isset($_SESSION['fb_access_token'])){
                     // Set default access token to be used in script
                    $fb->setDefaultAccessToken($_SESSION['fb_access_token']);
                }else{
                    // Put short-lived access token in session
                    $_SESSION['fb_access_token'] = (string) $accessToken;
                    
                      // OAuth 2.0 client handler helps to manage access tokens
                    $oAuth2Client = $fb->getOAuth2Client();
                    
                    // Exchanges a short-lived access token for a long-lived one
                    $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['fb_access_token']);
                    $_SESSION['fb_access_token'] = (string) $longLivedAccessToken;
                    
                    // Set default access token to be used in script
                    $fb->setDefaultAccessToken($_SESSION['fb_access_token']);
                }
                
                // Redirect the user back to the same page if url has "code" parameter in query string
                if(isset($_GET['code'])){
                    header('Location: ./');
                }
                
                // Getting user's profile info from Facebook
                try {
                    $graphResponse = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,picture');
                    $fbUser = $graphResponse->getGraphUser();
                } catch(FacebookResponseException $e) {
                    echo 'Graph returned an error: ' . $e->getMessage();
                    session_destroy();
                    // Redirect user back to app login page
                    header("Location: ./");
                    exit;
                } catch(FacebookSDKException $e) {
                    echo 'Facebook SDK returned an error: ' . $e->getMessage();
                    exit;
                }
                
                // Getting user's profile data
                $fbUserData = array();
                $fbUserData['oauth_uid']  = !empty($fbUser['id'])?$fbUser['id']:'';
                $fbUserData['first_name'] = !empty($fbUser['first_name'])?$fbUser['first_name']:'';
                $fbUserData['last_name']  = !empty($fbUser['last_name'])?$fbUser['last_name']:'';
                $fbUserData['email']      = !empty($fbUser['email'])?$fbUser['email']:'';
                $fbUserData['gender']     = !empty($fbUser['gender'])?$fbUser['gender']:'';
                $fbUserData['picture']    = !empty($fbUser['picture']['url'])?$fbUser['picture']['url']:'';
                $fbUserData['link']       = !empty($fbUser['link'])?$fbUser['link']:'';
                
              
                $usuario = new Usuario($fbUserData['email'],'',$fbUserData['first_name'],0);
                $existe = $this->UsuarioDAO->VerifExistenciaUser($fbUserData['email']);
                
                if(!empty($existe))
                { 
                    
                    $_SESSION['loggedUser'] = $usuario;
                    
                    header("location: /TP_LabIV/Usuario/ShowDashboard");    
                }
                else
                {
                    $this->UsuarioDAO->Add($usuario);
                }
                
                // Get logout url
                $logoutURL = $helper->getLogoutUrl($accessToken, FB_REDIRECT_URL.'logout.php');
                
            }else{
                // Get login url
              $permissions = ['email']; // Optional permissions
              
              $this->loginURL = $helper->getLoginUrl(FB_REDIRECT_URL, $permissions);
              
            }     
        }
    
        public function destroySession() {
            session_destroy();
            header('location: /TP_LabIV');
        }

        public function mostrarAlerta() {
            ?> <script>$(document).ready(function() {
                toastr.success("Sesion: <?php if($_SESSION['loggedUser']->getAdmin() == 1) echo 'Administrador'; else echo 'Cliente';?>", "Bienvenido <?=$_SESSION['loggedUser']->getEmail() ?>");
            });</script><?php
        }

        public function getloginURL() {
            return $this->loginURL;
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