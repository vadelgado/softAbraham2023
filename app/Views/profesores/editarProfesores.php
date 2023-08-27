<!-- editarProfesores.php -->
<?php echo $this->extend('layout/layout') ?>

<?php echo $this->section('content') ?>

<!-- editarProfesores.php -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Editar Datos del Profesor</h5>
    </div>
    <div class="card-body">
        <form id="formActualizarProfesor" name="formActualizarProfesor" action="<?= base_url('actualizarProfesor') ?>" method="post">
           
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="documento" class="form-label">Número de Documento:</label>
                    <input id="usuario_id" name="usuario_id" class="form-control" readonly value="<?= $profesor['usuario_id'] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" value="<?= $profesor['fecha_nacimiento'] ?>" >
                </div>
                <div class="col-md-6">
                    <label for="numero_telefono" class="form-label">Número de Teléfono:</label>
                    <input type="text"id="numero_telefono" name="numero_telefono" class="form-control" value="<?= $profesor['numero_telefono'] ?>" >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="direccion_residencial" class="form-label">Dirección Residencial:</label>
                    <input type="text"  id="direccion_residencial" name="direccion_residencial" class="form-control" value="<?= $profesor['direccion_residencial'] ?>" >
                </div>
                <div class="col-md-6">
                    <label for="fecha_inicio_empleo" class="form-label">Fecha de Inicio de Empleo:</label>
                    <input type="date" id="fecha_inicio_empleo" name="fecha_inicio_empleo" class="form-control" value="<?= $profesor['fecha_inicio_empleo'] ?>" >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="doc_contactosemergencia" class="form-label">Documento de Contacto de Emergencia:</label>
                    <input type="number" id="doc_contactosemergencia" name="doc_contactosemergencia" class="form-control" value="<?= $profesor['doc_contactosemergencia'] ?>" >
                </div>
                <div class="col-md-6">
                    <label for="nombre_emergencia" class="form-label">Nombre de Contacto de Emergencia:</label>
                    <input type="text" id="nombre_emergencia" name="nombre_emergencia" class="form-control" value="<?= $profesor['nombre_emergencia'] ?>" >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="telefono_emergencia" class="form-label">Teléfono de Contacto de Emergencia:</label>
                    <input type="text" id="telefono_emergencia" name="telefono_emergencia" class="form-control" value="<?= $profesor['telefono_emergencia'] ?>" >
                </div>
                <div class="col-md-6">
                    <label for="titulo_academico" class="form-label">Título Académico:</label>
                    <input type="text" id="titulo_academico" name="titulo_academico" class="form-control" value="<?= $profesor['titulo_academico'] ?>" >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="especializacion" class="form-label">Especialización:</label>
                    <input type="text" id="especializacion" name="especializacion" class="form-control" value="<?= $profesor['especializacion'] ?>" >
                </div>
            </div>

            <div class="text-center">
            <button class="botonRegistrar" onclick=ActualizarDocente() type="button">
                <i class="fas fa-save"></i>&nbsp; Guardar cambios &nbsp;</button>
            </div>
        </form>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function ActualizarDocente(){
    if(!validateFields()){
        return;
    }else{
        alert('entro');
        $("#formActualizarProfesor").submit();
        
    }
}

function validateFields() {
        const fechaNacimientoInput = document.getElementById('fecha_nacimiento');
        const numeroTelefonoInput = document.getElementById('numero_telefono');
        const direccionResidencialInput = document.getElementById('direccion_residencial');
        const fechaInicioEmpleoInput = document.getElementById('fecha_inicio_empleo');
        const docContactoEmergenciaInput = document.getElementById('doc_contactosemergencia');
        const nombreEmergenciaInput = document.getElementById('nombre_emergencia');
        const telefonoEmergenciaInput = document.getElementById('telefono_emergencia');
        const tituloAcademicoInput = document.getElementById('titulo_academico');
        const especializacionInput = document.getElementById('especializacion');

        // Validar que los campos no estén vacíos
        if (fechaNacimientoInput.value.trim() === '') {
            Swal.fire('Error', 'Fecha de nacimiento es obligatoria', 'warning');
            return false;
        }
        if (numeroTelefonoInput.value.trim() === '') {
            Swal.fire('Error', 'Número de teléfono es obligatorio', 'warning');
            return false;
        }
        if (direccionResidencialInput.value.trim() === '') {
            Swal.fire('Error', 'Dirección residencial es obligatoria', 'warning');
            return false;
        }
        if (fechaInicioEmpleoInput.value.trim() === '') {
            Swal.fire('Error', 'Fecha de inicio de empleo es obligatoria', 'warning');
            return false;
        }
        if (docContactoEmergenciaInput.value.trim() === '') {
            Swal.fire('Error', 'Documento de contacto de emergencia es obligatorio', 'warning');
            return false;
        }
        if (nombreEmergenciaInput.value.trim() === '') {
            Swal.fire('Error', 'Nombre de contacto de emergencia es obligatorio', 'warning');
            return false;
        }
        if (telefonoEmergenciaInput.value.trim() === '') {
            Swal.fire('Error', 'Teléfono de contacto de emergencia es obligatorio', 'warning');
            return false;
        }
        if (tituloAcademicoInput.value.trim() === '') {
            Swal.fire('Error', 'Título académico es obligatorio', 'warning');
            return false;
        }
        if (especializacionInput.value.trim() === '') {
            Swal.fire('Error', 'Especialización es obligatoria', 'warning');
            return false;
        }

        // Validar el formato de fecha de nacimiento y fecha de inicio de empleo (puedes agregar más validaciones según tus necesidades)
        // Aquí solo se muestra un ejemplo básico para los campos mencionados

        const fechaNacimientoPattern = /^\d{4}-\d{2}-\d{2}$/;
        if (!fechaNacimientoPattern.test(fechaNacimientoInput.value)) {
            Swal.fire('Error', 'Fecha de nacimiento no es válida. Formato: YYYY-MM-DD', 'warning');
            return false;
        }

        const fechaInicioEmpleoPattern = /^\d{4}-\d{2}-\d{2}$/;
        if (!fechaInicioEmpleoPattern.test(fechaInicioEmpleoInput.value)) {
            Swal.fire('Error', 'Fecha de inicio de empleo no es válida. Formato: YYYY-MM-DD', 'warning');
            return false;
        }

        return true;
    }
</script>
<?php echo $this->endSection() ?>




