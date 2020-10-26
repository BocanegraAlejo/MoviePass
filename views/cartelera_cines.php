<div class="container">
        <form method="post" action="<?= FRONT_ROOT ?>Cartelera/verCarteleraCine">
                <select onchange="location.href='ShowCartelera#' + this.value" class="form-control mb-2 mr-sm-2 mb-sm-0" id="cine" name="cine" >
                    <option value="">-- Seleccione un Cine --</option>
                    <?php
                        foreach ($this->arrCines as $key => $value) {
                        ?><option value="<?=$value->getId() ?>"><?=$value->getNombre()?></option>
                    <?php } ?>
                    
                </select>
        </form>

    <?php foreach ($this->arrCines as $key => $value) {
      $arrFunciones = $this->funcionDAO->getAll_FuncionconDatosPeli_XCine($value->getId());
      ?>
      <section id="<?= $value->getId() ?>">
      <h3 class="title-cine"><?=$value->getNombre() ?>:</h3>
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