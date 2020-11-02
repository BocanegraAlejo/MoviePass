<?php
use Controllers\UsuarioController;
require_once(VIEWS_PATH.'header.php'); 
UsuarioController::verifUserLogueado();
?>

<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="card-funcion">
                <div class="row">
                    <div class="col-md-6">
                        <img class="img-cardfuncion" src="<?=$pelicula->getImagen()?>">
                        <div class="datos-peli">
                            <strong>Titulo: </strong><?=$pelicula->getTitulo() ?>
                            <br>
                            <strong>Fecha Lanzamiento: </strong><?=$pelicula->getFecha() ?>
                            <br>
                            <strong>Duración: </strong><?=$pelicula->getDuracion() ?>
                            <br>
                            <strong>Genero: </strong><?=$generosDePeli ?>
                            <br>
                            <strong>ATP: </strong><?=($pelicula->getAdultos()==0) ? 'Si' : 'No' ?>
                            <br>
                            <strong>Puntuación: </strong><?=$pelicula->getVote_average() ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <?php if(!empty($pelicula->getTrailer())) {
                                ?>
                                <iframe width="290" height="200" src="https://www.youtube.com/embed/<?=$pelicula->getTrailer()?>" frameborder="0" allowfullscreen></iframe>
                                <?php
                            } ?> 
                            <h4><?=$pelicula->getTitulo()?></h4>
                            <p><?=$pelicula->getDescripcion()?></p>
                    </div> 
                </div> 
            </div>
        </div>
        <div class="col-md-5">
            <div class="card-funcion2">
                <div class="row">
                    <div class="col-md-12">
                    <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore praesentium nam cum eius dolore atque pro quibusdam molestiae. Unde quia temporibus illum veniam qui. Distinctio deserunt nemo modi ut.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti, error temporibus autem, omnis iste dignissimos suscipit natus alias, quasi earum unde quae minima nisi nulla? Harum dolores atque minus. Earum?
                    </p>
                    </div>
                </div>     
            </div>
        </div>
                    
    </div>
    
    </div>
    

</div>







<?php require_once(VIEWS_PATH.'footer.php'); ?>