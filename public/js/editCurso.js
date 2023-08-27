$(document).ready(function () {

    var baseUrl = $('#base-url').data('url');

    // Manejar el clic en el botón "Editar"
    $('.edit-btn').click(function () {            
        var id_curso = $(this).data('id_curso');
 
       
        // Enviar una solicitud AJAX al controlador
        $.ajax({
            url: baseUrl + '/editarCurso',
            type: 'POST',
            data: {
                id_curso: id_curso
            },
            success: function (response) {
            
            var userData = JSON.parse(response);
            var cursos = userData.data;

            var nombre = document.getElementById('nombre_curso');
             var tipo = document.getElementById('tipo_curso');
             var estado = document.getElementById('estado_curso');
             var id =document.getElementById('id_curso');
            

             nombre.value = cursos.nombre_curso;
             tipo.value = cursos.tipo_curso;
             estado.value = cursos.estado_curso;
             id.value = cursos.id_curso;                       
               // Mostrar el modal
                $('#editModal').modal('show');
            },
            error: function (xhr, status, error) {
                Swal.fire('Error', 'Por favor, inténtalo de nuevo más tarde.', 'error');
                console.log(error); 
            }
        });
    });

    
    
});


function EditarCurso(){
    var nombre = document.getElementById('nombre_curso').value;
    var tipo = document.getElementById('tipo_curso').value;
   
    if ( nombre == "" || tipo=="") {
        Swal.fire(
            'Alerta',
            'Por favor, llene todos los campos',
            'warning'
          )
    }  
    else {
        $("#formEditarEst").submit(); // Enviar el formulario
    }

}

function recargarPagina() {
    window.location.reload();
}



