<?php
    require_once('navAdmin.php'); 
    
?>
  
    <div class="container">
    <div class="buscarGenero">
        <form method="get" action="<?php echo FRONT_ROOT?>Pelicula/getPeliculasActuales">
            <input type="hidden" value="" name="page">
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
    <section>
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
        
            for($x=1;$x<$this->cantPaginas+1;$x++)
            {
                ?><form method="get" action="<?= FRONT_ROOT ?>Pelicula/getPeliculasActuales">
                <input type="hidden" name="page" value="<?=$x?>">
                <input type="hidden" name="genero" value="<?=$this->generoActual?>">
                <button type="submit"><?=$x?></button>
                </form>
              <?php
            }
        ?>
    </div>
    </section>
