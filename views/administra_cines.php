<?php
    require_once(VIEWS_PATH.'navAdmin.php');


    use Controllers\CineController;

    $CineController = new CineController();
    $arrCines = $CineController->getAllCines();


?>


<div class="container">
    <a href="<?php echo FRONT_ROOT?>Cine/ShowAltaView">AGREGAR PELICULA</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">direccion</th>
                <th scope="col">Horario Apertura</th>
                <th scope="col">Horario Cierre</th>
                <th scope="col">Valor Entrada</th>
                <th scope="col">Capacidad Total</th>
                <th scope="col">Modif</th>
                <th scope="col">X</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($arrCines as $key => $value) {
                    ?>
                    <tr>
                        <td><?= $value->getId(); ?></td>
                        <td><?= $value->getNombre(); ?></td>
                        <td><?= $value->getDireccion(); ?></td>
                        <td><?= $value->getHorario_apertura(); ?></td>
                        <td><?= $value->getHorario_cierre(); ?></td>
                        <td><?= $value->getValorEntrada(); ?></td>
                        <td><?= $value->getCapacidadTotal(); ?></td>
                        <td>
                            <form method="post" action="<?php echo FRONT_ROOT ?>Cine/ModificaCine">
                                <input type="hidden" name="id" value=<?= $value->getId(); ?>>
                                <button class="btn btn-danger" type="submit">modif</button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="<?php echo FRONT_ROOT ?>Cine/ElimCine">
                                <input type="hidden" name="id_cine" value=<?= $value->getId(); ?>>
                                <button class="btn btn-danger" type="submit">X</button>
                            </form>
                        </td>
                    </tr>
            
                    <?php
                }
            ?>
           
        </tbody>
    </table>

</div>