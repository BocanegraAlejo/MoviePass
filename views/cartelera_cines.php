<?php require_once(VIEWS_PATH.'header.php'); 
Controllers\UsuarioController::verifUserLogueado();
?>
<div class="container">
        <form method="post" action="<?= FRONT_ROOT ?>Cartelera/verCarteleraCine">
                <select onchange="location.href='ShowCartelera#' + this.value" class="form-control select_cine" id="cine" name="cine" >
                    <option class="option_cine" value="">-- Seleccione un Cine --</option>
                    <?php
                        foreach ($this->arrCines as $key => $value) {
                        ?><option class="option_cine" value="<?=$value->getId() ?>"><?=$value->getNombre()?></option>
                    <?php } ?>
                    
                </select>
        </form>

    <?php foreach ($this->arrCines as $key => $value) {
      $arrFunciones = $this->funcionDAO->getAll_FuncionconDatosPeli_XCine($value->getId());
      ?>
      <section id="<?= $value->getId() ?>">
      <h3 class="title-cine"><?=$value->getNombre() ?>:</h3>
      <?php if(!empty($arrFunciones)) { ?>
      <div class="carousel">
        <?php
        
        foreach ($arrFunciones as $key => $value) {
        ?><div class="carousel-div">
            
            <img src="<?=$value["imagen"] ?>">
            <h3 class="titleCarousel"><?=$value["titulo"]?></h3>
          
          </div><?php
        }
      
        ?>   
      </div>
      <?php
        }else {
          echo "<h3 style='color:orange; text-align:center;'>No Hay Funciones</h3>";
        }
      ?>
      </section>
    <?php } ?>
    
  </div>
<script>
 $(function(){
      $('.carousel').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: true, 
        centerPadding: '0',
        dots: true,
        responsive: [
        {
          breakpoint: 768,
          settings: {
          slidesToShow: 2,
          slidesToScroll: 1
          }
        }
    ]    
      });
    });
</script>

<?php require_once(VIEWS_PATH.'footer.php'); ?>