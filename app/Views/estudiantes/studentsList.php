<?php echo $this->extend('layout\layout') ?>

<?php echo $this->section('content') ?>

<!--DATATABLES-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap.min.css">


<div class="content container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header text-center">
                    <img src="..\public\img\verEst.png" alt="usuarios" class="icono-sidebar" /><b>ESTUDIANTES</b>
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
                    <div class="mt-4">
                        <a href="<?php echo base_url()?>NuevoEstudiante" type="button" class="btn btn-primary">
                            <i class="fas fa-plus" id="pencil-icon" aria-hidden="true"></i>&nbsp;&nbsp;Nuevo
                            Estudiante
                        </a>
                    </div>
                    <div class="row align-items-center mb-3 mt-4">          
                        <div class="col-auto">
                            <label for="selectCurso">Selecciona un curso:</label>
                        </div>
                        <div class="col-auto">
                            <select id="selectCurso" class="form-select" onchange="handleSelectChange()">
                                <option disabled selected>seleccione....</option>
                                <?php foreach ($cursos as $curso) : ?>
                                <option value="<?php echo $curso['id_curso']; ?>">
                                    <?php echo $curso['nombre_curso']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-auto">
                            <a id="generarPDFBtn" class="btn btn-danger" disabled>
                                <i class="far fa-file-pdf me-2"></i>Generar PDF
                            </a>
                        </div>


                    <div class="col-auto">
                        <label for="selectCursoExcel">Selecciona un curso:</label>
                    </div>
                    <div class="col-auto">
                        <select id="selectCursoExcel" class="form-select" onchange="handleExcelSelectChange()">
                            <option disabled selected>seleccione....</option>
                            <?php foreach ($cursos as $curso) : ?>
                            <option value="<?php echo $curso['id_curso']; ?>">
                                <?php echo $curso['nombre_curso']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <a id="generarExcelBtn" class="btn btn-success" href="#" disabled>
                            <i class="far fa-file-excel me-2"></i>Generar Excel
                        </a>
                    </div>


                    <div class="mt-4 table-container">
                        <table class="table mt-4 table-striped table-bordered table-container" id="miTabla"
                            name="miTabla" style="width:100%">
                            <thead class="headerTable bordered-table text-center">
                                <tr class="text-center">
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Documento</th>
                                    <th scope="col">Fecha Registro</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="bordered-table bodyTable normal" style="font-weight:normal">
                                <?php foreach ($estudiantes as $estudiante) : ?>
                                <tr>
                                    <td>
                                        <?= $estudiante['nombre']; ?>
                                    </td>
                                    <td>
                                        <?= $estudiante['documento']; ?>
                                    </td>
                                    <td>
                                        <?= $estudiante['fecha_registro_estuediante']; ?>
                                    </td>
                                    <td>
                                        <?= $estudiante['celular_estudiante']; ?>
                                    </td>
                                    <td>
                                        <?= $estudiante['nombre_curso']; ?>
                                    </td>
                                    <td>
                                        <a href="#" type="button" class="btn btn-info btn-sm edit-btn" title="Editar"
                                            data-id_usuario="<?php echo $estudiante['id_usuario']; ?>">
                                            <i id="pencil-icon" class="fas fa-pencil-alt" aria-hidden="true"></i>
                                        </a>
                                        <a href="#" type="button" class="btn btn-warning btn-sm view-btn" title="Ver"
                                            data-id_usuario="<?php echo $estudiante['id_usuario']; ?>">
                                            <i class="fas fa-eye" id="pencil-icon" aria-hidden="true"></i></a>
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


<!-- Modal EDITAR -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:600px">
            <div class="modal-header headerModal text-center">
                <h4 class="modal-title " id="editModalLabel">Editar Estudiante</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?php echo base_url()?>ActualizarEstudiante" method="POST" id="formEditarEst">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="documento" class="form-label">Documento:</label>
                            <input type="text" class="form-control" id="documento" name="documento" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="correo" class="form-label">Correo:</label>
                            <input type="email" class="form-control" id="correo" name="correo" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="fechaReg" class="form-label"><b class="requerido">*&nbsp;</b>Fecha de
                                Registro:</label>
                            <input type="date" class="form-control" id="fechaReg" name="fechaReg" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="direccion" class="form-label"><b class="requerido">*&nbsp;</b>Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion">
                        </div>
                        <div class="col-md-6">
                            <label for="celular" class="form-label">Celular</label>
                            <input type="number" class="form-control" id="celular" name="celular">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="fechaNac" class="form-label"><b class="requerido">*&nbsp;</b>Fecha de
                                Nacimiento:</label>
                            <input type="date" class="form-control" id="fechaNac" name="fechaNac">
                        </div>
                        <div class="col-md-6">
                            <label for="genero" class="form-label">Género</label>
                            <select name="genero" id="genero" class="form-select">
                                <option disabled selected>seleccione....</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="curso" class="form-label"><b class="requerido">*&nbsp;</b>Curso
                                Matriculado:</label>
                            <select id="curso" name="curso" class="form-select">
                                <option value="">Seleccionar Curso</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="docAcudiente" class="form-label"><b class="requerido">*&nbsp;</b> N° de
                                Documento del acudiente</label>
                            <input type="text" class="form-control" id="docAcudiente" name="docAcudiente">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="nomAcudiente" class="form-label"><b class="requerido">*&nbsp;</b>Nombre
                                acudiente:</label>
                            <input type="text" class="form-control" id="nomAcudiente" name="nomAcudiente">
                        </div>
                        <div class="col-md-6">
                            <label for="telAcudiente" class="form-label"><b class="requerido">*&nbsp;</b>Teléfono
                                acudiente</label>
                            <input type="number" class="form-control" id="telAcudiente" name="telAcudiente">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="correoAcudiente" class="form-label">Correo acudiente:</label>
                            <input type="text" class="form-control" id="correoAcudiente" name="correoAcudiente">
                            <label id="correoError" class="error-label mt-2 " style="color:red"></label>
                        </div>
                    </div>
                    <input type="hidden" id="id_usuario" name="id_usuario">
                    <input type="hidden" id="id_estudiante" name="id_estudiante">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Cerrar</button>
                    <button class="botonRegistrar" onclick=EditarEstudiante() type="button">
                        <i class="fas fa-save"></i>&nbsp; Guardar cambios &nbsp;
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal VER -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header headerModal">
                <h4 class="modal-title " id="editModalLabel">Información Estudiante</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="userData"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!--Datatables-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="../public/js/editStudent.js"></script>
<script>
    function handleSelectChange() {
        var selectCurso = document.getElementById("selectCurso");
        var generarPDFBtn = document.getElementById("generarPDFBtn");

        if (selectCurso.value !== "") {
            generarPDFBtn.href = "<?php echo base_url()?>GenerarPDF/" + selectCurso.value;
            generarPDFBtn.removeAttribute("disabled");
        } else {
            generarPDFBtn.removeAttribute("href");
            generarPDFBtn.setAttribute("disabled", true);
        }
    }
    function handleExcelSelectChange() {
        var selectCursoExcel = document.getElementById("selectCursoExcel");
        var generarExcelBtn = document.getElementById("generarExcelBtn");

        if (selectCursoExcel.value !== "") {
            generarExcelBtn.href = "<?php echo base_url()?>curso/generateExcel/" + selectCursoExcel.value;
            generarExcelBtn.removeAttribute("disabled");
        } else {
            generarExcelBtn.removeAttribute("href");
            generarExcelBtn.setAttribute("disabled", true);
        }
    }
</script>

<script>
    $(document).ready(function () {
        $('#miTabla').DataTable(
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