<?php 
require_once(VIEWS_PATH.'header.php');
Controllers\UsuarioController::verifUserLogueado();
require_once(VIEWS_PATH.'add_sala.php'); 
?>

<div class="container">
    <div class="d-flex justify-content-center">
    <button class="btn btn-warning btn-lg mt-3 mb-3" data-toggle="modal" data-target="#modalAddsala"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar Sala</button>
    </div>
    <table id="tablaCines" class="table tableCines">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Capacidad</th>
                <th>3D</th>
                <th><i class="fa fa-pencil" aria-hidden="true"></i></th>
                <th><i class="fa fa-trash" aria-hidden="true"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($arrSalas as $key => $value) {
                    $ObjectSala = $this->ModificaSala($value->getId_sala());
                    require(VIEWS_PATH.'modify_sala.php');
                    ?>
                    <tr>
                        <td><?= $value->getNombre_sala(); ?></td>
                        <td><?= $value->getCapacidad(); ?></td>
                        <td>No</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#ModifySala<?=$value->getId_sala()?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>  
                        </td>
                        <td>
                            <form method="post" onsubmit="return confirm('¿Seguro que quiere Eliminar?');" name="formElimSala" action="<?php echo FRONT_ROOT ?>Sala/ElimSala">
                                <input type="hidden" name="id_sala" value=<?= $value->getId_sala(); ?>>
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