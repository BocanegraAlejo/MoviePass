<?php
    require_once(VIEWS_PATH.'header.php');
    Controllers\UsuarioController::verifUserLogueado();



?>
<div class="container">
    <?php foreach ($arrEntradas as $key => $value) {
       ?>
       
        <div class="entrada">
            <h2 class="title-cine">MOVIE PASS</h2>
            <img src="<?=$value->getQr_code() ?>">
            <h2 class="entrada__titulo"><?= $datosEntrada["titulo"]?></h2>
            <h2 class="entrada__horaYdia"><?= $datosEntrada["horaYdia"]?></h2>
            
            <label class="entrada__precio">$<?= $datosEntrada["valor_entrada"]?></label>
            <div class="cine_y_sala">
                <strong>CINE: </strong><?= $datosEntrada["nombre"]?>
                <br>
                <strong>SALA: </strong><?= $datosEntrada["nombre_sala"]?></strong>
            </div>
          
        </div>
       <?php
    }?>
  
    
</div>




<?php require_once(VIEWS_PATH.'footer.php'); ?>