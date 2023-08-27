<?php echo $this->extend('layout\layout') ?>

<?php echo $this->section('content') ?>

<!--DATATABLES-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap.min.css">


<div class="content container-fluid mt-4">
        <div class="row">
            <div class="col-md-12" >
                <div class="card card-default"> 
                    <div class="card-header text-center">
                    <img src="..\public\img\usuariosSis.png" alt="usuarios"
                        class="icono-sidebar" /><b>USUARIOS DEL SISTEMA</b>
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
                            <a href="<?php echo base_url()?>register" type="button" class="btn btn-primary">
                            <i class="fas fa-plus" id="pencil-icon" aria-hidden="true"></i>&nbsp;&nbsp;Nuevo usuario</a>             
                            <br>
                        </div>
                        
                        <div class="mt-4 table-container" >
                            <table class="table mt-4 table-striped table-bordered table-container" 
                            id="miTabla" name="miTabla" style="width:100%">
                                <thead class="headerTable bordered-table text-center">
                                    <tr class="text-center">
                                        <th scope="col">Documento</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">usuario</th>
                                        <th scope="col">Rol</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bordered-table bodyTable normal" style="font-weight:normal">
                                    <?php foreach($data as $i): ?>
                                    <tr>
                                        <th class="normal">
                                            <?php echo $i['documento'] ?>
                                        </th>
                                        <th class="normal">
                                            <?php echo $i['nombre'] ?>
                                        </th>
                                        <th class="normal">
                                            <?php echo $i['correo'] ?>
                                        </th>
                                        <th class="normal">
                                            <?php echo $i['rol'] ?>
                                        </th>
                                        <th class="normal">
                                        <?php echo $i['estado'] ? 'Activo' : 'Inactivo'; ?>
                                        </th>
                                        <th>
                                        <?php
                                            if ($i['estado'] == 1) {
                                                ?>
                                                <a href="#" type="button" class="btn btn-info btn-sm edit-btn" title="Editar" data-documento="<?php echo $i['documento']; ?>">
                                                    <i id="pencil-icon" class="fas fa-pencil-alt" aria-hidden="true"></i>
                                                </a>
                                                <a href="#" type="button" class="btn btn-warning btn-sm view-btn" title="Ver" data-documento="<?php echo $i['documento']; ?>">
                                                    <i class="fas fa-eye" id="pencil-icon" aria-hidden="true"></i></a>
                                                <a href="#" type="button" class="btn btn-danger btn-sm " title="Inactivar"
                                                onclick="Confirmacion('<?php echo $i['documento']; ?>', '<?php echo $i['estado']; ?>')" 
                                                ><i class="fas fa-ban" id="pencil-icon" aria-hidden="true"></i></a>
                                                <?php
                                            } else {
                                                ?>
                                                <a href="#" type="button" class="btn btn-secondary btn-sm edit-btn disabled"  title="Editar" data-documento="<?php echo $i['documento']; ?>">
                                                    <i id="pencil-icon" class="fas fa-pencil-alt" aria-hidden="true"></i>
                                                </a>
                                                <a href="#" type="button" class="btn btn-secondary btn-sm disabled" title="Ver" ><i class="fas fa-eye" id="pencil-icon" aria-hidden="true"></i></a>
                                                <a href="#" type="button" class="btn btn-success btn-sm" title="Activar"
                                                onclick="Confirmacion('<?php echo $i['documento']; ?>', '<?php echo $i['estado']; ?>')" >
                                                    <i class="fas fa-toggle-on" id="pencil-icon" aria-hidden="true"></i></a>
                                                <?php
                                            }
                                            ?>


                                        </th>                            
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


<!-- Modal EDITAR -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header headerModal text-center">
                <h4 class="modal-title " id="editModalLabel">Editar Usuario</h4>
                <button type="button" class="btn-close"  data-bs-dismiss="modal"></button>
            </div>
            <form action="<?php echo base_url()?>editUserSave" method="POST" id="formEditar">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                        <label for="documento">Documento:</label>
                        </div>
                        <div class="col-md-9">
                        <input type="text" class="form-control" id="documento" name="documento" readonly >
                        </div>            
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                        <label for="nombre">Nombre:</label>
                        </div>
                        <div class="col-md-9">
                        <input type="text" class="form-control" id="nombre" name="nombre" >
                        </div>            
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                        <label for="correo">Correo:</label>
                        </div>
                        <div class="col-md-9">
                        <input type="text" class="form-control" id="correo" name="correo" readonly >
                        </div>            
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label for="rol">Rol:</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" id="rol" name="rol" >
                                <option value="administrador">Administrador</option>
                                <option value="docente">Docente</option>                      
                                <option value="estudiante">Estudiante</option>                                         
                            </select>
                        </div>            
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                        <label for="estado">Estado:</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" id="estado" name="estado" >
                                 <option value="0">Inactivo</option> 
                                 <option value="1">Activo</option>
                                                                     
                            </select>
                        </div>            
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Cerrar</button>
                    <button   class="botonRegistrar" onclick=EditarUsuario()
                     type="button"  >
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
                <h4 class="modal-title " id="editModalLabel">Información Usuario</h4>
                <button type="button" class="btn-close"  data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
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
<script src="../public/js/editUser.js"></script>

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