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
          <input type="hidden" name="id_cine" value="<?=$id_cine?>">
          <input type="hidden" name="id_Sala" value="<?=$id_sala?>">
          <input type="hidden" name="id" value="<?=$objectFuncion->getId_funcion();?>">
        
        <div class="form-group">
          <label for="fecha">Fecha de Proyeccion</label>
          <div class="input-group date">
              <input type="text" value="<?=$objectFuncion->getFecha()?>" onchange="validarHoraXfecha(<?=$id_sala?>,this.value,<?=$value->getId_pelicula()?>,<?=$value->getId_funcion()?>)" autocomplete="off" class="form-control" id="dia<?=$value->getId_funcion()?>" name="dia">
          </div>
        </div>
        <div class="form-group">
          <label for="horario">Horario de Proyección</label>
          <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="horario<?=$value->getId_funcion()?>" name="horario">
            <option value=""><?=$objectFuncion->getHora() ?></option>
          </select>
        </div>
        <div class="form-group">
          <label for="idioma">Idioma de la Pelicula</label>
          <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="idioma<?=$value->getId_funcion()?>" name="idioma">
              <?php foreach ($arrIdiomas as $key => $valueIdioma) {
                ?><option value=<?=$valueIdioma->getId_lenguaje()?> <?php if($valueIdioma->getId_lenguaje() == $objectFuncion->getId_idioma()){ echo 'selected="selected"'; } ?> ><?=$valueIdioma->getNombre()?></option><?php
              }
           ?>
          </select>
        </div>
        <button type="submit" class="btn btn-success">Enviar</button>
      </form>
    </div>
  </div>
</div>
<script>
    $('#dia<?=$value->getId_funcion()?>').datepicker({
        language: "es",
        format: "yyyy/mm/dd",
        autoclose: true,
        multidate: false,
        todayHighlight: true,
        startDate: "<?=date("Y/m/d");?>",
        datesDisabled: buscarDiasXpelicula(<?=$id_cine?>,<?=$value->getId_pelicula()?>)
    });
</script>