<!-- app/Views/createDocentsAndStudents/newDocent.php -->

<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>

<div class="content container-fluid"><br>
    <div class="card" id="contenedor">
        <div class="card-header text-center" id="titulo">
            <b>Registrar Profesor</b>
        </div>
        <div class="card-body" id="area">
            <form method="post" action="<?= base_url('crearProfesor'); ?>">
                <div class="row mb-3 d-flex justify-content-between align-items-end">
                    <div class="col-md-6">
                        <label for="usuario_id" class="form-label">Documento Usuario Asociado:</label>
                        <input class="form-control" type="text" name="search_term" id="search_term" >
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-info text-white">
                        <i class="fa fa-search" aria-hidden="true"></i>&nbsp;Buscar</button>
                    </div>
                </div>
            </form>

            <?php if (isset($mensaje)): ?>
                <!-- Mostrar mensaje de error si no se encontró el docente -->
                <div class="alert alert-info">
                    <?= $mensaje ?>
                </div>

            <?php elseif (isset($error)): ?>
                <!-- Mostrar mensaje de error si no se encontró el docente -->
                <div class="alert alert-danger">
                    <?= $error ?>
                </div>
            <?php elseif (isset($nombre) && isset($correo)): ?>
                <!-- Mostrar el nombre, el correo y el id del usuario si se encontró el docente -->
                <form action="<?= base_url().'guardarProfesor' ?>" method="post" enctype="multipart/form-data" id="formularioProfesor">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre Completo:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $nombre ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="correo" class="form-label">Correo:</label>
                            <input type="text" class="form-control" id="correo" name="correo" value="<?= $correo ?>" readonly>
                        </div>
                        <div>
                            <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?= $id_usuario ?>" readonly>
                        </div>
                    </div>

                    <!-- Formulario Profesor -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="numero_telefono" class="form-label">Número de Teléfono:</label>
                            <input type="text" class="form-control" id="numero_telefono" name="numero_telefono" >
                        </div>
                        <div class="col-md-6">
                            <label for="direccion_residencial" class="form-label">Dirección Residencial:</label>
                            <input type="text" class="form-control" id="direccion_residencial" name="direccion_residencial" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fecha_inicio_empleo" class="form-label">Fecha de Inicio de Empleo:</label>
                            <input type="date" class="form-control" id="fecha_inicio_empleo" name="fecha_inicio_empleo" >
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="titulo_academico" class="form-label">Título Académico:</label>
                            <input type="text" class="form-control" id="titulo_academico" name="titulo_academico" >
                        </div>
                        <div class="col-md-6">
                            <label for="especializacion" class="form-label">Especialización:</label>
                            <input type="text" class="form-control" id="especializacion" name="especializacion" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre_emergencia" class="form-label">Nombre de Contacto de Emergencia:</label>
                            <input type="text" class="form-control" id="nombre_emergencia" name="nombre_emergencia" >
                        </div>
                        <div class="col-md-6">
                            <label for="telefono_emergencia" class="form-label">Teléfono de Contacto de Emergencia:</label>
                            <input type="text" class="form-control" id="telefono_emergencia" name="telefono_emergencia" >
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="doc_contactosemergencia" class="form-label">Documento de Contacto de Emergencia:</label>
                            <input type="text" class="form-control" id="doc_contactosemergencia" name="doc_contactosemergencia" >
                        </div>
                    </div>

                    <!-- Botón Registrar -->
                    <div class="row mb-3">
                        <div class="text-center mt-4">
                            <a href="<?php echo base_url()?>listarProfesores" type="button" class="botonRegresar text-decoration-none">
                            <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>&nbsp;&nbsp;Regresar</a>

                            <button type="submit" class="botonRegistrar" name="registrar_profesor">
                            <i class="fas fa-save"></i> &nbsp;Registrar Profesor</button>

                            <button class="botonLimpiar" type="reset">
                            <i class="fas fa-broom"></i>&nbsp; Limpiar &nbsp;
                            </button>                            
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
  // Función para validar el formulario
  function validarFormulario() {
    // Obtener los valores de los campos del formulario
    const numero_telefono = document.getElementById("numero_telefono").value;
    const direccion_residencial = document.getElementById("direccion_residencial").value;
    const fecha_inicio_empleo = document.getElementById("fecha_inicio_empleo").value;
    const fecha_nacimiento = document.getElementById("fecha_nacimiento").value;
    const titulo_academico = document.getElementById('titulo_academico').value;
    const especializacion = document.getElementById('especializacion').value;
    const nombre_emergencia = document.getElementById('nombre_emergencia').value;
    const telefono_emergencia = document.getElementById('telefono_emergencia').value;
    const doc_contactosemergencia = document.getElementById('doc_contactosemergencia').value;
      

    // Realizar las validaciones que desees aquí
    if (numero_telefono === "") {
      mostrarError("El campo Número de Teléfono es obligatorio.");
      return false; // Detener el envío del formulario
    }

    if (direccion_residencial === "") {
      mostrarError("El campo Dirección Residencial es obligatorio.");
      return false;
    }

    if (fecha_inicio_empleo === "") {
      mostrarError("El campo Fecha de Inicio de Empleo es obligatorio.");
      return false;
    }

    if (fecha_nacimiento === "") {
      mostrarError("El campo Fecha de Nacimiento es obligatorio.");
      return false;
    }

    if (titulo_academico === "") {
      mostrarError("El campo título academico es obligatorio.");
      return false;
    }
   
    if (especializacion === "") {
      mostrarError("El campo Especialización es obligatorio.");
      return false;
    }

    if (nombre_emergencia === "") {
      mostrarError("El campo del Nombre del contacto de emergencia es obligatorio.");
      return false;
    }

    if (telefono_emergencia === "") {
      mostrarError("El campo del teléfono del contacto de emergencia es obligatorio.");
      return false;
    }

    if (doc_contactosemergencia === "") {
      mostrarError("El campo del documento del contacto de emergencia es obligatorio.");
      return false;
    }   

    // Si todas las validaciones pasan, el formulario se enviará
    return true;
  }

  // Función para mostrar un mensaje de error con SweetAlert2
  function mostrarError(mensaje) {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: mensaje,
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Aceptar",
    });
  }

  // Agregar el evento onsubmit al formulario
  const form = document.getElementById("formularioProfesor");
  form.onsubmit = validarFormulario;
</script>

<?= $this->endSection() ?>