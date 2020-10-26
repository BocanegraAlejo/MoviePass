<div class="modal fade" id="addFuncion<?=$key?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAR PELICULA A FUNCION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php 
        $controllerFuncion = new Controllers\FuncionController();
        $arrDias = $controllerFuncion->BuscarDiasXPelicula($value->{'id'}); 
        $arrDiasString = "['".implode(" ','",$arrDias)."']";
        //Cambiar esto en un futuro
      ?>
      
      <form class="formulario-add"  method="post" action="<?php echo FRONT_ROOT ?>Funcion/addFuncionToCartelera">
        <input type="hidden"  name="id_pelicula" value="<?= $value->{'id'} ?>">
        <div class="form-group">
            <label for="dia">Dia de Proyección</label>
            <div class="input-group date">
              <input type="text" autocomplete="off" class="form-control" id="dia<?=$key?>" name="dia">
            </div>
        </div>
        <div class="form-group">
          <label for="horario">Horario de Proyección</label>
          <input type="time" autocomplete="off"  name="horario" class="form-control" id="horario" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
    </form>
    </div>
  </div>
</div>
<script>
    
   $('#dia<?=$key?>').datepicker({
        language: "es",
        format: "yyyy/mm/dd",
        autoclose: true,
        multidate: false,
        todayHighlight: true,
        datesDisabled: <?=$arrDiasString ?>
        
    });
   
</script>
