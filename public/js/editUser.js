$(document).ready(function () {

    var baseUrl = $('#base-url').data('url');

    // Manejar el clic en el botón "Editar"
    $('.edit-btn').click(function () {            
        var documento = $(this).data('documento');
        
        // Enviar una solicitud AJAX al controlador
        $.ajax({
            url: baseUrl + 'editUser',
            type: 'POST',
            data: {
                documento: documento
            },
            success: function (response) {
              var userData = JSON.parse(response);
              var doc = document.getElementById('documento');
              var name = document.getElementById('nombre');
              var email = document.getElementById('correo');
              var rol = document.getElementById('rol');
              var estado = document.getElementById('estado');
              doc.value = userData.documento;
              name.value = userData.nombre;
              email.value = userData.correo;
              rol.value = userData.rol;
              estado.value= userData.estado ? '1' : '0'
               
           
                // Mostrar el modal
                $('#editModal').modal('show');
            },
            error: function (xhr, status, error) {
                alert('error')
                console.log(error); 
            }
        });
    });

    // Manejar el clic en el botón "VER"
    $('.view-btn').click(function () {            
        var documento = $(this).data('documento');
        
        // Enviar una solicitud AJAX al controlador
        $.ajax({
            url: baseUrl + 'editUser',
            type: 'POST',
            data: {
                documento: documento
            },
            success: function (response) {
              var userData = JSON.parse(response);
              var modalBody = '';
                modalBody += '<p> <b>Documento</b>: ' + userData.documento + '</p>';
                modalBody += '<p><b>Nombre</b>: ' + userData.nombre + '</p>';
                modalBody += '<p><b>Correo</b>: ' + userData.correo + '</p>';
                modalBody += '<p><b>Rol</b>: ' + userData.rol + '</p>';
                modalBody += '<p><b>Estado</b>: ' + (userData.estado ? 'Activo' : 'Inactivo') + '</p>';

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

function Confirmacion(documento, estado) {
    // Mostrar SweetAlert2 para confirmación
    var mensaje = (estado==0) ?'Activación':'Inactivación'

    Swal.fire({
        title:'¿Desea confirmar la '+mensaje+ ' del usuario?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#78BD55',
        cancelButtonColor: '#C44228',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {      
        if (result.isConfirmed) {
            console.log('Documento a enviar:', documento);
            console.log('estado a enviar:', estado);
            enviarIdUsuario(documento, estado);
        }
    });
}

function enviarIdUsuario(documento, estado) {
    var baseUrl = $('#base-url').data('url');

    // Utilizar AJAX para enviar el ID del usuario al controlador
    $.ajax({
        url: baseUrl + 'activeUser',
        type: 'POST',
        data: {
            documento: documento,
            estado:estado
        },
        success: function (response) {
            Swal.fire('Guardado con éxito', '', 'success');
            setTimeout(recargarPagina, 1000);
        },
        error: function (xhr, status, error) {

            Swal.fire('Error al activar/inactivar el usuario', 'Por favor, inténtalo de nuevo más tarde.', 'error');
        }
    });
    }

function EditarUsuario(){
    var nombre = document.getElementById('nombre').value;

    if ( nombre=="") {
        Swal.fire(
            'Alerta',
            'El campo nombre es obligatorio',
            'warning'
          )
    }  else {
        $("#formEditar").submit(); // Enviar el formulario

    }

}

function recargarPagina() {
    window.location.reload();
}



