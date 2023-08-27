

document.addEventListener('DOMContentLoaded', function () {

    // Obtener todos los botones "Ver" y agregarles un evento click
    const verButtons = document.querySelectorAll('.btn-ver');
    verButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Obtener los datos de docente a partir de los atributos de datos HTML
            const docenteData = JSON.parse(this.getAttribute('data-bs-docente'));

            // Llenar los datos del modal con la información del docente
            document.getElementById('modal-docente-documento').textContent = docenteData.documento;
            document.getElementById('modal-docente-nombre').textContent = docenteData.nombre;
            document.getElementById('modal-docente-correo').textContent = docenteData.correo;
            document.getElementById('modal-docente-fecha_nacimiento').textContent = docenteData.fecha_nacimiento ? docenteData.fecha_nacimiento : '';
            document.getElementById('modal-docente-telefono').textContent = docenteData.numero_telefono ? docenteData.numero_telefono : '';
            document.getElementById('modal-docente-direccion_residencial').textContent = docenteData.direccion_residencial ? docenteData.direccion_residencial : '';
            document.getElementById('modal-docente-fecha_inicio_empleo').textContent = docenteData.fecha_inicio_empleo ? docenteData.fecha_inicio_empleo : '';
            document.getElementById('modal-docente-doc_contactosemergencia').textContent = docenteData.doc_contactosemergencia ? docenteData.doc_contactosemergencia : '';
            document.getElementById('modal-docente-nombre_emergencia').textContent = docenteData.nombre_emergencia ? docenteData.nombre_emergencia : '';
            document.getElementById('modal-docente-telefono_emergencia').textContent = docenteData.telefono_emergencia ? docenteData.telefono_emergencia : '';
            document.getElementById('modal-docente-titulo_academico').textContent = docenteData.titulo_academico ? docenteData.titulo_academico : '';
            document.getElementById('modal-docente-especializacion').textContent = docenteData.especializacion ? docenteData.especializacion : '';
        });
    });


});