<nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center navbar-dark bg-dark py-3 navbar-custom">
    <a href="<?=FRONT_ROOT?>Usuario/ShowDashboard" class="navbar-brand d-flex w-50 mr-auto">MOVIE PASS </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
        <ul class="navbar-nav w-100 justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cine/ShowAdministraCine"><i class="fa fa-video-camera" aria-hidden="true"></i>&nbsp;&nbsp;Administrar Cines</a>
            </li>
            
        </ul>
        <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
            
            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>Usuario/destroySession">Salir&nbsp;&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </li>
        </ul>
    </div>
</nav>


