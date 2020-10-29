/*
    Carousel
*/
$('#carousel-example').on('slide.bs.carousel', function (e) {
    /*
        CC 2.0 License Iatek LLC 2018 - Attribution required
    */
    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 5;
    var totalItems = $('.carousel-item').length;
 
    if (idx >= totalItems-(itemsPerSlide-1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i=0; i<it; i++) {
            // append slides to end
            if (e.direction=="left") {
                $('.carousel-item').eq(i).appendTo('.carousel-inner');
            }
            else {
                $('.carousel-item').eq(0).appendTo('.carousel-inner');
            }
        }
    }
});

function validarSala() {
    let selectSala = document.getElementById('Selectsala').value;
    if(selectSala == "") {
        alert("ERROR! DEBE SELECCIONAR UNA SALA PRIMERO!");
    } else {
        location.href = "/TP_LabIV/Pelicula/getPeliculasActuales";
    }
}

function validarHoraXfecha(dia,id_pelicula) {
   
    $.ajax({
      type: 'POST',
      url: '/TP_LabIV/Funcion/BuscarHorariosXdia',
      dataType: 'json',
      data: {dia:dia,id_pelicula:id_pelicula},
       
      }).done(function(data) {
        console.log(data); // imprimimos la respuesta
        $("#horario"+id_pelicula).empty();
        for(let x=0; x<data.length; x++) {
            $("#horario"+id_pelicula).append("<option value=" + data[x] + ">" + data[x] + "</option>");
        }
      }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
      });
    
}

 