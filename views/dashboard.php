<?php
require_once(VIEWS_PATH.'header.php');
Controllers\UsuarioController::verifUserLogueado();
if($_SESSION['loggedUser']->getAdmin() == 0) {
?>
<div class="container">
    <div style='margin-top:15px;height:490px'class="jumbotron">
    <h1 class="display-4">Bienvenid@  <?=$_SESSION['loggedUser']->getNombre() ?>!</h1>
    <p class="lead">Usted ha iniciado Sesión como Cliente.<br> Por lo que podra sacar entradas para ir a disfrutar de una buena pelicula al cine solo o con su familia.</p>
    <hr class="my-4">
    <p><strong>Como sacar Entradas:</strong></p>
    <ol>
        <li>Hacer Click en el boton de la barra superior llamado "Sacar Entrada" (será desplazado a otra Sección del sitio)</li>
        <li>Buscar el cine deseado (puede elegirlo facilmente desde el menu desplegable) y hacer click en la pelicula deseada</li>
        <li>Una vez seleccionada la pelicula, se abrirá una ventana en la que podra ver todos los datos de la pelicula inclusive su trailer.</li>
        <li>En la sección derecha deberá elegir el dia,horario y idioma  que mas se adapte a sus necesidades.</li>
        <li>Luego debera elegir la cantidad a comprar, asi como tambien mediante el boton de abajo, seleccionar las butacas que deseé.</li>
        <li>Una vez finalizado el proceso de seleccion de funcion, debe presionar en el boton "Enviar" y sera trasladado a otra seccion, en la que podra ver los datos de su compra y cargar los datos de la Tarjeta de credito para el pago.</li>
        <li>Finalmente, cuando usted presione Enviar, podrá visualizar sus entradas, recibiendo una copia de las mismas al mail.</li>
    </ol>
    </div>
</div>
<?php
} else if($_SESSION['loggedUser']->getAdmin() == 1) {
    ?>
    <div class="container">
    <div style='margin-top:15px;height:490px'class="jumbotron">
    <h1 class="display-4">Bienvenid@  <?=$_SESSION['loggedUser']->getNombre() ?>!</h1>
    <p class="lead">Usted ha iniciado Sesión como Administrador.<br> Podrá gestionar Todo lo relacionado a sus cines, las salas del mismo, Administrar completamente las funciones,y ver sus estadisticas de venta.</p>
    <hr class="my-4">
    <p><strong>¿Cuales son las cosas que puedo Hacer?</strong></p>
    <ol>
        <li>Agregar, Modificar o eliminar Cines</li>
        <li>Agregar, Modificar o eliminar las salas de un cine determinado</li>
        <li>Agregar, Modificar o eliminar funciones de la Cartelera de nuestros cines</li>
        <li>Ver Listado Completo de peliculas para agregar a cartelera (Puede Filtrar entre fechas, y por genero)</li>
        <li>Ver Estadisticas de todos o un cine determinado, ya sea totales, o entre fechas, (Tickets vendidos y remanentes,dinero recaudado, etc.)</li>
    </ol>
    </div>
</div>
    <?php
}
?>



<?php
require_once(VIEWS_PATH.'footer.php');
?>
