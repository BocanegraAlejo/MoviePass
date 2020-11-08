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
      <form class="formulario-add"  method="post" action="<?php echo FRONT_ROOT ?>Funcion/addFuncionToCartelera">
        <input type="hidden"  name="id_cine" value="<?= $id_cine ?>">
        <input type="hidden" name="id_sala" value="<?=$id_sala?>">
        <input type="hidden"  name="id_pelicula" value="<?= $value->{'id'} ?>">
        <div class="form-group">
            <label for="dia">Dia de Proyección</label>
            <div class="input-group date">
              <input type="text" onchange="validarHoraXfecha(<?=$id_sala?>,this.value,<?=$value->{'id'}?>,'')" autocomplete="off" class="form-control" id="dia<?=$key?>" name="dia">
            </div>
        </div>
        <div class="form-group">
          <label for="horario">Horario de Proyección</label>
          <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="horario<?=$value->{'id'}?>" name="horario"></select>
        </div>
        <div class="form-group">
          <label for="idioma">Idioma de la Pelicula</label>
          <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="idioma<?=$value->{'id'}?>" name="idioma"></select>
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
        format: "dd/mm/yyyy",
        autoclose: true,
        multidate: false,
        todayHighlight: true,
        startDate: "<?=date("d/m/Y");?>",
        datesDisabled: buscarDiasXpelicula(<?=$id_cine?>,<?=$value->{'id'}?>)
    });
</script>
