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
</head>

<body>

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
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <!-- @guest -->
                            <!-- @if (Route::has('login')) -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <!-- {{ __('Login') }} -->
                                    </a>
                                </li>
                            <!-- @endif -->

                            <!-- @if (Route::has('register')) -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        
                                    <!-- {{ __('Register') }} -->

                                    </a>
                                </li>
                            <!-- @endif
                        @else -->
                            <li class="nav-item dropdown ">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <!-- {{ Auth::user()->name }} -->
                                    <?php echo session('nombre')?>
                                </a>

                                <div class=" dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="muenudrop">
                               
                                <a class="dropdown-item" href="#">Perfil</a>
                                <a class="dropdown-item" href="#">Configuración</a>
                               
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url('/logout')?>">Cerrar sesión</a>
                                
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <!-- {{ __('Cerrar sesión') }} -->
                                </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        <!-- @csrf -->
                                    </form>
                                </div>
                            </li>
                        <!-- @endguest -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <div class="col-md-3 col-lg-2 bg-blue">

            <!-- Contenido de la barra lateral -->
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="" class="imagen-con-lineas">
                    <img src="..\public\img\logo.webp" alt="Imagen 1" class="imagen-pequena">
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item ">
                        <a href="{{ route('home') }}" class="nav-link align-middle px-0">
                            <img src="..\public\img\Inicio.png" alt="Inicio" class="icono-sidebar"><span
                                class="ms-1 d-none d-sm-inline ">Inicio</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('register') }}" class="nav-link align-middle px-0">
                            <img src="..\public\img\usuario.png" alt="usuario" class="icono-sidebar"><span
                                class="ms-1 d-none d-sm-inline "> Usuarios</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link align-middle px-0">
                            <img src="..\public\img\matricula.png" alt="matricula" class="icono-sidebar"> <span
                                class="ms-1 d-none d-sm-inline ">Matricula</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link align-middle px-0">
                            <img src="..\public\img\notas.png" alt="notas" class="icono-sidebar"> <span
                                class="ms-1 d-none d-sm-inline vertical-center">Notas</span>
                        </a>
                    </li>

                </ul>
            </div>

        </div>

    </aside>


    <!-- End Sidebar-->

    <!-- ======= Main ======= -->
    <main id="main" class="main">


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
</body>

</html>