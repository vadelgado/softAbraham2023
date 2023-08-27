<?php echo $this->extend('layout\layout') ?>

<?php echo $this->section('content') ?>

<!--DATATABLES-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap.min.css" />

<div class="content container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header text-center">
                    <img src="..\public\img\form_docente.png" alt="Formulario Docentes"
                        class="icono-sidebar" /><b>DOCENTES REGISTRADOS</b>
                </div>
                <div class="card-body">
                    <div class="text-right">
                        <a href="<?php echo base_url('crearProfesor')?>" type="button" class="btn btn-primary">
                            <i class="fas fa-plus" id="pencil-icon" aria-hidden="true"></i>&nbsp;&nbsp;Nuevo Docente</a>
                    </div>

                    <div class="mt-4 table-container">
                        <table class="table mt-4 table-striped table-bordered table-container" 
                        id="miTablaProfesores"name="miTablaProfesores" style="width:100%">
                            <thead class="headerTable bordered-table text-center">
                                <tr class="text-center">
                                    <th>Nombre</th>
                                    <th>Identificación</th>
                                    <th>Título Académico</th>
                                    <th>opciones </th>
                                </tr>
                            </thead>
                            <tbody class="bordered-table bodyTable normal" style="font-weight:normal">
                                <?php foreach ($docentesCompletos as $docente) : ?>
                                <tr>
                                    <td>
                                        <?= $docente['nombre']; ?>
                                    </td>
                                    <td>
                                        <?= $docente['documento']; ?>
                                    </td>
                                    <td>
                                        <?= isset($docente['titulo_academico']) ? $docente['titulo_academico'] : ''; ?>
                                    </td>
                                    <td class="botonera"  style="text-align: center;">
                                        <!-- Formulario oculto para enviar los datos del profesor -->
                                        <form action="<?= base_url('editarProfesores') ?>" method="post">
                                            <!-- Campo oculto con el ID del profesor -->
                                            <input type="hidden" name="usuario_id"
                                                value="<?= $docente['id_usuario'] ?>" />
                                            <!-- Botón para editar el profesor -->
                                            <button title="Editar"  type="submit" class="btn btn-info btn-sm">
                                                <i id="pencil-icon" class="fas fa-pencil-alt" aria-hidden="true"></i>
                                            </button>
                                        </form>                                        
                                        <a title="Mostrar" href="#" type="button" class="btn btn-warning btn-sm btn-ver"                                            
                                            data-bs-docente="<?= htmlspecialchars(json_encode($docente), ENT_QUOTES, 'UTF-8') ?>"                                            
                                            data-bs-toggle="modal" data-bs-target="#mostrarDatosDocenteModal">
                                            <i class="fas fa-eye" id="pencil-icon" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para mostrar los detalles del profesor -->
<div class="modal fade" id="mostrarDatosDocenteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Datos Personales Docente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><b>Documento:</b> <span id="modal-docente-documento"></span></p>
                <p><b>Nombre:</b> <span id="modal-docente-nombre"></span></p>
                <p><b>Correo:</b> <span id="modal-docente-correo"></span></p>
                <p><b>Fecha Nacimiento:</b> <span id="modal-docente-fecha_nacimiento"></span></p>
                <p><b>Número de Teléfono:</b> <span id="modal-docente-telefono"></span></p>
                <p><b>Dirección de Residencia:</b> <span id="modal-docente-direccion_residencial"></span></p>
                <p><b>Fecha de Contratación:</b> <span id="modal-docente-fecha_inicio_empleo"></span></p>
                <p><b>Documento Contacto de Emergencia:</b> <span id="modal-docente-doc_contactosemergencia"></span></p>
                <p><b>Nombre Contacto de Emergencia:</b> <span id="modal-docente-nombre_emergencia"></span></p>
                <p><b>Teléfono Contacto de Emergencia:</b> <span id="modal-docente-telefono_emergencia"></span></p>
                <p><b>Título Académico:</b> <span id="modal-docente-titulo_academico"></span></p>
                <p><b>Especialización:</b> <span id="modal-docente-especializacion"></span></p>                                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
    $('#miTablaProfesores').DataTable(
        {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
        }
    );

});
</script>
<script id="base-url" data-url="<?php echo base_url(); ?>"></script>
<script src="../public/js/listDocent.js"></script>

<?php echo $this->endSection() ?>