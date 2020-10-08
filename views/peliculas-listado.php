<?php

    use Controllers\PeliculaController;
    require_once('nav.php');
    $PeliController = new PeliculaController();
    $arrPelisActuales = $PeliController->getPeliculasActuales();
    
    
?>
<main>
    <div class="container">
        
        <?php foreach ($arrPelisActuales as $key => $value) { ?>
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="<?='https://image.tmdb.org/t/p/w500'.$value->{'poster_path'} ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?=$value->{'title'}?></h5>
                    <p class="card-text"><?=$value->{'overview'}?></p>
                    
                </div>
            </div>
        <?php } ?>
    
    </div>
</main>