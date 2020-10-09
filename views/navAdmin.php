
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><?=$_SESSION['loggedUser']->getEmail(); ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>Pelicula/getPeliculasActuales">Administrar Peliculas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="<?php echo FRONT_ROOT ?>Cine/ShowAdministraCine">Administrar Cines</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>Usuario/destroySession">Salir</a>
      </li>
    </ul>
    
  </div>
</nav>


