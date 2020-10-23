<div class="modal fade" id="elegirCineFuncion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿DE QUE CINE QUIERE ADMINISTRAR LA CARTELERA?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="formulario-add" method="post" action="<?php echo FRONT_ROOT ?>Funcion/verFuncionAllSalas">
        <div class="form-group">
          <label for="cine">Cine:</label>
          <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="cine" name="cines" >
                    <option value="">-- Seleccione -- </option>
                <?php
                    foreach ($arrCines as $key => $value) {
                         ?><option value="<?=$value->getId() ?>"><?= $value->getNombre() ?></option><?php
                    }
                ?>
            </select>
        </div>
      
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      
    </form>
    </div>
  </div>
</div>