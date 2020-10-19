<?php

use Controllers\UsuarioController;
$usuarioController = new UsuarioController();

$usuarioController->loguearFacebook();

$loginURL = $usuarioController->getloginURL();
 
?>
