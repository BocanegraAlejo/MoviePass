<?php
require_once(VIEWS_PATH.'header.php');
require_once(VIEWS_PATH.'registrarUser.php');
require_once(VIEWS_PATH."Helper.php"); 

?>

<div class="bg-login">
<div class="container">
    <div id="logreg-forms">
        <form class="form-signin" method="post" action="<?php echo FRONT_ROOT ?>Usuario/loguear">
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center">LOGIN</h1>
            <div class="social-login">
                <a class="btn facebook-btn social-btn" id="btnFace" href="<?= $loginURL?>"><span> Loguear con Facebook</span> </a>
                
            </div>
            <p style="text-align:center">O</p>
            <input type="email" id="inputEmail" name="user" class="form-control" placeholder="Nombre de Usuario.." required>
            <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Clave.." required>
            
            <button id="btn-loguear" class="btn btn-success btn-block" type="submit"> Loguear</button>
            <hr>
            
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#registrarUser" type="button" id="btn-signup">si no tenes una cuenta, registrate!</button>
        </form>
        <br>   
    </div>
</div>
</div>

<?php require_once(VIEWS_PATH.'footer.php'); ?>