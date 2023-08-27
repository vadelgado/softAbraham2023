<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4" >
  
    <div class="row ">
      <div class="col-md-6 mt-2 sombra">
        <a href="<?php echo base_url()?>usuarios" class="menu-option bordeRedondo text-decoration-none "
         style="background-color: #419BED;">
        <img src="..\public\img\AAsignatura.png" alt="usuario" class="icono-sidebar imgInicio mt-4" >
          <p class="letraBotonIn">
            Administrar Asignatura <br> 
          </p> 
        </a>
      </div>

      <div class="col-md-6 mt-2">
        <a href="<?php echo base_url()?>AsignaturaCursos" class="menu-option bordeRedondo text-decoration-none" style="background-color: #5EBF16;">
        <img src="..\public\img\aCurso.png" alt="curso" class="icono-sidebar imgInicio mt-4">
        <p class="letraBotonIn">
            Administrar Cursos <br>
        </p> 
        </a>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-6 ">
        <a href="<?php echo base_url()?>AsignaturaCursos" class="menu-option bordeRedondo text-decoration-none" style="background-color: #5EBF16;">
        <img src="..\public\img\ajustesCursoPro.png" alt="docente" class="icono-sidebar imgInicio mt-4">
        <p class="letraBotonIn">
            Configurar Curso Asignatura Profesor <br> 
        </p>  
        </a>
    </div>
      
      <div class="col-md-6">
        <a href="<?php echo base_url()?>AsignaturaLogro" class="menu-option bordeRedondo text-decoration-none" style="background-color: #419BED;">
        <img src="..\public\img\porcenteje.png" alt="estudiante" class="icono-sidebar imgInicio mt-4">
        <p class="letraBotonIn">
         Configurar Porcentajes por Periodo<br>
        </p>   
        </a>
      </div>
     
    </div>
</div>

<?php echo $this->endSection() ?>