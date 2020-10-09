<?php
    require_once('navAdmin.php'); 
    
?>

    <div class="container">
    <div class="buscarGenero">
        <form method="get" action="<?php echo FRONT_ROOT?>Pelicula/peliculasXgenero">
            <div class="form-group">
                <label for="genero">Genero:</label>    
                <select class="form-control" id="genero" name="genero" onchange="this.form.submit()">
                    <option value="todos" >Todos</option>
                    <?php
                        foreach ($this->arrGeneros as $key => $value) {
                        ?><option value="<?=$value->{'id'}?>"><?=$value->{'name'}?></option>
                    <?php } ?>
                </select>
            </div>         
        </form>
    </div>
    <div class="card-deck">
        <?php foreach ($this->arrPeliculas as $key => $value) { ?>
           <div class="col-md-4">
                <div class="card" style="width: 300px">
                    <img class="card-img-top" src="<?='https://image.tmdb.org/t/p/w500'.$value->{'poster_path'} ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?=$value->{'title'}?></h5>
                        <p class="card-text"><?=$value->{'overview'}?></p>
                    </div>
                </div>
                
          </div>
        <?php } ?>
        </div>
    </div>
     
     <div class="navegador_paginas">
        <?php
        $x=1;
            for($x=1;$x<$this->cantPaginas;$x++)
            {
                ?><a href="<?= FRONT_ROOT ?>Pelicula/getPeliculasActuales/<?=$x?>"><?=$x?></a>
              <?php
            }
        ?>
    </div>
