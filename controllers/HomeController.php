<?php
    namespace Controllers;

    class HomeController
    {
        public function __construct() {
            
        }
        
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."login.php");
        }        
    }
?>