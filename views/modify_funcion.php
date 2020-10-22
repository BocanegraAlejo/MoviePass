<div class="modal fade" id="ModalModify<?= $value->getId_funcion()?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MODIFICAR UNA FUNCION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="formulario-add" method="post" action="<?php echo FRONT_ROOT ?>Cine/ModificarCine2">
        <input type="hidden" name="id" value="<?=$ObjectCine->getId();?>">
        <div class="form-group">
          <label for="nombre">Pelicula:</label>
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
          <input type="number" min="0" name="valor_entrada" class="form-control" id="valor_entrada" value="<?=$ObjectCine->getValorEntrada(); ?>">
        </div>
        <div class="form-group">
          <label for="cap_total">Capacidad Total</label>
          <input type="number" min="0" name="capacidad_total" class="form-control" id="cap_total" value="<?=$ObjectCine->getCapacidadTotal(); ?>">
        </div>
        <button type="submit" class="btn btn-success">Enviar</button>
      </form>
    </div>
  </div>
</div>