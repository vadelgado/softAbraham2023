

<?php echo $this->extend('layout\layout') ?>

<?php echo $this->section('content') ?>


<div class="content container-fluid" ><br>
    <div class="card" id="contenedor">
        <div class="card-header text-center" id="titulo">
        <img src="..\public\img\nuevoUser.png" alt="usuarios"
                        class="icono-sidebar" /><b>Registrar Estudiante</b>
        </div>
        <div class="card-body" id="area">
            <?php if (session()->getFlashdata('mensajeError')): ?>
                <div class="alert alert-danger mt-2 alert-dismissible fade show">
                    <?php echo session()->getFlashdata('mensajeError'); ?> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <div class="row">
                    <div class="col-md-6">
                        <label for="documento" class="control-label">Número de Documento del usuario asociado: </label>
                        <input type="text" id="documento" name="documento" class="form-control"  autocomplete="off">
                    </div>
                    <div class="col-md-6 mt-4" >
                       <button class="btn btn-info text-white search-btn" type="button"> <i class="fa fa-search" aria-hidden="true"></i>&nbsp;Buscar</button>
                    </div>
            </div>
            <div class="alert alert-info mt-4" role="alert" id="alerta1">
                    <strong>Información</strong> Ingrese el número de documento del estudiante con el cual se registro en usuarios
            </div>
            <div class="alert alert-danger mt-4" role="alert" style="display:none" id="alerta2">
                    <label id="mjError"></label>
            </div>
            
            <div id="formEstudiante" style="display:none">
                <form method="POST" action="<?php echo base_url()?>NuevoEstudianteGuardar"
                name="formEst" id="formEst" class="mt-4">
                    <input type="hidden" id="id_usuario" name="id_usuario">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="documentoEstu" class="control-label">Documento: </label>
                            <input type="text" id="documentoEstu" name="documentoEstu" class="form-control"  autocomplete="off" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre" class="control-label">Nombre:</label>
                            <input type="text" id="nombre" name="nombre"  class="form-control" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="correo" class="control-label">Correo:</label>
                            <input type="email" id="correo" name="correo"  class="form-control" autocomplete="off" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="fechaReg" class="control-label"><b class="requerido">*&nbsp;</b> Fecha de registro: </label>
                            <input type="date" id="fechaReg" name="fechaReg" class="form-control"  autocomplete="off">
                        </div>
                        
                    </div>
                
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="direccion" class="control-label"><b class="requerido">*&nbsp;</b>Dirección:</label>
                            <input type="text" id="direccion" name="direccion"  class="form-control" autocomplete="off">
                        </div>
                        <div class="col-md-6">
                            <label for="celular" class="control-label">Celular:</label>
                            <input type="number" id="celular" name="celular"  class="form-control" autocomplete="off">
                        </div>          
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                                <label for="fechaNac" class="control-label"><b class="requerido">*&nbsp;</b>Fecha de Nacimiento:</label>
                                <input type="date" id="fechaNac" name="fechaNac"  class="form-control" autocomplete="off">
                            </div>
                            <div class="col-md-6">
                                <label for="genero" class="control-label">Género:</label>
                                <select name="genero" id="genero" class="form-select">
                                    <option value="M" disabled selected>seleccione....</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="curso" class="control-label"><b class="requerido">*&nbsp;</b>Curso a Matricular:</label>
                            <select name="curso" id="curso" class="form-select">
                                <option disabled selected>Seleccione ....</option>
                                <?php foreach ($data as $curso): ?>
                                    <option value="<?php echo $curso['id_curso']; ?>"><?php echo $curso['nombre_curso']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="documentoAcudiente" class="control-label"><b class="requerido">*&nbsp;</b>Número de documento del acudiente:</label>
                            <input type="text" id="documentoAcudiente" name="documentoAcudiente"  class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="nombreAcudiente" class="control-label"><b class="requerido">*&nbsp;</b>Nombre acudiente:</label>
                            <input type="text" id="nombreAcudiente" name="nombreAcudiente"  class="form-control" autocomplete="off">
                        </div>
                        <div class="col-md-6">
                            <label for="telefonoAcudiente" class="control-label"><b class="requerido">*&nbsp;</b>Telefóno acudiente:</label>
                            <input type="number" id="telefonoAcudiente" name="telefonoAcudiente"  class="form-control" autocomplete="off">
                        </div>          
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="correoAcudiente" class="control-label">Correo acudiente:</label>
                            <input type="email" id="correoAcudiente" name="correoAcudiente"  class="form-control" autocomplete="off">
                            <label id="correoError" class="error-label mt-2 " style="color:red"></label>
                        </div>        
                    </div>
                    <div class="text-center mt-4">
                        <a href="<?php echo base_url()?>Estudiantes" type="button" class="botonRegresar text-decoration-none">
                        <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>&nbsp;&nbsp;Regresar</a> 
                        <button  onclick="RegistrarEstudiante()" class="botonRegistrar" 
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
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="../public/js/newStudent.js"></script>
<script id="base-url" data-url="<?php echo base_url(); ?>"></script>

<?php echo $this->endSection() ?>
