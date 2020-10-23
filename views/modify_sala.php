<div class="modal fade" id="ModifySala<?=$value->getId_sala()?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MODIFICAR UNA SALA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="formulario-add" method="post" action="<?php echo FRONT_ROOT ?>Sala/ModificarSala2">
          <input type="hidden" name="id_sala" value="<?=$value->getId_sala() ?>">
        <div class="form-group">
          <label for="nombre">Nombre de Sala:</label>
          <input type="text" name="nombre" class="form-control" id="nombre" value="<?= $ObjectSala->getNombre_sala()?>">
        </div>
        <div class="form-group">
          <label for="capacidad">Capacidad:</label>
          <input type="number" name="capacidad" min="1" class="form-control" id="capacidad" value="<?= $ObjectSala->getCapacidad();?>">
        </div>
        <button type="submit" class="btn btn-success">Enviar</button>
      </form>
    </div>
  </div>
</div>
