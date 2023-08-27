<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SoftAbraham | 2023 </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href=" " rel="icon">
    <link href=" " rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Template Main CSS File -->
    <link href="..\public\css\layout.css" rel="stylesheet">
    <link href="..\public\css\tables.css" rel="stylesheet">
    <link href="..\public\css\botones.css" rel="stylesheet">
    <link href="..\public\css\principal.css" rel="stylesheet">

    <!--iconos--> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">

</head>

<body>
    <aside id="sidebar" class="sidebar">
        <div class="col-md-3 col-lg-2 bg-blue">
            <!-- Contenido de la barra lateral -->
            <div class="d-flex flex-column align-items-center align-items-sm-start px-4 pt-2 min-vh-100">
                <a href="" class="imagen-con-lineas">
                    <img src="..\public\img\logo.webp" alt="Imagen 1" class="imagen-pequena " >
                </a>
 
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start mt-4" id="menu">
                               
                    <li class="nav-item dropdown ">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="..\public\img\Inicio.png" alt="Inicio" class="icono-sidebar"><span
                                class="ms-1 d-none d-sm-inline ">Inicio</span>
                        </a>

                        <div class=" dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="muenudrop">                
                            <a class="dropdown-item" href="<?php echo base_url('/inicio')?>">Menú</a> 
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo base_url('/logout')?>">Cerrar sesión</a>                                 
                        </div>
                    </li>

                    <li class="nav-item dropdown ">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="..\public\img\user.png" alt="usuario" class="icono-sidebar"><span
                            class="ms-1 d-none d-sm-inline "> Usuarios</span>
                        </a>
                        <div class=" dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="muenudrop">                   
                        <a class="dropdown-item" href="<?php echo base_url('/usuarios')?>">Usuarios</a>                             
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url('/register')?>">Nuevo Usuario</a>    
                        </div>
                    </li>

                    <li class="nav-item dropdown ">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="..\public\img\confiCursos.png" alt="usuario" class="icono-sidebar"><span
                                class="ms-1 d-none d-sm-inline "> Cursos</span>
                        </a>
                        <div class=" dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="muenudrop">                   
                        <a class="dropdown-item" href=" <?php echo base_url('Asignaturas');?> ">Asignaturas</a>   
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url('cursos')?>">Cursos</a> 
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url('/AsignaturaCursos')?>">Configurar Curso</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url('/AsignaturaLogro')?>">Configurar Porcentajes</a>                              
                        </div>
                    </li>

                    <li class="nav-item dropdown ">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="..\public\img\boletin.png" alt="matricula" class="icono-sidebar"> <span
                                class="ms-1 d-none d-sm-inline ">Boletines</span>
                        </a>
                        <div class=" dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="muenudrop">                   
                        <a class="dropdown-item" href="<?php echo base_url('/Boletines')?>">Consultar Boletín</a>                             
                    </li>

                    <li class="nav-item dropdown ">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="..\public\img\docente.png" alt="usuario" class="icono-sidebar"><span
                                class="ms-1 d-none d-sm-inline "> Docentes</span>
                        </a>
                        <div class=" dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="muenudrop">                   
                        <a class="dropdown-item" href="<?php echo base_url('/listarProfesores')?>">Docentes</a>                             
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url('/crearProfesor')?>">Nuevo Docente</a>    
                        </div>
                    </li>

                    <li class="nav-item dropdown ">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="..\public\img\newEstudiante.png" alt="usuario" class="icono-sidebar"><span
                                class="ms-1 d-none d-sm-inline "> Estudiantes</span>
                        </a>
                        <div class=" dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="muenudrop">                   
                        <a class="dropdown-item" href="<?php echo base_url('/Estudiantes')?>">Estudiantes</a>                             
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url('/NuevoEstudiante')?>">Nuevo Estudiante</a>    
                        </div>
                    </li>
                    <li class="nav-item dropdown ">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="..\public\img\notasg.png" alt="notas" class="icono-sidebar"> <span
                                class="ms-1 d-none d-sm-inline vertical-center">Calificaciones</span>
                        </a>
                        <div class=" dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="muenudrop">                   
                              <a class="dropdown-item" href="<?php echo base_url('/Calificaciones')?>">Asignar Calificaciones</a>                             
   
                        </div>
                    </li>
                    <li class="nav-item dropdown ">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="..\public\img\acerca-de.png" alt="notas" class="icono-sidebar"> <span
                                class="ms-1 d-none d-sm-inline vertical-center">Acerca De</span>
                        </a>
                        <div class=" dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="muenudrop">                   
                              <a class="dropdown-item" href="<?php echo base_url('/Acercade')?>">Ver Más</a>                             
   
                        </div>
                    </li>

                </ul>
            </div>

        </div>

    </aside>


    <!-- End Sidebar-->

    <!-- ======= Main ======= -->
    <main id="main"  >    
            <!-- Navbar--> 
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light">
                <div class=" container-fluid">
                <!--   <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>-->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav d-flex justify-content-center align-items-center">
                            <a class="navbar-botonmenu" href="#">
                            <i class="bi bi-list toggle-sidebar-btn"></i>
                            </a>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><b>Institucion Educativa Siglo XXI</b></a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"></a>
                                    </li>
                                <li class="nav-item dropdown ">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <?php echo session('nombre')?>
                                    </a>

                                    <div class=" dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="muenudrop">
                                
                                    <a class="dropdown-item" href="#">Perfil</a>
                                    <a class="dropdown-item" href="#">Configuración</a>
                                    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo base_url('/logout')?>">Cerrar sesión</a>      
                                    </div>
                                </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!-- ======= Sidebar ======= -->

        <!-- ======= CONTENIDO PAGINA ======= -->

        <?php echo $this->renderSection('content'); ?>

        <!-- =======FIN CONTENIDO PAGINA ======= -->

        <!-- ======= FOOTER ======= -->
        <div class="container-fluid mt-6 headerModal mt-4 mt-4 ">
            <footer  class="text-center text-lg-start text-white" >
            <div class="container p-4 pb-0">
                <label for="">Institución Educativa Siglo XXI - Sistema de gestión de Calificaciones</label>
        
                <hr class="my-3">
        
                <section class="p-3 pt-0">
                <div class="row d-flex align-items-center">
                    <div class="col-md-7 col-lg-8 text-center text-md-start">
                    <div class="p-3">
                        © 2023 Copyright:
                        <a class="text-white" href="#"
                        >DevelopersUdenar</a
                        >
                    </div>
                    </div>

                    <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
                    <!-- Facebook -->
                    <a
                        class="btn btn-outline-light btn-floating m-1"
                        class="text-white"
                        role="button"
                        ><i class="fab fa-facebook-f"></i
                        ></a>
        
                    <!-- Twitter -->
                    <a
                        class="btn btn-outline-light btn-floating m-1"
                        class="text-white"
                        role="button"
                        ><i class="fab fa-twitter"></i
                        ></a>
        
                    <!-- Google -->
                    <a
                        class="btn btn-outline-light btn-floating m-1"
                        class="text-white"
                        role="button"
                        ><i class="fab fa-google"></i
                        ></a>
        
                    <!-- Instagram -->
                    <a
                        class="btn btn-outline-light btn-floating m-1"
                        class="text-white"
                        role="button"
                        ><i class="fab fa-instagram"></i
                        ></a>
                    </div>
                </div>
                </section>
            </div>
            </footer>
         </div>
        <!-- =======END - FOOTER ======= -->

    </main><!-- End #main -->


    

    <!-- Bootstrap JS Files -->
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
    <!-- Template Main JS File -->
    <script src="..\public\js\layout.js"></script>


    <!--sweetAlert-->
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    

</body>

</html>