$(document).ready(function () {

    var baseUrl = $('#base-url').data('url');

    // Manejar el clic en el botón "Editar"
    $('.edit-btn').click(function () {            
        var id_usuario = $(this).data('id_usuario');

        // Enviar una solicitud AJAX al controlador
        $.ajax({
            url: baseUrl + 'EditarEstudiante',
            type: 'POST',
            data: {
                id_usuario: id_usuario
            },
            success: function (response) {
            
                var userData = JSON.parse(response);
                var estudiantes = userData.estudiantes;
                var cursos = userData.cursos;

                var cursoSelect = $('#curso');
                // Limpiar el contenido actual del <select> con jQuery
                cursoSelect.empty();
                // Agregar una opción por cada curso en la lista con jQuery
                $.each(cursos, function(index, curso) {
                    var option = $('<option>', {
                    value: curso.id_curso,
                    text: curso.nombre_curso
                    });
                    cursoSelect.append(option);
                });

              var doc = document.getElementById('documento');
              var name = document.getElementById('nombre');
              var email = document.getElementById('correo');
              var fechaReg = document.getElementById('fechaReg');
              var direccion = document.getElementById('direccion');
              var celular = document.getElementById('celular');
              var fechaNac = document.getElementById('fechaNac');
              var genero = document.getElementById('genero');
              var curso = document.getElementById('curso');
              var docAcudiente = document.getElementById('docAcudiente');
              var nomAcudiente = document.getElementById('nomAcudiente');
              var telAcudiente = document.getElementById('telAcudiente');
              var correoAcudiente = document.getElementById('correoAcudiente');
              var id_estudiante = document.getElementById('id_estudiante');
              var id_usuario = document.getElementById('id_usuario');

              doc.value = estudiantes.documento;
              name.value = estudiantes.nombre;
              email.value = estudiantes.correo;
              fechaReg.value=estudiantes.fecha_registro_estuediante;
              direccion.value=estudiantes.direccion_estudiante;
              celular.value=estudiantes.celular_estudiante;
              fechaNac.value=estudiantes.fecha_nacimiento;
              genero.value=estudiantes.genero_estudiante;
              curso.value=estudiantes.curso_id;
              docAcudiente.value=estudiantes.documento_acudiente;
              nomAcudiente.value=estudiantes.nombre_acudiente;
              telAcudiente.value=estudiantes.telefono_acudiente;
              correoAcudiente.value=estudiantes.correo_acudiente;
              id_estudiante.value=estudiantes.id_Estudiante;
              id_usuario.value=estudiantes.usuario_id;
                       
               // Mostrar el modal
                $('#editModal').modal('show');
            },
            error: function (xhr, status, error) {
                Swal.fire('Error', 'Por favor, inténtalo de nuevo más tarde.', 'error');
                console.log(error); 
            }
        });
    });

    // Manejar el clic en el botón "VER"
    $('.view-btn').click(function () {            
        var id_usuario = $(this).data('id_usuario');

        // Enviar una solicitud AJAX al controlador
        $.ajax({
            url: baseUrl + 'EditarEstudiante',
            type: 'POST',
            data: {
                id_usuario: id_usuario
            },
            success: function (response) {
                var userData = JSON.parse(response);
                var estudiantes = userData.estudiantes;

                var modalBody = '';
                modalBody += '<p> <b>Documento</b>: ' + estudiantes.documento  + 
                ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b>Nombre</b>: '+ estudiantes.nombre +' </p>';
                modalBody += '<p> <b>Correo</b>: ' + estudiantes.correo  + ' </p>';
                modalBody += '<p> <b>Correo</b>: ' + estudiantes.correo  + 
                ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b>Fecha de Registro</b>: '+ estudiantes.fecha_registro_estuediante +' </p>';
                modalBody += '<p> <b>Dirección</b>: ' + estudiantes.direccion_estudiante  + 
                ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b>Celular</b>: '+ estudiantes.celular_estudiante +' </p>';
                modalBody += '<p> <b>Fecha de nacimiento</b>: ' + estudiantes.fecha_nacimiento  + 
                ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b>Género</b>: '+ estudiantes.genero_estudiante +' </p>';
                modalBody += '<p> <b>Curso</b>: ' + estudiantes.nombre_curso  + 
                ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b>N° Documento Acudiente</b>: '+ estudiantes.documento_acudiente +' </p>';
                modalBody += '<p> <b>Nombre Acudiente</b>: ' + estudiantes.nombre_acudiente  + 
                ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b>Teléfono acudiente</b>: '+ estudiantes.telefono_acudiente +' </p>';
                modalBody += '<p> <b>Correo Acudiente</b>: ' + estudiantes.correo_acudiente +'</p>';

                $('#userData').html(modalBody);

                // Mostrar el modal
                $('#viewModal').modal('show');
            },
            error: function (xhr, status, error) {
                alert('error')
                console.log(error); 
            }
        });
    });

    
});


function EditarEstudiante(){
    var documento = document.getElementById('documento').value;
    var fechaReg = document.getElementById('fechaReg').value;
    var direccion = document.getElementById('direccion').value;
    var fechaNac = document.getElementById('fechaNac').value;
    var documentoAcudiente = document.getElementById('docAcudiente').value;
    var nombreAcudiente = document.getElementById('nomAcudiente').value;
    var telefonoAcudiente = document.getElementById('telAcudiente').value;
    var correoAcudiente = document.getElementById('correoAcudiente').value;
    var id_usuario = document.getElementById('id_usuario').value;
    var id_estudiante = document.getElementById('id_estudiante').value;

    //validar correo
    var correoValido = /\S+@\S+\.\S+/.test(correoAcudiente);
    
    if ( fechaReg == "" || direccion=="" || fechaNac == "" || documentoAcudiente =="" 
    || nombreAcudiente=="" || telefonoAcudiente=="" || nombre=="" || documento=="" ||
    id_estudiante=="" || id_usuario=="") {
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
            $("#formEditarEst").submit(); // Enviar el formulario
          }
    }

}

function recargarPagina() {
    window.location.reload();
}



