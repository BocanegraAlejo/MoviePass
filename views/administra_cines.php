<?php

use Controllers\UsuarioController;

UsuarioController::verifUserLogueado();
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
                        <?= $value->getId(); ?>
                            
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
<div class="modal fade" id="ModalModify<?= $value->getId()?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MODIFICAR UN CINE <?=$ObjectCine->getId();?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="formulario-add" method="post" action="<?php echo FRONT_ROOT ?>Cine/ModificarCine2">
        <input type="hidden" name="id" value="<?=$ObjectCine->getId();?>">
        <div class="form-group">
          <label for="nombre">Nombre:</label>
          <input type="text" name="nombre" class="form-control" id="nombre" value="<?= $ObjectCine->getNombre();?>">
        </div>
        <div class="form-group">
          <label for="direccion">Direccion:</label>
          <input type="text" name="direccion" class="form-control" id="direccion" value="<?= $ObjectCine->getDireccion();?>">
        </div>
        <div class="form-row">
          <div class="form-group col">
            <label for="horario_aper">Horario Apertura:</label>
            <input type="time" name="horario_apertura" class="form-control" id="horario_aper" value="<?= $ObjectCine->getHorario_apertura();?>">
          </div>
          <div class="form-group col">
            <label for="horario_cierre">Horario Cierre:</label>
            <input type="time" name="horario_cierre" class="form-control" id="horario_cierre" value="<?= $ObjectCine->getHorario_cierre();?>">
          </div>
        </div>
        <div class="form-group">
          <label for="valor_entrada">Valor Entrada</label>
          <input type="int" name="valor_entrada" class="form-control" id="valor_entrada" value="<?=$ObjectCine->getValorEntrada(); ?>">
        </div>
        <div class="form-group">
          <label for="cap_total">Capacidad Total</label>
          <input type="int" name="capacidad_total" class="form-control" id="cap_total" value="<?=$ObjectCine->getCapacidadTotal(); ?>">
        </div>
        <button type="submit" class="btn btn-success">Enviar</button>
      </form>
    </div>
  </div>
</div>

