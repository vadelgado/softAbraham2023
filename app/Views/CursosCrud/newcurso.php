<?php echo $this->extend('layout\layout') ?>

<?php echo $this->section('content') ?>


<div class="content container-fluid"><br>
    <div class="card" id="contenedor">
        <div class="card-header text-center" id="titulo">
            <img src="..\public\img\confiCursos.png" alt="usuarios" class="icono-sidebar" /><b>Registrar Nuevo curso</b>
        </div>
        <form method="POST" action="<?php echo base_url()?>guardarCurso">
            <div class="card-body" id="area">
                <?php if (session()->getFlashdata('mensajeError')): ?>
                <div class="alert alert-danger mt-2 alert-dismissible fade show">
                    <?php echo session()->getFlashdata('mensajeError'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                <div class="row">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre_curso" class="form-label">Ingrese Nombre del curso</label>
                            <input type="text" class="form-control" id="nombre_curso" name="nombre_curso">
                        </div>
                        <div class="col-md-6">
                            <label for="tipo_curso" class="form-label">Ingrese el tipo de curso</label>
                            <input type="text" class="form-control" id="tipo_curso" name="tipo_curso">
                        </div>
                        
                    </div>


                    <div class="row mb-3">
                       
                        <div class="col-md-6">
                        <label for="tipo_curso" class="form-label">Seleccione estado de curso</label>
                             <select name="estado_curso" id="estado_curso" class="form-select">
                                <option value="" selected disabled>Seleccione Estado</option>
                                <option value="0">Inctivo</option>
                                <option value="1">Activo</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="<?php echo base_url()?>cursos" type="button"
                            class="botonRegresar text-decoration-none">
                            <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>&nbsp;&nbsp;Regresar</a>
                        <button class="botonRegistrar btn text-white" type="submit">
                        <i class="fas fa-save"></i>&nbsp; Registrar
                                &nbsp;

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


<?php echo $this->endSection() ?>