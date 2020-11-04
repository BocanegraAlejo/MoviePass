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

function validarSala(id_cine, id_sala) {
    let selectSala = document.getElementById('Selectsala').value;
    if(selectSala == "") {
        alert("ERROR! DEBE SELECCIONAR UNA SALA PRIMERO!");
    } else {
       
        location.href = "/TP_LabIV/Pelicula/getPeliculasActuales/"+id_cine+"/"+id_sala;
    }
}

function validarSalaModificar(id) {
    let selectSala = document.getElementById('Selectsala').value;
    if(selectSala == "") {
        alert("Por una cuestion de Seguridad, antes de editar una funcion, primero debe seleccionar la sala a la que corresponde la misma..");
    }
    else
    {
        $('#ModalModify'+id).modal('show');
    }
}

function buscarDiasXpelicula(id_cine,id_pelicula) {
   let obj;
    $.ajax({
        async: false,
        type: 'POST',
        url: '/TP_LabIV/Funcion/BuscarDiasXPelicula',
        dataType: 'json',
        data: {id_cine:id_cine,id_pelicula:id_pelicula},
        
        }).done(function(data) {
          //console.log(data); // imprimimos la respuesta
          obj = data;
          
        }).fail(function(jqXHR, textStatus, errorThrown) {
          console.log(errorThrown);
         
    });
    return obj;
}

function validarHoraXfecha(id_sala,dia,id_pelicula, id_funcion) {
   
    $.ajax({
      type: 'POST',
      url: '/TP_LabIV/Funcion/BuscarHorariosXdia',
      dataType: 'json',
      data: {id_sala:id_sala,dia:dia,id_pelicula:id_pelicula},
       
      }).done(function(data) {
        console.log(data); // imprimimos la respuesta
        if(id_funcion == "") {
            id_funcion = id_pelicula;
        }
        $("#horario"+id_funcion).empty();
        
        for(let x=0; x<data.length; x++) {
            $("#horario"+id_funcion).append("<option value=" + data[x] + ">" + data[x] + "</option>");
        }
      }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
      });
    
}

function getLenguajesAjax(id_pelicula) {
   console.log(id_pelicula);
    $.ajax({
      type: 'POST',
      url: '/TP_LabIV/Pelicula/getLenguajesFromPelicula',
      dataType: 'json',
      data: {id_pelicula:id_pelicula},
       
      }).done(function(data) {
        console.log(data); // imprimimos la respuesta
        $("idioma"+id_pelicula).empty();
        for(let x=0; x<data.length; x++) {
            $("#idioma"+id_pelicula).append("<option value=" + data[x].id_lenguaje + ">" + data[x].nombre + "</option>");
        }
      }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
      });
}

function obtenerButacasOcupadas(id_funcion) {
    $.ajax({
        type: 'POST',
        url: '/TP_LabIV/Cartelera/obtenerButacasOcupadas',
        dataType: 'json',
        data: {id_funcion:id_funcion},
         
        }).done(function(data) {
          console.log(data); // imprimimos la respuesta
          
         
        }).fail(function(jqXHR, textStatus, errorThrown) {
          console.log(errorThrown);
        });
}

 