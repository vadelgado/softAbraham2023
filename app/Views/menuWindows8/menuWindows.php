<?php echo $this->extend('layout\layout') ?>

<?php echo $this->section('content') ?>

<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>-->

<div class="container mt-4" >
  
    <div class="row ">
      <div class="col-md-4 mt-2 sombra">
        <a href="<?php echo base_url()?>usuarios" class="menu-option bordeRedondo text-decoration-none "
         style="background-color: #5EBF16;">
        <img src="..\public\img\user.png" alt="usuario" class="icono-sidebar imgInicio mt-4" >
          <p class="letraBotonIn">
            Usuarios <br> 
          </p> 
        </a>
      </div>

      <div class="col-md-4 mt-2">
        <a href="<?php echo base_url()?>Cursos" class="menu-option bordeRedondo text-decoration-none" style="background-color: #419BED;">
        <img src="..\public\img\confiCursos.png" alt="curso" class="icono-sidebar imgInicio mt-4">
        <p class="letraBotonIn">
            Cursos <br>
        </p> 
        </a>
      </div>
      <div class="col-md-4 mt-2">
        <a href="<?php echo base_url('/Boletines')?>" class="menu-option bordeRedondo text-decoration-none " style="background-color: #EB4FAD;">
        <img src="..\public\img\boletin.png" alt="boletin" class="icono-sidebar imgInicio mt-4">
        <p class="letraBotonIn">
            Boletines <br>
        </p>   
        </a>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-4 ">
        <a href="<?php echo base_url()?>listarProfesores" class="menu-option bordeRedondo text-decoration-none" style="background-color: #419BED;">
        <img src="..\public\img\docente.png" alt="docente" class="icono-sidebar imgInicio mt-4">
        <p class="letraBotonIn">
            Docentes <br> 
        </p>  
        </a>
    </div>
      
      <div class="col-md-4">
        <a href="<?php echo base_url()?>Estudiantes" class="menu-option bordeRedondo text-decoration-none" style="background-color: #EB4FAD;">
        <img src="..\public\img\newEstudiante.png" alt="estudiante" class="icono-sidebar imgInicio mt-4">
        <p class="letraBotonIn">
         Estudiantes <br>
        </p>   
        </a>
      </div>
      <div class="col-md-4">
        <a href="<?php echo base_url()?>Calificaciones" class="menu-option bordeRedondo text-decoration-none" style="background-color: #5EBF16">
        <img src="..\public\img\notasg.png" alt="calificación" class="icono-sidebar imgInicio mt-4">
        <p class="letraBotonIn">
            Calificaciones <br>
        </p>   
        </a>
      </div>
      
    </div>
</div>

<?php echo $this->endSection() ?>