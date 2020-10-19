<?php
    namespace Config;
    use Facebook\Facebook;
    use Facebook\Exceptions\FacebookResponseException;
    use Facebook\Exceptions\FacebookSDKException;

   

    // Include the autoloader provided in the SDK
    require_once ROOT . 'facebook-sdk-5/src/Facebook/autoload.php';
    // Facebook API configuration
    define('FB_APP_ID', '2579962598960993');
    define('FB_APP_SECRET', 'dadac282873a99ce4592680c6f18497c');
    define('FB_REDIRECT_URL', 'http://localhost/TP_LabIV/Usuario/ShowDashboard');
    
    $fb = new Facebook([
    'app_id' => FB_APP_ID, // Replace {app-id} with your app id
    'app_secret' => FB_APP_SECRET,
    'default_graph_version' => 'v3.2',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    // try to get access token
    try {
        if(isset($_SESSION['fb_access_token'])){
            $accessToken = $_SESSION['fb_access_token'];
        }else{
            $accessToken = $helper->getAccessToken();
           
        }
    } catch(FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(FacebookSDKException $e) {
        
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
?>