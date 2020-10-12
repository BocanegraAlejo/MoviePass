<div class="container">
    <div id="logreg-forms">
        <form class="form-signin" method="post" action="<?php echo FRONT_ROOT ?>Usuario/loguear">
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center">LOGIN</h1>
            <div class="social-login">
                <button class="btn facebook-btn social-btn" type="button"><span> Loguear con Facebook</span> </button>
                <button class="btn google-btn social-btn" type="button"><span> Loguear con Google</span> </button>
            </div>
            <p style="text-align:center">O</p>
            <input type="email" id="inputEmail" name="user" class="form-control" placeholder="Nombre de Usuario.." required>
            <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Clave.." required>
            
            <button id="btn-loguear" class="btn btn-success btn-block" type="submit"> Loguear</button>
            <hr>
            
            <a href="<?php echo FRONT_ROOT ?>Usuario/ShowRegisterView"><button class="btn btn-primary btn-block" type="button" id="btn-signup">si no tenes una cuenta, registrate!</button></a>
        </form>
        <br>   
    </div>
</div>