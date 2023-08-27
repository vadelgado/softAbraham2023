<?php echo $this->extend('layout\layout') ?>

<?php echo $this->section('content') ?>

<link href="..\public\css\asignaturas.css" rel="stylesheet">

<div class="content container-fluid mt-4">
        <div class="row">
            <div class="col-md-12" >
                <div class="card card-default"> 
                    <div class="card-header text-center">
                    <img src="..\public\img\asignaturas.jpg" alt="usuarios"
                        class="icono-sidebar" /><b>ASIGNATURAS</b>
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
                            <a href="<?php echo base_url('/CrearAsignatura')?>" type="button" class="btn btn-primary">
                            <i class="fas fa-plus" id="pencil-icon" aria-hidden="true"></i>&nbsp;&nbsp;Nueva Asignatura</a>             
                            <a href="<?php echo base_url('demo-pdf')?>" class="btn btn-danger btn-sm align-right" title="Inactivar" onclick="">
                                <i class="far fa-file-pdf me-2"></i>&nbsp; Reporte PDF &nbsp;
                            </a>

                        </div>

                        <div class="mt-4 table-container table-responsive tablaasignatura" >
                        <div class="table-responsive">
                                <table class="table mt-4 table-striped table-bordered table-container" id="miTabla" name="miTabla">
                                    <thead class="headerTable bordered-table text-center">
                                        <tr class="text-center">
                                            <th scope="col">Código</th>
                                            <th scope="col">Área</th>
                                            <th scope="col">Descripción</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bordered-table bodyTable normal" style="font-weight:normal">
                                        <?php foreach($data as $i): ?>
                                        <tr>
                                            <td class="normal"><?php echo $i['id_asignatura'] ?></td>
                                            <td class="normal"><?php echo $i['area_asignatura'] ?></td>
                                            <td class="normal td-description"><?php echo $i['descripcion_asignatura'] ?></td>
                                            <td class="normal"><?php echo $i['estado_asignatura'] ? 'Activa' : 'Inactiva'; ?></td>
                                            <td>                                                
                                                <div class="btn-group" role="group">
                                                <a href="#" type="button" class="btn btn-info btn-sm edit-asig" title="Editar" data-id_asignatura="<?php echo $i['id_asignatura']; ?>">
                                                    <i id="pencil-icon" class="fas fa-pencil-alt" aria-hidden="true"></i>
                                                </a>  
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                         </div>

                    </div>
                </div>
            </div>
        </div>
<!--InicioMdal Asig-->
<div class="modal fade" id="editarAsignatura" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header headerModal text-center">
                <h4 class="modal-title " id="editModalLabel">Editar Asignatura</h4>
                <button type="button" class="btn-close"  data-bs-dismiss="modal"></button>
            </div>
            <form action="<?php echo base_url('editarAsignatura')?>" method="POST" id="formeditarAsignatura">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                        
                        </div>
                        <div class="col-md-9">                        
                        <input type="hidden" class="form-control" id="id_asignatura" name="id_asignatura" readonly>
                        </div>            
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                        <label for="nombre">Area:</label>
                        </div>
                        <div class="col-md-9">
                        <input type="text" class="form-control" id="area_asignatura" name="area_asignatura" >
                        </div>            
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                        <label for="correo">Descripcion:</label>
                        </div>
                        <div class="col-md-9">
                        <input type="text" class="form-control" id="descripcion_asignatura" name="descripcion_asignatura" >
                        </div>            
                    </div>                    
                    <div class="row mt-2">
                        <div class="col-md-3">
                        <label for="estado">Estado:</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" id="estado_asignatura" name="estado_asignatura" >
                                 <option value="0">Inactivo</option> 
                                 <option value="1">Activo</option>
                                                                     
                            </select>
                        </div>            
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Cerrar</button>
                    <button   class="botonRegistrar" type="submit" >
                        <i class="fas fa-save"></i>&nbsp; Guardar cambios &nbsp;
                     </button>
                     
                </div>
            </form>
           
        </div>
    </div>
</div>
<!--FinMdalAsig-->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script id="base-url" data-url="<?php echo base_url(); ?>"></script>
<script src="../public/js/asignatura.js"></script>

<script>

$(document).ready(function () {

    var baseUrl = $('#base-url').data('url');

    // // Manejar el clic en el botón "Editar"
    $('.edit-asig').click(function () {            
        var id_asignatura = $(this).data('id_asignatura');
        // Enviar una solicitud AJAX al controlador
        $.ajax({
            url: baseUrl + 'EditarAsignatura',
            type: 'POST',
            data: {
                id_asignatura: id_asignatura
            },
            success: function (response) {
            
                 var userData = JSON.parse(response);
                 var asignatura = userData.data;

                 var id = document.getElementById('id_asignatura');
               var area = document.getElementById('area_asignatura');
               var descripcion = document.getElementById('descripcion_asignatura');
               var estado = document.getElementById('estado_asignatura');

               id.value = asignatura.id_asignatura;
               area.value = asignatura.area_asignatura;
               descripcion.value = asignatura.descripcion_asignatura;
               estado.value = asignatura.estado_asignatura;
                       
               // Mostrar el modal
               $('#editarAsignatura').modal('show');
            },
            error: function (xhr, status, error) {
                Swal.fire('Error', 'Por favor, inténtalo de nuevo más tarde.', 'error');
                console.log(error); 
            }
        });
     });


    
});
</script>


<?php echo $this->endSection() ?>

