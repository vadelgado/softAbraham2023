
<?php echo $this->extend('layout\layout') ?>

<?php echo $this->section('content') ?>

<!--DATATABLES-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap.min.css">

<div class="content container-fluid" ><br>
    <div class="card" id="contenedor">
        <div class="card-header text-center" id="titulo">
        <img src="..\public\img\notas.png" alt="usuarios"
                        class="icono-sidebar" /><b> Asignación de Calificaciones</b>
        </div>
        <div class="card-body" id="area">
            <?php if (!empty($mensaje)) : ?>
                <div class="alert alert-danger mt-2 alert-dismissible fade show">
                        <?php echo $mensaje; ?> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>      
            <form method="POST" action="<?php echo base_url()?>obtenerEstudiantes"
                name="formAsignar" id="formAsignar" class="mt-4">
                    <div class="row mt-3">
                        <div class="col-md-2">
                          <label class="control-label"><b>Curso:</b></label>
                        </div>
                        <div class="col-md-6">                             
                            <select name="curso" id="curso" class="form-select">
                                <option disabled selected>Seleccione un curso</option>
                                <?php foreach ($cursos as $curso): ?>
                                    <option value="<?php echo $curso['id_curso']; ?>"><?php echo $curso['nombre_curso']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2">
                          <label for="asignatura" class="control-label"><b>Asignatura:</b></label>
                        </div>
                        <div class="col-md-6">                             
                            <select id="asignatura" name="asignatura" disabled class="form-select">
                                 <option value="">Seleccione una asignatura</option>
                             </select>
                        </div>
                        <div class="col-md-2">
                          <button type="button"  onclick="asignarCalificaciones()" class="botonRegistrar" id="asignar" name="asignar"> <i class="fa fa-file"></i>&nbsp;&nbsp;Asignar</button>
                        </div>
                    </div>                           
                </form>
                 
                <div class="mt-4 ">
                    <?php if ($nomCursoAsig['area_asignatura']!=""): ?>
                        <div class="alert alert-info text-center">
                            Asignación de calificaciones para la materia <b> <?= $nomCursoAsig['area_asignatura'] ?></b> 
                            perteneciente al curso <b> <?= $nomCursoAsig['nombre_curso'] ?>
                        </div>
                    <?php endif; ?>       
                </div>
                <!-- Tabla para mostrar los estudiantes -->
                <div class="mt-4 table-container" >
                     <table class="table mt-4 table-striped table-bordered table-container" 
                        id="miTabla" name="miTabla" style="width:100%">
                        <thead class="headerTable bordered-table text-center">
                            <tr class="text-center">
                                <th scope="col" width="16%">Documento</th>
                                <th scope="col" width="16%">Nombre</th>
                                <th scope="col" width="13%">Ser</th>
                                <th scope="col" width="13%">Saber</th>
                                <th scope="col" width="13%" >Hacer</th>
                                <th scope="col" width="15%" >Nota Parcial</th>
                                <th scope="col" width="14%">Opciones</th>

                                
                            </tr>
                        </thead>
                        <tbody class="bordered-table bodyTable normal" style="font-weight:normal">
                            <?php foreach ($estudiantes as $estudiante) : ?>
                            <tr>
                                <td>
                                    <?= $estudiante['documento']; ?>
                                </td>
                                <td>
                                    <?= $estudiante['nombre']; ?>
                                </td>
                                <td>
                                    <input type="number" class="form-control" min=1 max=5>
                                </td>
                                <td>
                                    <input type="number" class="form-control" min=1 max=5>
                                </td>
                                <td>
                                    <input type="number" class="form-control" min=1 max=5>
                                </td>
                                <td>
                                    <input type="number" class="form-control" readonly>
                                </td>
                                <td>
                                <a type="button" class="botonRegistrar btn-sm btn-guardar" title="Guardar" data-id_curso_asignatura="<?php echo $estudiante['id_curso_asignatura']; ?>" >
                                  <i id="pencil-icon" class="fas fa-save" aria-hidden="true"></i>
                                </a>
                                </td>                             
                            </tr>
                            <?php endforeach; ?>
                            <?php foreach ($estudiantesConNota as $estudiante) : ?>
                            <tr>
                                <td>
                                    <?= $estudiante['documento']; ?>
                                </td>
                                <td>
                                    <?= $estudiante['nombre']; ?>
                                </td>
                                <td>
                                    <input type='number' class="form-control" min=1 max=5 value="<?= htmlspecialchars($estudiante['notaSr']); ?>">
                                </td>
                                <td>
                                    <input type='number' class="form-control" min=1 max=5 value="<?= htmlspecialchars($estudiante['notaSb']); ?>">
                                </td>
                                <td>
                                    <input type='number' class="form-control" min=1 max=5 value="<?= htmlspecialchars($estudiante['notaHc']); ?>">
                                </td>
                                <td>
                                      <input type="number" class="form-control" min=1 max=5 value="<?= htmlspecialchars($estudiante['sumaNotas']); ?>" readonly>

                                </td>
                                <td>
                                <a type="button" class="botonEditar btn-sm btn-guardar-edicion" id="btnActualizar" title="Guardar Actualización" data-id_nota="<?php echo $estudiante['id_nota']; ?>" data-id_curso_asignatura="<?php echo $estudiante['id_curso_asignatura']; ?>">
                                    <i id="pencil-icon" class="fas fa-pencil-alt" aria-hidden="true"></i>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="../public/js/asigCalificaciones.js"></script>

<script>
    $(document).ready(function() {
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