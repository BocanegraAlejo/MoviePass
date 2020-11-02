<?php
use Controllers\UsuarioController;
require_once(VIEWS_PATH.'header.php'); 
UsuarioController::verifUserLogueado();
?>

<div class="container contenedor-verFuncion">
    
    <div class="card-funcion">
        <div class="row">
            <div class="col-md-6">
                <img class="img-cardfuncion" src="<?=$pelicula->getImagen()?>">
            </div>
            <div class="col-md-6">
                <div class="row">
                    <iframe width="320" height="200" src="https://www.youtube.com/embed/<?=$pelicula->getTrailer()?>" frameborder="0" allowfullscreen></iframe>
                </div>
              
                    <h4><?=$pelicula->getTitulo()?></h4>
                    <p><?=$pelicula->getDescripcion()?></p>
                
                
            </div>
        
            
        </div>
        
    </div>

</div>







<?php require_once(VIEWS_PATH.'footer.php'); ?>