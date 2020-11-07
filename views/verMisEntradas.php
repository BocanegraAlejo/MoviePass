<?php
    require_once(VIEWS_PATH.'header.php');
    Controllers\UsuarioController::verifUserLogueado();



?>
<div class="container">
    <?php foreach ($arrEntradas as $key => $value) {
        $strButaca =  $arrAbecedario[$arrButacas[$key]->getFila()]. "  ".$arrButacas[$key]->getColumna();
       
       ?> 
       
        <div class="entrada">
            <h2 class="title-cine">MOVIE PASS</h2>
            <img src="<?='/TP_LabIV/views/img/temp/'.$value->getQr_code().'.png'; ?>">
            <label style="position: absolute;left: 400px; margin-top: -58px;"><?=$value->getQr_code()?></label>
            <h2 class="entrada__titulo"><?= $datosEntrada["titulo"]?></h2>
            <h2 class="entrada__horaYdia"><?= $datosEntrada["horaYdia"]?></h2>
            
            <label class="entrada__precio">$<?= $datosEntrada["valor_entrada"]?></label>
            <div class="cine_y_sala">
                <strong>CINE: </strong><?= $datosEntrada["nombre"]?>
                <br>
                <strong>SALA: </strong><?= $datosEntrada["nombre_sala"]?>
            </div>
            <div class="entrada__butaca">
                <strong>BUTACA: </strong>
                <br>
                 <label><?=$strButaca?></label>
            </div>
           
        </div>
       <?php
    }?>
  
    
</div>




<?php require_once(VIEWS_PATH.'footer.php'); ?>