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
                        <h3 class="">Compra tus Entradas!</h3>
                           
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Seleccione la funcion deseada:</label>
                                    <select multiple class="form-control" onchange="obtenerButacasOcupadas(this.value)" id="exampleFormControlSelect2">
                                        <?php
                                        foreach ($arrFunciones as $key => $value) {
                                            echo "<option value='".$value->getId_funcion()."'>".$value->getFecha(). "  --  " .$value->getHora()." || ".$value->getIdioma()."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cantidad">Cantidad a comprar:</label>
                                    <input type="number" id="cantidad" min="1" class="form-control" value="1">
                                </div>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#seleccButaca">Seleccionar Butacas</button>
                                <?php require_once(VIEWS_PATH.'seleccionarButacaFuncion.php'); ?>
                            </form>
                        
                    </div>
                </div>     
            </div>
        </div>
                    
    </div>
    
    </div>
    

</div>







<?php require_once(VIEWS_PATH.'footer.php'); ?>