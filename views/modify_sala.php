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
          <input type="hidden" name="id_cine" value="<?=$id_cine?>">
          <input type="hidden" name="id_sala" value="<?=$value->getId_sala() ?>">
        <div class="form-group">
          <label for="nombre">Nombre de Sala:</label>
          <input type="text" name="nombre" class="form-control" id="nombre" value="<?= $ObjectSala->getNombre_sala()?>">
        </div>
        <div class="form-row">
          <div class="form-group col">
            <label for="cant_filas">Cantidad de Filas:</label>
            <input type="number" name="cant_filas" class="form-control" id="cant_filas" value="<?=$ObjectSala->getCant_filas()?>" required>
          </div>
          <div class="form-group col">
            <label for="cant_columnas">Cantidad de Columnas:</label>
            <input type="number" name="cant_columnas" class="form-control" id="cant_columnas" value="<?=$ObjectSala->getCant_columnas()?>" required>
          </div>
        </div>
        <button type="submit" class="btn btn-success">Enviar</button>
      </form>
    </div>
  </div>
</div>
