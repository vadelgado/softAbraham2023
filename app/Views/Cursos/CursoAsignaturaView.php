|<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap.min.css">

<div class="content container-fluid mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header text-center">
                    <img src="..\public\img\confCurso.png" alt="Formulario Docentes"
                        class="icono-sidebar" /><b>CONFIGURAR CURSOS</b>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('mensajeError')): ?>
                    <div class="alert alert-danger mt-2 alert-dismissible fade show">
                        <?php echo session()->getFlashdata('mensajeError'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('mensaje')): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?php echo session()->getFlashdata('mensaje'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>
                    <?= form_open('agregarDatosSelect'); ?>
                    <div class="row">
                        <div class="col-2">
                            <label for="curso_id" class="form-label"><b>Curso:</b></label>
                        </div>
                        <div class="col-6">
                            <select name="curso_id" id="curso_id" class="form-select">
                                <option value="" selected disabled>Seleccione un curso</option>
                                <?php foreach ($cursos as $curso): ?>
                                <option value="<?= $curso['id_curso']; ?>">
                                    <?= $curso['nombre_curso']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-2">
                            <label for="asignatura_id" class="form-label"  > <b>Asignatura:</b> </label>
                        </div>
                        <div class="col-6">
                            <select name="asignatura_id" id="asignatura_id" class="form-select">
                                <option value="" selected disabled>Seleccione una asignatura</option>
                                <?php foreach ($asignaturas as $asignatura): ?>
                                <option value="<?= $asignatura['id_asignatura']; ?>">
                                    <?= $asignatura['area_asignatura']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-2">
                            <label for="profesor_id" class="form-label"><b>Profesor:</b></label>
                        </div>
                        <div class="col-6">
                            <select name="profesor_id" id="profesor_id" class="form-select">
                                <option value="" selected disabled>Seleccione un profesor</option>
                                <?php foreach ($profesores as $profesor): ?>
                                <option value="<?= $profesor['id']; ?>">
                                    <?= $profesor['nombre_usuario']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <button class="botonRegistrar btn btn-primary" type="submit">
                            <i class="fas fa-save"></i>&nbsp; Guardar &nbsp;
                        </button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content container-fluid mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header text-center">
                    <img src="..\public\img\listasign.png" alt="icono" class="icono-sidebar" />
                    <b>Lista de Cursos Con Asignatura Registrados</b>
                </div>
                <div class="card-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-container" id="miTablaCA"
                            name="miTablaCA" style="width:100%">
                            <thead class="headerTable bordered-table text-center">
                                <tr class="text-center">
                                    <th scope="col">Orden de registro</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Asignatura</th>
                                    <th scope="col">Profesor</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="bordered-table bodyTable normal" style="font-weight:normal">
                                <?php foreach ($cursosAsignatura as $cursoAsignatura): ?>
                                <tr>
                                    <th class="normal">
                                        <?= $cursoAsignatura['id_curso_asignatura']; ?>
                                    </th>
                                    <th class="normal">
                                        <?= $cursoAsignatura['nombre_curso']; ?>
                                    </th>
                                    <th class="normal">
                                        <?= $cursoAsignatura['area_asignatura']; ?>
                                    </th>
                                    <th class="normal">
                                        <?= $cursoAsignatura['nombre_profesor']; ?>
                                    </th>
                                    <th class="botonera" style="text-align:center;">
                                        <?php if ($cursoAsignatura['estadoca']): ?>
                                        <a title="Editar"href="#" class="btn btn-info btn-sm edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editarModal<?= $cursoAsignatura['id_curso_asignatura']; ?>">
                                            <i id="pencil-icon" class="fas fa-pencil-alt" aria-hidden="true"></i>
                                        </a>&nbsp;
                                        <?php else: ?>
                                        <a title="Editar"href="#" class="btn btn-info btn-sm edit-btn disabled" data-bs-toggle="modal"
                                            data-bs-target="#editarModal<?= $cursoAsignatura['id_curso_asignatura']; ?>">
                                            <i id="pencil-icon" class="fas fa-pencil-alt" aria-hidden="true"></i>
                                        </a>&nbsp;
                                        <?php endif; ?>
                                        <form action="<?= base_url('/inactivarActivarRegistroAC'); ?>" method="post"
                                            id="formularioInactivar<?= $cursoAsignatura['id_curso_asignatura']; ?>">
                                            <!-- Campos ocultos o datos necesarios para identificar el registro a inactivar/activar -->
                                            <input type="hidden" name="id_curso_asignatura"
                                                value="<?= $cursoAsignatura['id_curso_asignatura']; ?>">
                                            <input type="hidden" name="estadoca"
                                                value="<?= $cursoAsignatura['estadoca']; ?>">
                                            <!-- Resto de los campos del formulario... -->
                                            &nbsp; <button title="Activar/Inactivar"type="submit" class="btn btn-sm btn-danger"><i class="fas fa-ban"
                                                    id="pencil-icon" aria-hidden="true"></i></button>
                                        </form>
                                    </th>
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
<!-- Modal de edición -->
<?php foreach ($cursosAsignatura as $cursoAsignatura): ?>
<div class="modal fade" id="editarModal<?= $cursoAsignatura['id_curso_asignatura']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="editarModalLabel<?= $cursoAsignatura['id_curso_asignatura']; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header headerModal">
                <h5 class="modal-title" id="editarModalLabel<?= $cursoAsignatura['id_curso_asignatura']; ?>">Editar
                    Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de edición -->
                <form action="<?= base_url('/AsignaturaCursosGuardarEdicion'); ?>" method="post">
                    <!-- Campos de edición -->
                    <input type="hidden" name="id_curso_asignatura"
                        value="<?= $cursoAsignatura['id_curso_asignatura']; ?>">
                    <div class="mb-3">
                        <label for="curso_id" class="form-label"><b>Curso:</b></label>
                        <select name="curso_id" id="curso_id" class="form-select">
                            <?php foreach ($cursos as $curso): ?>
                            <option value="<?= $curso['id_curso']; ?>"
                                <?=$cursoAsignatura['curso_id']==$curso['id_curso'] ? 'selected' : '' ; ?>>
                                <?= $curso['nombre_curso']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="asignatura_id" class="form-label"><b>Asignatura:</b></label>
                        <select name="asignatura_id" id="asignatura_id" class="form-select">
                            <?php foreach ($asignaturas as $asignatura): ?>
                            <option value="<?= $asignatura['id_asignatura']; ?>"
                                <?=$cursoAsignatura['asignatura_id']==$asignatura['id_asignatura'] ? 'selected' : '' ;
                                ?>>
                                <?= $asignatura['area_asignatura']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="profesor_id" class="form-label"><b>Profesor:</b></label>
                        <select name="profesor_id" id="profesor_id" class="form-select">
                            <?php foreach ($profesores as $profesor): ?>
                            <option value="<?= $profesor['id']; ?>" <?=$cursoAsignatura['profesor_id']==$profesor['id']
                                ? 'selected' : '' ; ?>>
                                <?= $profesor['nombre_usuario']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn botonRegistrar">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#miTablaCA').DataTable(
            {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
            }
        );

    });
</script>
<script id="base-url" data-url="<?php echo base_url(); ?>"></script>

<?php echo $this->endSection() ?>