<div class="modal fade" id="modalAddsala" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAR UNA SALA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
      <form class="formulario-add" method="post" action="<?php echo FRONT_ROOT ?>Sala/altaSala">
        <input type="hidden" name="id_cine" value="<?=$id_cine ?>">
        <div class="form-group">
          <label for="nombre">Nombre de la Sala:</label>
          <input type="text" name="nombre" class="form-control" id="nombre" required>
        </div>
        <div class="form-row">
          <div class="form-group col">
            <label for="cant_filas">Cantidad de Filas:</label>
            <input type="number" min="1" max="40" name="cant_filas" class="form-control" id="cant_filas" required>
          </div>
          <div class="form-group col">
            <label for="cant_columnas">Cantidad de Columnas:</label>
            <input type="number" min="1" max="30" name="cant_columnas" class="form-control" id="cant_columnas" required>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
    </form>
    </div>
  </div>
</div>
