
function validarSala() {
    let selectSala = document.getElementById('Selectsala').value;
    if(selectSala == "") {
        alert("ERROR! DEBE SELECCIONAR UNA SALA PRIMERO!");
    } else {
        location.href = "/TP_LabIV/Pelicula/getPeliculasActuales";
    }
}



 