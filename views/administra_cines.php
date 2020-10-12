<?php
require_once(VIEWS_PATH.'navAdmin.php');
  
?>


<div class="container">
    <div class="d-flex justify-content-center">
    <a href="<?php echo FRONT_ROOT?>Cine/ShowAltaView" class="btn btn-warning btn-lg mt-3 mb-3" role="button" aria-pressed="true"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar Pelicula</a>
    </div>
    <table id="tablaCines" class="table tableCines">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>direccion</th>
                <th>Horario Apertura</th>
                <th>Horario Cierre</th>
                <th>Valor Entrada</th>
                <th>Capacidad Total</th>
                <th><i class="fa fa-pencil" aria-hidden="true"></i></th>
                <th><i class="fa fa-trash" aria-hidden="true"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($arrCines as $key => $value) {
                    ?>
                    <tr>
                        <td><?= $value->getNombre(); ?></td>
                        <td><?= $value->getDireccion(); ?></td>
                        <td><?= $value->getHorario_apertura().'  Hs.'; ?></td>
                        <td><?= $value->getHorario_cierre().'  Hs.'; ?></td>
                        <td><?= '$  '.$value->getValorEntrada(); ?></td>
                        <td><?= $value->getCapacidadTotal(); ?></td>
                        <td>
                            <form method="post" action="<?php echo FRONT_ROOT ?>Cine/ModificaCine">
                                <input type="hidden" name="id" value=<?= $value->getId(); ?>>
                                <button class="btn btn-primary" type="submit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            </form>
                        </td>
                        <td>
                            <form method="post" onsubmit="return confirm('¿Seguro que quiere Eliminar?');" name="formCine" action="<?php echo FRONT_ROOT ?>Cine/ElimCine">
                                <input type="hidden" name="id_cine" value=<?= $value->getId(); ?>>
                                <button class="btn btn-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
            
                    <?php
                }
            ?>
           
        </tbody>
    </table>

</div>
