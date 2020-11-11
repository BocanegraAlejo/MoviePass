<?php
require_once(VIEWS_PATH.'header.php');
Controllers\UsuarioController::verifUserLogueado();
require_once(VIEWS_PATH.'add_cine.php');

?>


<div class="container">
    <div class="d-flex justify-content-center">
    <button class="btn btn-warning btn-lg mt-3 mb-3" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar Cine</button>
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
                <th>Salas</th>
                <th><i class="fa fa-pencil" aria-hidden="true"></i></th>
                <th><i class="fa fa-trash" aria-hidden="true"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php
                
                foreach ($arrCines as $key => $value) {
                    $ObjectCine = $this->ModificaCine($value->getId());
                    require(VIEWS_PATH.'modify_cine.php');
                 
                    ?>
                    <tr>
                        <td><?= $value->getNombre(); ?></td>
                        <td><?= $value->getDireccion(); ?></td>
                        <td><?= $value->getHorario_apertura().'  Hs.'; ?></td>
                        <td><?= $value->getHorario_cierre().'  Hs.'; ?></td>
                        <td><?= '$  '.$value->getValorEntrada(); ?></td>
                        <td><?= $value->getCapacidadTotal(); ?></td>
                        <td>
                            <form method="post"  name="formSala" action="<?php echo FRONT_ROOT ?>Sala/ShowAdministraSalas">
                                <input type="hidden" name="id_cine" value=<?= $value->getId(); ?>>
                                <button class="btn btn-success" type="submit"><i class="fa fa-person-booth" aria-hidden="true"></i></button>
                            </form>
                        </td>
                        <td>
                            
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#ModalModify<?=$value->getId()?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>  
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
<?php require_once(VIEWS_PATH.'footer.php'); ?>