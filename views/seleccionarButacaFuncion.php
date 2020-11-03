<div class="modal fade" id="seleccButaca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"           aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SELECCION DE BUTACAS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="pantalla__seleccionButaca">
                    PANTALLA
                </div>
                <?php
                    for($x=0; $x<50;$x++) { ?>
                        <div class="butaca">
                            <input type="checkbox"  value="first_checkbox"> 
                            <span class="fas fa-chair"></span>
                            <h6><?=$x ?></h6>
                        </div>

                    <?php
                    }
                    ?> 
            </div>
        </div>
    </div>
</div>
