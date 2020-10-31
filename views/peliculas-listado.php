<?php 
require_once(VIEWS_PATH."header.php"); 
Controllers\UsuarioController::verifUserLogueado();
?>
<div class="container"> 
    <div class="row">
    <section class="busqueda col-md-12">
        <form method="get" class="form-inline" action="<?php echo FRONT_ROOT?>Pelicula/getPeliculasActuales">
            <input type="hidden" value="1" name="page">         
                <label for="genero">Genero:</label>  
                <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="genero" name="genero" >
                    <option value="">Todos</option>
                    <?php
                        foreach ($this->arrGeneros as $key => $value) {
                        ?><option value="<?=$value->{'id'}?>" <?php if($value->{'id'} == $this->generoActual){ echo 'selected="selected"'; } ?>><?=$value->{'name'}?></option>
                    <?php } ?>
                </select>
        
                <label  for="fecha_ini" >Fecha Inicial:</label>
                <input class="form-control" name="fecha_ini" value="<?=$this->fecha_ini?>" id="fecha_ini" type="date">
            
                <label for="fecha_fin">Fecha Fin:</label>
                <input class="form-control" name="fecha_fin" value="<?=date("Y-m-d") ?>" id="fecha_fin" type="date">
                <button type="submit" class="btn btn-warning"><i class="fas fa-search"></i></button>
        </form>
    </section>
    </div>
    <section>
    <div class="card-deck">
        <?php foreach ($this->arrPeliculas as $key => $value) { 
            require(VIEWS_PATH.'add_peliculaToFuncion.php');
           ?>
           <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card card_" style="width: 300px">
                
                    <img class="card-img-top" src="<?='https://image.tmdb.org/t/p/w500'.$value->{'poster_path'} ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?=$value->{'title'}?></h5>
                        <p class="card-text"><?=$this->cortarCadena($value->{'overview'},130)?></p>
                        <blockquote class="blockquote mb-0">
                            <footer class="blockquote-footer"><?=$value->{'release_date'}?></footer>
                        </blockquote>
                        <?php
                        if($_SESSION['btnPeli']!=1) {
                            ?>
                            <button type="button" onclick="getLenguajesAjax(<?=$value->{'id'}?>)" class="btn btn-warning btn-md" data-toggle="modal" data-target="#addFuncion<?=$key?>" ><i class="fas fa-plus"></i></button>
                            <?php
                        
                        }
                            
                        ?>
                    </div>
                </div>
                
          </div>
        <?php
        
        }    ?>
        </div>
    </div>
    <?php
        // paginacion
        
        $primera = $this->pagActual - ($this->pagActual % 10) + 1;
        if ($primera > $this->pagActual) { $primera = $primera - 10; }
        $ultima = $primera + 9 > $this->cantPaginas ? $this->cantPaginas : $primera + 9; 
    ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-sm justify-content-center">
        <?php if ($this->cantPaginas > 1) { ?>
            <li class="page-item  <?php if($this->pagActual==1) echo 'disabled'; ?>"><a class="page-link" href="<?= FRONT_ROOT ?>Pelicula/getPeliculasActuales?page=<?=$this->pagActual-1?>&genero=<?=$this->generoActual?>&fecha_ini=<?=$this->fecha_ini?>&fecha_fin=<?=$this->fecha_fin ?>">&laquo;</a></li>
                <?php
                for($x=$primera;$x<=$ultima;$x++)
                {
                    ?><li class="page-item <?php if($this->pagActual == $x) echo 'active'; ?>"><a class="page-link" href="<?= FRONT_ROOT ?>Pelicula/getPeliculasActuales?page=<?=$x?>&genero=<?=$this->generoActual?>&fecha_ini=<?=$this->fecha_ini?>&fecha_fin=<?=$this->fecha_fin ?>"><?=$x?></a></li><?php
                }
                if ($x <= $this->cantPaginas)
                ?>
            <li class="page-item  <?php if($this->pagActual==$this->cantPaginas) echo 'disabled'; ?>"><a class="page-link" href="<?= FRONT_ROOT ?>Pelicula/getPeliculasActuales?page=<?=$this->pagActual+1?>&genero=<?=$this->generoActual?>&fecha_ini=<?=$this->fecha_ini?>&fecha_fin=<?=$this->fecha_fin ?>">&raquo;</a></li>
           
        <?php } ?>   
        </ul>
    </nav>
</section>
</div>
<?php require_once(VIEWS_PATH."footer.php"); ?>