<div class="modal fade" id="ModalModify<?= $value->getId_funcion()?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MODIFICAR UNA FUNCION </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="formulario-add" method="post" action="<?php echo FRONT_ROOT ?>Funcion/ModificarFuncion2">
        <input type="hidden" name="id" value="<?=$objectFuncion->getId_funcion();?>">
        
        <div class="form-group">
          <label for="fecha">Fecha de Proyeccion</label>
          <input type="date" min="0" name="fecha_proyeccion" class="form-control" id="fecha" value="<?=$objectFuncion->getFecha(); ?>">
        </div>
        <div class="form-group">
          <label for="horario">Horario Proyeccion</label>
          <input type="time" min="0" name="horario" class="form-control" id="horario" value="<?=$objectFuncion->getHora(); ?>">
        </div>
        <button type="submit" class="btn btn-success">Enviar</button>
      </form>
    </div>
  </div>
</div>