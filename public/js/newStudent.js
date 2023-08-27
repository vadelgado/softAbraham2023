function RegistrarEstudiante(){
    var fechaReg = document.getElementById('fechaReg').value;
    var direccion = document.getElementById('direccion').value;
    var fechaNac = document.getElementById('fechaNac').value;
    var curso = document.getElementById('curso');
    var selectedIndex = curso.selectedIndex;
    var documentoAcudiente = document.getElementById('documentoAcudiente').value;
    var nombreAcudiente = document.getElementById('nombreAcudiente').value;
    var telefonoAcudiente = document.getElementById('telefonoAcudiente').value;
    var correoAcudiente = document.getElementById('correoAcudiente').value;
    
    //validar correo
    var correoValido = /\S+@\S+\.\S+/.test(correoAcudiente);

    if (fechaReg == "" || direccion=="" || fechaNac == "" || documentoAcudiente =="" 
    || nombreAcudiente=="" || selectedIndex==0 || telefonoAcudiente=="") {
        Swal.fire(
            'Alerta',
            'Por favor, llene todos los campos obligatorios (*)',
            'warning'
          )
    } 
    else {
      if (correoAcudiente!="" && !correoValido) {
        correoError.innerHTML = 'Correo electrónico inválido';
      } else {
        correoError.innerHTML = '';
        $("#formEst").submit(); // Enviar el formulario
      }
    }

}

$(document).ready(function () {

    var baseUrl = $('#base-url').data('url');
    var formulario = document.getElementById("formEstudiante");
    var alerta1 = document.getElementById("alerta1");
    var alerta2 = document.getElementById("alerta2");
    var errorEstudiante = document.getElementById('mjError');

    // Manejar el clic en el botón "buscar"
    $('.search-btn').click(function () {            
        var documento = document.getElementById('documento').value;
        // Enviar una solicitud AJAX al controlador
        $.ajax({
            url: baseUrl + 'buscarEstudiante',
            type: 'POST',
            data: {
                documento: documento
            },
            success: function (response) {
              var userData = JSON.parse(response);
              if(userData=="error"){
                alerta1.style.display = "none";
                errorEstudiante.textContent = 'El número de documento ingresado ya esta registrado en estudiantes';
                alerta2.style.display = "block";
                formulario.style.display = "none"; 
              }
              else
              if(userData != null){
                var documento = document.getElementById('documentoEstu');
                var nombre = document.getElementById('nombre');
                var correo = document.getElementById('correo');
                var id = document.getElementById('id_usuario');
                documento.value = userData.documento;
                nombre.value = userData.nombre;
                correo.value = userData.correo;    
                id.value  = userData.id_usuario;      

                // Mostrar el form
                alerta2.style.display = "none";
                alerta1.style.display = "none";
                formulario.style.display = "block";
              }
              else{
                alerta1.style.display = "none";
                errorEstudiante.textContent = 'El número de documento ingresado no esta registrado en usuarios, o se encuentra desactivado';
                alerta2.style.display = "block";
                formulario.style.display = "none"; 
              }           
            },
            error: function (xhr, status, error) {
                Swal.fire('Error en la busqueda', 'Por favor, inténtalo de nuevo más tarde.', 'error');
                console.log(error); 
            }
        });
    });
    
});


