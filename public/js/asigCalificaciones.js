$(document).ready(function() {
    var baseUrl = $('#base-url').data('url');
    const boton = document.getElementById('asignar');

    // Manejar el evento change del select de asignaturas
    $("#curso").on("change", function() {
        var curso = $("#curso").val();

        if (curso !== "") {
            // Realizar la solicitud AJAX al controlador para obtener las asignaturas del curso seleccionado
            $.ajax({
                url:  baseUrl + 'getAsignaturasporCurso',
                method: "POST",
                data: { curso: curso },
                dataType: "json",
                success: function(data) {

                    if(data.vacio=="vacio"){
                        $("#asignatura").empty().prop("disabled", true);
                        boton.disabled = true;
                        $("#asignatura").append("<option value=''>" + 'No hay asignaturas para este curso'+ "</option>");
                     
                    }
                    else{
                        // Limpiar y habilitar el select de asignaturas
                        $("#asignatura").empty().prop("disabled", false);
                        // Agregar las opciones al select de asignaturas
                        $.each(data, function(key, value) {
                            $("#asignatura").append("<option value='" + value.id_asignatura+ "'>" + value.area_asignatura + "</option>");
                        });
                        boton.disabled = false;
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Por favor, inténtalo de nuevo más tarde.', 'error');
                }
            });
        } else {
            $("#asignatura").empty().prop("disabled", true);
        }
    });


    // Manejar el clic en el botón "guardar"
    $('.btn-guardar').click(function () {       
        var botonGuardar = $(this); // Referencia al botón original     
        var id_curso_asignatura = $(this).data('id_curso_asignatura');
        var fila = $(this).closest('tr');
        var documento = fila.find('td:nth-child(1)').text().trim();
        var ser = fila.find('td:nth-child(3) input').val();
        var saber = fila.find('td:nth-child(4) input').val();
        var hacer = fila.find('td:nth-child(5) input').val();
        var promedioInput = fila.find('td:nth-child(6) input');

    
        if(ser=="" || saber=="" || hacer==""){
            Swal.fire(
                'Alerta',
                'Debe ingresar las tres notas',
                'warning'
              )
        }
        else{
            if(!validarRango(ser,saber,hacer)){
                Swal.fire(
                    'Alerta',
                    'Ingrese valores válidos (0 a 5)',
                    'warning'
                  )
            }
            else{
                // Enviar una solicitud AJAX al controlador
                $.ajax({
                    url: baseUrl + 'guardarCalificaciones',
                    type: 'POST',
                    data: {
                        id_curso_asignatura: id_curso_asignatura,
                        documento: documento,
                        ser:ser,
                        saber:saber,
                        hacer:hacer
                    },
                    success: function (response) {
                        var resultado = JSON.parse(response); // Convertir la respuesta JSON a objeto
                        promedioInput.val(resultado);    
                        // Reemplazar el botón original con el nuevo botón
                        var botonActualizar = $('<a>', {
                            'type': 'button',
                            'class': 'botonEditar btn-sm btn-guardar-edicion',
                            'id': 'btnActualizar',
                            'title': 'Guardar Actualización',
                            'data-id_nota': botonGuardar.data('id_curso_asignatura'),
                            'data-id_curso_asignatura': botonGuardar.data('id_curso_asignatura')
                        }).append($('<i>', {
                            'class': 'fas fa-pencil-alt',
                            'aria-hidden': 'true'
                        }));
                    
                        botonGuardar.replaceWith(botonActualizar);

                        setTimeout(refreshPage, 1);
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                        alert('Error en la solicitud AJAX: ' + error);
                    }
                });
            }
            

        }
      
    });

   

    // Manejar el clic en el botón "Actualizar nota"
    $(document).on('click', '.btn-guardar-edicion', function () {            
        var id_nota = $(this).data('id_nota');
        var id_curso_asignatura = $(this).data('id_curso_asignatura');
        var fila = $(this).closest('tr');
        var documento = fila.find('td:nth-child(1)').text().trim();
        var ser = fila.find('td:nth-child(3) input').val();
        var saber = fila.find('td:nth-child(4) input').val();
        var hacer = fila.find('td:nth-child(5) input').val();
        var promedioInput = fila.find('td:nth-child(6) input');

        if(ser=="" || saber=="" || hacer==""){
            Swal.fire(
                'Alerta',
                'Debe ingresar las tres notas',
                'warning'
              )
        }
        else{
            if(!validarRango(ser,saber,hacer)){

                alert(ser+"   "+saber+"   "+hacer)

                Swal.fire(
                    'Alerta',
                    'Ingrese valores válidos (0 a 5)',
                    'warning'
                  )
            }
            else{
                //Enviar una solicitud AJAX al controlador
                $.ajax({
                    url: baseUrl + 'actualizarCalificaciones',
                    type: 'POST',
                    data: {
                        id_nota:id_nota,
                        id_curso_asignatura: id_curso_asignatura,
                        documento: documento,
                        ser:ser,
                        saber:saber,
                        hacer:hacer
                    },
                    success: function (response) {
                        var resultado = JSON.parse(response); // Convertir la respuesta JSON a objeto
                        promedioInput.val(resultado);
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                        alert('Error en la solicitud AJAX: ' + error);
                    }
                });

            }
        
        }
        
    });


});


function validarRango(ser, saber, hacer){
    const numero1 = parseFloat(ser);
    const numero2 = parseFloat(saber);
    const numero3 = parseFloat(hacer);
    if(numero1<0 || numero1>5 || numero2<0 || numero2>5 || numero3<0 || numero3>5){
        return false
    }
    else{
        return true
    }

}

function refreshPage() {
    location.reload();
  }

function asignarCalificaciones(){

    var curso = document.getElementById('curso');
    var asignatura = document.getElementById('asignatura');
    var selectedCurso= curso.selectedIndex;

    if (selectedCurso==0) {
        Swal.fire(
            'Alerta',
            'Debe seleccionar un curso y una asignatura',
            'warning'
          )
    } 
    else {
        $("#formAsignar").submit(); // Enviar el formulario
    }

}