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
        <div class="form-group">
          <label for="capacidad">Capacidad:</label>
          <input type="number" min="1" name="capacidad" class="form-control" id="capacidad" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
    </form>
    </div>
  </div>
</div>
