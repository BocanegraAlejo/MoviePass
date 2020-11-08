<?php
    namespace Controllers;

    use DAO\PDO\CineDAO;
    use Models\Usuario;
    use DAO\PDO\UsuarioDAO;
    use Exception;
    use Facebook\Facebook;
    use Facebook\Exceptions\FacebookResponseException;
    use Facebook\Exceptions\FacebookSDKException;

    class UsuarioController {
        private $UsuarioDAO;
        private $cineDAO;
        private $loginURL;
        public function __construct()
        {
            $this->UsuarioDAO = new UsuarioDAO();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH.'dashboard.php');
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

        public function loguear($email = '', $clave = '') {
            try {
                 $userAux = $this->UsuarioDAO->verifExistenciaUser($email, $clave);
          
                if(!empty($userAux) && $userAux->getClave() == $clave)
                {
                
                $_SESSION['loggedUser'] = $userAux;
                require_once(VIEWS_PATH."dashboard.php");
                
                }
                else {
                
                    $_SESSION["Alertmessage"] = "ERROR! USUARIO Y/O CLAVE INCORRECTOS";
                    $this->ShowLoginView();
                }
            }
            catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
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
                
              
                try {
                     $existe = $this->UsuarioDAO->VerifExistenciaUser($fbUserData['email']);
                
                    if(!empty($existe))
                    { 
                        
                        $_SESSION['loggedUser'] = $existe;
                        
                        header("location: /TP_LabIV/Usuario/ShowDashboard");    
                    }
                    else
                    {
                        $usuario = new Usuario('',$fbUserData['email'],'',$fbUserData['first_name'],0);
                        $this->UsuarioDAO->Add($usuario);
                    }
                }
                catch(Exception $ex) {
                    $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
                }
               
                
                // Get logout url
                $logoutURL = $helper->getLogoutUrl($accessToken, FB_REDIRECT_URL.'logout.php');
                
            }else{
                // Get login url
              $permissions = ['email']; // Optional permissions
              
              $this->loginURL = $helper->getLoginUrl(FB_REDIRECT_URL, $permissions);
              
            }     
        }
        
        public function registrarUsuario($nombre, $email, $pass) {
            try {
                 $Objectuser = $this->UsuarioDAO->VerifExistenciaUser($email);
                if(empty($Objectuser)) {
                    $newUsuario = new Usuario('',$email,$pass,$nombre,0);
                    $this->UsuarioDAO->Add($newUsuario);
                    $_SESSION["Alertmessage"] = "Registro de Usuario Exitoso!";
                    $this->ShowLoginView();
                }
                else {
                    $_SESSION["Alertmessage"] = "ERROR! Ya existe una cuenta registrada con ese email!";
                    $this->ShowLoginView();
                }
            }
            catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
           
        }

        public function destroySession() {
            session_destroy();
            header('location: /TP_LabIV');
        }

        public function mostrarAlerta() {
            $_SESSION["Alertmessage"] = "toastr";
        }

        public function getloginURL() {
            return $this->loginURL;
        }

        //  ### VERIFICA SI USUARIO ESTA LOGUEADO ### 
        public static function verifUserLogueado() {
            if(isset($_SESSION['loggedUser'])) {
                
                if($_SESSION['loggedUser']->getAdmin()==1) {
                    $cineDAO = new CineDAO();
                    $arrCines = $cineDAO->GetAll($_SESSION['loggedUser']->getId_usuario());
                    require_once(VIEWS_PATH."navAdmin.php");
                    
                }
                else {
                    require_once(VIEWS_PATH."nav.php");
                    
                }
            }else {
                require_once(VIEWS_PATH."login.php");
            }
        }

        

    }
    

?>