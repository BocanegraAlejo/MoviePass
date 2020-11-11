
<?php
    require_once(VIEWS_PATH.'header.php');
    Controllers\UsuarioController::verifUserLogueado();
?>

<div class="container">
        <form method="post" action="<?= FRONT_ROOT ?>Estadisticas/calculaEstadisticas">
        <div class="d-flex justify-content-around estadisticas-container">
            <div>
                <label for="cine">Cine:</label>
                <select  class="form-control " id="cine" name="cine" >
                    <option value="">-- Todos --</option>
                    <?php
                        foreach ($this->arrCines as $key => $value) {
                        ?><option  value="<?=$value->getId()?>" <?php if($value->getId() == $this->cineActual){ echo 'selected="selected"'; } ?>><?=$value->getNombre()?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label  for="fecha_ini" >Fecha Inicial:</label>
                <input class="form-control" name="fecha_ini" value="<?=$this->fecha_ini?>" id="fecha_ini" type="date">
            </div>
            <div>
                <label for="fecha_fin">Fecha Fin:</label>
                <input class="form-control" name="fecha_fin" value="<?=$this->fecha_fin?>" id="fecha_fin" type="date">
            </div>
            <div style='margin-top:33px;'><button type="submit" class="btn btn-warning"><i class="fas fa-search"></i></button></div>
        </div>
        </form>
        <table id="tablaCines" class="table tableCines">
        <thead>
            <tr>
                <td style="background-color:#C87D03; border:1px none none none;"></td>
                <th>Titulo Pelicula</th>
                <th>tickets vendidos</th>
                <th>tickets remanentes</th>
                <th>total butacas</th>
                <th>cantidad funciones</th>
                <th>Dinero recaudado</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($estadisticas as $key => $value) {
                    ?>
                    <tr>
                        <td style="background-color:#C87D03;border:none;"></td>
                        <td><?=$value["Pelicula"] ?></td>
                        <td><?=$value["cantidad_tickets_vendidos"] ?></td>
                        <td><?=$value["cantidad_tickets_remanentes"] ?></td>
                        <td><?=$value["total_butacas"] ?></td>
                        <td><?=$value["cantidad_funciones"] ?></td>
                        <td>$<?=$value["dinero_recaudado"] ?></td>
                    </tr>
                    
                    <?php
                    $Total_cantPeliculas++;
                    $Total_cantTicketsVendidos+=$value["cantidad_tickets_vendidos"];
                    $Total_cantidadTicketsRemanentes += $value["cantidad_tickets_remanentes"];
                    $Total_totalButacas += $value["total_butacas"];
                    $Total_cantFunciones += $value["cantidad_funciones"];
                    $Total_dineroRecaudado += $value["dinero_recaudado"];
                }
                
               
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th style='border: none;'>Totales:</th>
                <th><?=  $Total_cantPeliculas ?></th>
                <th><?= $Total_cantTicketsVendidos ?></th>
                <th><?=  $Total_cantidadTicketsRemanentes ?></th>
                <th><?=  $Total_totalButacas ?></th>
                <th><?=  $Total_cantFunciones ?></th>
                <th>$ <?=  $Total_dineroRecaudado ?></th>
            </tr>
        </tfoot>
    </table>               
    
   
</div>
<?php require_once(VIEWS_PATH.'footer.php'); ?>