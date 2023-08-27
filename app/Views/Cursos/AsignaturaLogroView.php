<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>

<!--DATATABLES-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap.min.css">

<div class="content container-fluid"><br>
    <div class="card" id="contenedor">
        <div class="card-header text-center" id="titulo">
            <img src="..\public\img\notas.png" alt="usuarios" class="icono-sidebar" /><b> Asignación de Porcentajes</b>
        </div>
        <div class="card-body" id="area">
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
            <form method="POST" action="<?= base_url('/asignarPorcentaje'); ?>" name="formAsignar" id="formAsignar"
                class="mt-4">
                <div class="row mt-3">
                    <div class="col-md-2">
                        <label class="control-label"><b>Código Curso:</b></label>
                    </div>
                    <div class="col-md-6">
                        <select name="curso" id="curso" class="form-select">
                            <option disabled selected>Seleccione un curso</option>
                            <?php foreach ($cursosAsignatura as $cursosAsignatura): ?>
                            <option value="<?= $cursosAsignatura['id_curso_asignatura']; ?>">
                                <?= $cursosAsignatura['id_curso_asignatura']; ?>
                            </option>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-2">
                        <label class="control-label"><b>Logro:</b></label>
                    </div>
                    <div class="col-md-6">
                        <select name="logro" id="logro" class="form-select">
                            <option disabled selected>Seleccione Logro</option>
                            <?php foreach ($logros as $logros): ?>
                            <option value="<?= $logros['id_logro']; ?>">
                                <?= $logros['nombre_logro']; ?>
                            </option>
                            </option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-2">
                        <label for="porcenteje" class="control-label"><b>Porcentaje:</b></label>
                    </div>
                    <div class="col-md-6">
                        <input type="range" class="form-range" id="porcenteje" name="porcenteje" min="0.01" max="0.99" step="0.01">
                        <span id="porcenteje-value">0</span> 
                        <small class="text-muted" id="porcenteje-error"></small>
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col-md-2">
                        <label for="periodo" class="control-label"><b>Periodo:</b></label>
                    </div>
                    <div class="col-md-6">
                        <select id="periodo" name="periodo" class="form-select">
                            <option disabled selected>Seleccione Periodo</option>
                            <option value="PRIMER PERIODO">PRIMER PERIODO</option>
                            <option value="SEGUNDO PERIODO">SEGUNDO PERIODO</option>
                            <option value="TERCER PERIODO">TERCER PERIODO</option>
                            <option value="CUARTO PERIODO">CUARTO PERIODO</option>

                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="botonRegistrar" id="asignar" name="asignar">
                            <i class="fa fa-file"></i>&nbsp;&nbsp;Almacenar
                        </button>
                    </div>
                </div>
            </form>


            <!-- Tabla para mostrar los estudiantes -->
            <div class="mt-4 table-container">
                <table class="table mt-4 table-striped table-bordered table-container" id="tablaPorcentaje"
                    name="tablaPorcentaje" style="width:100%">
                    <thead class="headerTable bordered-table text-center">
                        <tr class="text-center">
                            <th scope="col">Codigo Porcentaje</th>
                            <th scope="col">Nombre Profesor</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Asignatura</th>
                            <th scope="col">Logro</th>
                            <th scope="col">Porcentaje</th>
                            <th scope="col">Periodo</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="bordered-table bodyTable normal" style="font-weight:normal">
                        <?php foreach ($asignaturaLogro as $asignaturasLogro): ?>
                        <tr >
                            <th class="normal">
                                <?= $asignaturasLogro['id_asignatura_logro']; ?>
                            </th>
                            <th class="normal">
                                <?= $asignaturasLogro['nombre']; ?>
                            </th>
                            <th class="normal">
                                <?= $asignaturasLogro['nombre_curso']; ?>
                            </th>
                            <th class="normal">
                                <?= $asignaturasLogro['area_asignatura']; ?>
                            </th>
                            <th class="normal">
                                <?= $asignaturasLogro['nombre_logro']; ?>
                            </th>
                            <th class="normal">
                                <?= $asignaturasLogro['porcenteje']; ?>
                            </th>
                            <th class="normal">
                                <?= $asignaturasLogro['periodo']; ?>
                            </th>
                            <th class="botonera" style="text-align:center;">
                                <a title="Editar"href="#" class="btn btn-info btn-sm edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editarModal<?= $asignaturasLogro['id_asignatura_logro']; ?>">
                                            <i id="pencil-icon" class="fas fa-pencil-alt" aria-hidden="true"></i>
                                </a>
                            </th>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar el porcentaje -->
<?php foreach ($asignaturaLogro as $asignaturasLogro): ?>
    <div class="modal fade" id="editarModal<?= $asignaturasLogro['id_asignatura_logro']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="editarModalLabel<?= $asignaturasLogro['id_asignatura_logro']; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header headerModal">
                <h5 class="modal-title" id="editarModalLabel<?= $asignaturasLogro['id_asignatura_logro']; ?>">Editar
                    Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de edición -->
                <form action="<?= base_url('/editarAsignaturaLogro'); ?>" method="post">
                    <input type="hidden" name="id_asignatura_logro" value="<?= $asignaturasLogro['id_asignatura_logro']; ?>">
                    <div class="form-group">
                        <label for="editarPorcentaje">Nuevo Porcentaje:</label>
                        <input type="number" class="form-control" id="editarPorcentaje" name="editarPorcentaje"
                            placeholder="Nuevo Porcentaje" step="0.01" min="0.01" max="0.99" value="<?= $asignaturasLogro['porcenteje']; ?>">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn botonRegistrar">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#tablaPorcentaje').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
        });
    });

    const porcentajeInput = document.getElementById('porcenteje');
    const porcentajeValue = document.getElementById('porcenteje-value');

    porcentajeInput.addEventListener('input', function () {
        porcentajeValue.textContent = porcentajeInput.value;
    });


</script>



<?php echo $this->endSection() ?>