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

function obtenerButacasOcupadas() {
    let id_funcion = $('#exampleFormControlSelect2').val();
    $.ajax({
        type: 'POST',
        url: '/TP_LabIV/Cartelera/obtenerButacasOcupadas',
        dataType: 'json',
        data: {id_funcion:id_funcion[0]},
         
        }).done(function(data) {
            console.log(data); // imprimimos la respuesta
          let sala = data[0].sala;
          let arrButacasOcupadas = data[0].arrButacasOcupadas;
          let html = "";
        
          for(let x=0;x<sala.cant_filas; x++) {
            html = html+ "<br>"+"f"+x;
            for(let y=0; y<sala.cant_columnas; y++) {
                let flag = 0;
                let z = 0;
                while(arrButacasOcupadas[z] && flag==0) {
                    if(arrButacasOcupadas[z].fila == x && arrButacasOcupadas[z].columna == y) {
                        flag = 1;
                    }
                    z++;
                }
                if(flag==0) {
                    let cantidad = $('#cantidad').val();
                    console.log(cantidad);
                    html = html+`<div class='butaca' style='background-color: green;'><input type='checkbox'  value='${x}+${y}' name='butacas[]' onchange='validarButacasSeleccionadas(${cantidad})'><span class='fas fa-chair'></span></div>`;
                }
                else {
                    html = html+`<div class='butaca'  style='background-color:red;'><input type='checkbox'  value='${x}+${y}' name='butacas[]' disabled><span class='fas fa-chair'></span></div>`;
                }
            }
            

          }
          console.log(html);
         $("#contenido").html(html);
        }).fail(function(jqXHR, textStatus, errorThrown) {
          console.log(errorThrown);
        });
}

function validarButacasSeleccionadas(cantidadMaxima) {
    	// Evento que se ejecuta al soltar una tecla en el input
        $("#cantidad").keydown(function(){
            $("input[type=checkbox]").prop('checked', false);
            $("#seleccionados").html("1");
        });
    
        // Evento que se ejecuta al pulsar en un checkbox
        $("input[type=checkbox]").change(function(){
    
            // Cogemos el elemento actual
            var elemento=this;
            var contador=0;
    
            // Recorremos todos los checkbox para contar los que estan seleccionados
            $("input[type=checkbox]").each(function(){
                if($(this).is(":checked"))
                    contador++;
            });
    
            // Comprobamos si supera la cantidad máxima indicada
            if(contador>cantidadMaxima)
            {
                alert("Ya ha seleccionado las"+ cantidadMaxima +"butacas");
    
                // Desmarcamos el ultimo elemento
                $(elemento).prop('checked', false);
                contador--;
            }
    
            $("#seleccionados").html(contador);
        });

}

function validarCantidadButacas() {
  
    let cantidadEntradas = $('#cantidad').val();
    let valoresCheck = [];
    $("input[type=checkbox]:checked").each(function(){
        valoresCheck.push(this.value);
    });
    
    if(valoresCheck.length < cantidadEntradas) {
        alert("Falta Seleccionar Butacas");
        
        return false;
    }
    else {
        console.log('else');
        return true;
    }
}


 