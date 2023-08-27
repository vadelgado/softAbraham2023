

<?php echo $this->extend('layout\layout') ?>

<?php echo $this->section('content') ?>


<div class="content container-fluid" ><br>
    <div class="card" id="contenedor">
        <div class="card-header text-center" id="titulo">
        <img src="..\public\img\nuevoUser.png" alt="usuarios"
                        class="icono-sidebar" /><b>Registrar Usuario</b>
        </div>
        <div class="card-body" id="area">
            <?php if (session()->getFlashdata('mensajeError')): ?>
                <div class="alert alert-danger mt-2 alert-dismissible fade show">
                    <?php echo session()->getFlashdata('mensajeError'); ?> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo base_url()?>registrar"
             name="formRegistrar" id="formRegistrar">
                <div class="row">
                    <div class="col-md-6">
                        <label for="documento" class="control-label">Número de documento: </label>
                        <input type="text" id="documento" name="documento" class="form-control"  autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label for="nombre" class="control-label">Nombre y apellido completo:</label>
                        <input type="text" id="nombre" name="nombre"  class="form-control" autocomplete="off">
                    </div>
                </div>
            
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="correo" class="control-label">Correo: </label>
                        <input type="mail" id="correo" name="correo" class="form-control"  autocomplete="off">
                        <label id="correoError" class="error-label mt-2 " style="color:red"></label>
                    </div>
                    <div class="col-md-6 mt-4">
                        <select class="form-select" id="rol" name="rol" >
                            <option selected disabled value="">Rol de Usuario</option>
                            <option value="administrador">Administrador</option>
                            <option value="docente">Docente</option>                     
                            <option value="estudiante">Estudiante</option>                                         
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="parrword" class="control-label">Contraseña: </label>
                        <input type="password" id="password" name="password" class="form-control"  autocomplete="off">
                        <label id="contraseniaError" class="error-label mt-2" style="color:red"></label>
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirm" class="control-label">Confirmar contraseña: </label>
                        <input type="password" id="password_confirm" name="password_confirm"  class="form-control" autocomplete="off">
                        <label id="confirmarContraseniaError" class="error-label" style="color:red"></label>
                    </div>
                </div>
                <div class="text-center mt-4">
                     <button  onclick="RegistrarUsuario()" class="botonRegistrar" 
                     type="button" >
                        <i class="fas fa-save"></i>&nbsp; Registrar &nbsp;
                     </button>
                     <button class="botonLimpiar" type="reset">
                        <i class="fas fa-broom"></i>&nbsp; Limpiar &nbsp;
                     </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="../public/js/validacionRegister.js"></script>

<?php echo $this->endSection() ?>
