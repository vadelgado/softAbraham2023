<?php echo $this->extend('layout\layout') ?>

<?php echo $this->section('content') ?>

<!--DATATABLES-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap.min.css">


<div class="content container-fluid mt-4">
        <div class="row">
            <div class="col-md-12" >
                <div class="card card-default"> 
                    <div class="card-header text-center">
                    <img src="..\public\img\confCurso.png" alt="usuarios"
                        class="icono-sidebar" /><b>CURSOS</b>
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

                        <div class="text-right">
                            <a href="<?php echo base_url()?>Nuevocurso" type="button" class="btn btn-primary">
                            <i class="fas fa-plus" id="pencil-icon" aria-hidden="true"></i>&nbsp;&nbsp;Nuevo curso</a>             
                            <br>
                        </div>
                        
                        <div class="mt-4 table-container" >
                            <table class="table mt-4 table-striped table-bordered table-container" 
                            id="miTabla" name="miTabla" style="width:100%">
                                <thead class="headerTable bordered-table text-center">
                                    <tr class="text-center">
                                        <th scope="col">ID</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Tipo</th>
 
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bordered-table bodyTable normal" style="font-weight:normal">
                                <?php foreach ($data as $curso) : ?>
                                <tr>
                                    <td>
                                        <?= $curso['id_curso']; ?>
                                    </td>
                                    <td>
                                        <?= $curso['nombre_curso']; ?>
                                    </td>
                                    <td>
                                        <?= $curso['tipo_curso']; ?>
                                    </td>
                                    
                                    <td>
                                        <a href="#" type="button" class="btn btn-info btn-sm edit-btn" title="Editar" data-id_curso="<?php echo $curso['id_curso']; ?>">
                                            <i id="pencil-icon" class="fas fa-pencil-alt" aria-hidden="true"></i>
                                        </a>
                                        <!-- <a href="#" type="button" class="btn btn-danger btn-sm view-btn" title="Eliminar" >
                                            <i class="fas fa-trash" id="pencil-icon" aria-hidden="true"></i></a> -->
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
    <div class="modal-dialog" role="document" >
        <div class="modal-content" style="width:600px">
            <div class="modal-header headerModal text-center">
                <h4 class="modal-title " id="editModalLabel">Editar Curso</h4>
                <button type="button" class="btn-close"  data-bs-dismiss="modal"></button>
            </div>
            <form action="<?php echo base_url()?>edicionCurso" method="POST" id="formEditarEst">
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                        <label for="documento" class="form-label">Nombre curso:</label>
                        <input type="text" class="form-control" id="nombre_curso" name="nombre_curso" >
                        </div>
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Tipo Curso:</label>
                            <input type="text" class="form-control" id="tipo_curso" name="tipo_curso">
                        </div>            
                    </div>
                   
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="genero" class="form-label">Estado del curso:</label>
                            <select name="estado_curso" id="estado_curso" class="form-select">
                                    <option disabled selected>seleccione....</option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                            </select>
                        </div>            
                    </div>
                
                    <input type="hidden" id="id_curso" name="id_curso">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Cerrar</button>
                    <button   class="botonRegistrar" onclick=EditarCurso()
                     type="button"  >
                        <i class="fas fa-save"></i>&nbsp; Guardar cambios &nbsp;
                     </button>
                </div>
            </form>
           
        </div>
    </div>
</div>

<!--Datatables-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="../public/js/editCurso.js"></script>

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