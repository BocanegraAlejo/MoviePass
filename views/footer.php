
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous" defer></script>
 
<?php
    if(isset($_SESSION["Alertmessage"])) {
        if($_SESSION["Alertmessage"]!="toastr") {
            ?><script>alert("<?=$_SESSION["Alertmessage"]?>");</script><?php    
        }
        else {
            ?>
            <script>$(document).ready(function() {
                toastr.success("Sesion: <?php if($_SESSION['loggedUser']->getAdmin() == 1) echo 'Administrador'; else echo 'Cliente';?>", "Bienvenido <?=$_SESSION['loggedUser']->getEmail() ?>");
            });</script><?php
             
        }
        unset($_SESSION["Alertmessage"]);
    }
?>
</body>
</html>
