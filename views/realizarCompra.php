<?php
require_once(VIEWS_PATH.'header.php');
Controllers\UsuarioController::verifUserLogueado();
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card-compra">
                <h3 style="text-align:center;margin-top:10px;text-decoration:underline;">FINALIZAR COMPRA</h3>

                <strong>Cine: </strong><?=$datosEntrada["nombre"] ?>
                <br>
                <strong>Sala: </strong><?=$datosEntrada["nombre_sala"] ?>
                <br>
                <strong>Nombre de la Pelicula: </strong><?=$datosEntrada["titulo"] ?>
                <br>
                <strong>Valor de Entrada: </strong>$<?= $datosEntrada["valor_entrada"]?>
                <br>
                <strong>Cantidad de entradas: </strong><?= $cantidadEntradas ?>
                
                <h2>TOTAL A PAGAR: $ <?= $total_a_pagar ?></h2> 
            </div>
        </div>
        <div class="col-md-6">
        <div class="contenedor">

            <!-- Tarjeta -->
            <section class="tarjeta" id="tarjeta">
                <div class="delantera">
                    <div class="logo-marca" id="logo-marca">
                      
                    </div>
                    <img src="/TP_LabIV/views/img/chip-tarjeta.png" class="chip" alt="">
                    <div class="datos">
                        <div class="grupo" id="numero">
                            <p class="label">Número Tarjeta</p>
                            <p class="numero">#### #### #### ####</p>
                        </div>
                        <div class="flexbox">
                            <div class="grupo" id="nombre">
                                <p class="label">Nombre Tarjeta</p>
                                <p class="nombre">Jhon Doe</p>
                            </div>

                            <div class="grupo" id="expiracion">
                                <p class="label">Expiracion</p>
                                <p class="expiracion"><span class="mes">MM</span> / <span class="year">AA</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="trasera">
                    <div class="barra-magnetica"></div>
                    <div class="datos">
                        <div class="grupo" id="firma">
                            <p class="label">Firma</p>
                            <div class="firma"><p></p></div>
                        </div>
                        <div class="grupo" id="ccv">
                            <p class="label">CCV</p>
                            <p class="ccv"></p>
                        </div>
                    </div>
                    <p class="leyenda">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus exercitationem, voluptates illo.</p>
                    <a href="#" class="link-banco">www.tubanco.com</a>
                </div>
            </section>

            <!-- Contenedor Boton Abrir Formulario -->
            <div class="contenedor-btn">
                <button class="btn-abrir-formulario" id="btn-abrir-formulario">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

            <!-- Formulario -->
            <form action="<?=FRONT_ROOT?>Entrada/procesaPago" method="post" id="formulario-tarjeta" class="formulario-tarjeta">
                <div class="grupo">
                    <label for="inputNumero">Número Tarjeta</label>
                    <input type="text" name="nro" id="inputNumero" maxlength="19" autocomplete="off" required>
                </div>
                <div class="grupo">
                    <label for="inputNombre">Nombre</label>
                    <input type="text" name="nombre" id="inputNombre" maxlength="19" autocomplete="off" required>
                </div>
                <div class="flexbox">
                    <div class="grupo expira">
                        <label for="selectMes">Expiracion</label>
                        <div class="flexbox">
                            <div class="grupo-select">
                                <select name="mes" id="selectMes" required>
                                    <option disabled selected>Mes</option>
                                </select>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="grupo-select">
                                <select name="year" id="selectYear" required>
                                    <option disabled selected>Año</option>
                                </select>
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                    </div>

                    <div class="grupo ccv">
                        <label for="inputCCV">CCV</label>
                        <input type="text" name="ccv" id="inputCCV" maxlength="3" required>
                    </div>
                </div>
                <?php 
                    foreach ($butacas as $key => $value) {
                        ?><input type="hidden" name="butacas[]" value="<?=$value?>"><?php
                    }
                ?>
                
                <input type="hidden" name="id_funcion" value="<?=$id_funcion?>">
                <input type="hidden" name="valor_entrada" value="<?=$datosEntrada["valor_entrada"] ?>">
                <button type="submit" class="btn-enviar">Enviar</button>
            </form>
            </div>

        </div>
    </div>
   
</div>
<script src="<?=JS_PATH?>validarTarjeta.js"></script>
<?php require_once(VIEWS_PATH.'footer.php'); ?>