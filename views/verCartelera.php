<div class="container">
    <div class="d-flex justify-content-center">
    <a class="btn btn-warning btn-lg mt-3 mb-3" href="<?php echo FRONT_ROOT ?>Pelicula/vistaPeliculasActuales/<?=$this->cineActual?>/<?=$this->salaActual?>"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar Funcion a Sala</a>
    </div>
    <section class="busqueda col-md-12">
        <form method="get" class="form-inline" action="<?php echo FRONT_ROOT?>Cartelera/verCarteleraOneSala">       
              <input type="hidden" value="<?=$id_cine?>" name="id_cine">  
              <label for="sala">Sala:</label>  
                <select class="form-control mb-2 mr-sm-2 mb-sm-0" onchange="this.form.submit()" id="sala" name="sala" >
                    <option value="">-- Seleccione una Sala --</option>
                    <?php
                      foreach ($arrSalas as $key => $value) {
                        ?> <option value="<?=$value->getId_sala();?>" <?php if($value->getId_sala() == $this->salaActual){ echo 'selected="selected"'; } ?>><?= $value->getNombre_sala(); ?></option><?php
                      }
                    ?>
                </select>
        </form>
    </section>
    <section>
    <table id="tablaCines" class="table tableCines">
        <thead>
            <tr>
                <th>Titulo Pelicula</th>
                <th>Idioma</th>
                <th>duracion</th>
                <th>Fecha Proyección</th>
                <th>Horario Proyección</th>
                <th><i class="fa fa-pencil" aria-hidden="true"></i></th>
                <th><i class="fa fa-trash" aria-hidden="true"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($arrFunciones as $key => $value) {
                    
                   // require(VIEWS_PATH.'modify_funcion.php');
                    ?>
                    <tr>
                        <td><?= $value->getTitulo_pelicula(); ?></td>
                        <td><?= $value->getIdioma(); ?></td>
                        <td><?= $value->getDuracion(); ?></td>
                        <td><?= $value->getFecha(); ?></td>
                        <td><?= $value->getHora(); ?></td>
                        <td>
                          <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#ModalModify<?=$value->getId_funcion()?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>  
                        </td>
                        <td>
                            <form method="post" onsubmit="return confirm('¿Seguro que quiere Eliminar esa funcion?');" name="formCine" action="<?php echo FRONT_ROOT ?>Cartelera/ElimFuncion">
                            <input type="hidden" name="id_funcion"  value=<?= $value->getId_funcion(); ?>>
                            <input type="hidden" name="id_cine"  value=<?= $this->cineActual; ?>>      
                                <button class="btn btn-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
                    
                    <?php
                    
                }
                
               
            ?>
        </tbody>
    </table>
    <section>        
</div>



    