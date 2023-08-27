<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'sessionAdministrador'=>\App\Filters\sessionAdministrador::class,
      
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     */
    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [
        "sessionAdministrador" => [
            "before" =>[
            //todas la rutas que se debe validar a las que no puede entrar si no es administrador
            "/inicio",
            "/usuarios",
            "/register",
            "/newDocent",
            "/listDocent",
            "/menuDS",
            "/CursosBachillerato",
            "/CursosPrimaria",
            "/nuevosCursos",
            "listarProfesores",
            "crearProfesor",
            "guardarProfesor",
            "editarProfesores",
            "actualizarProfesor",
            "/AsignaturaCursos",
            "/agregarDatosSelect",
            "/AsignaturaCursosGuardarEdicion",
            "/inactivarActivarRegistroAC",
            "/AsignaturaLogro",
            "/asignarPorcentaje",
            "/editarAsignaturaLogro",
            "/Cursos",
            "/Acercade",
            "/GenerarPDF/{num}",
            "/registrar",
            "/editUser",
            "/editUserSave",
            "/activeUser",
            "/Estudiantes",
            "/NuevoEstudiante'",
            "/buscarEstudiante",
            "/NuevoEstudianteGuardar",
            "/EditarEstudiante",
            "/ActualizarEstudiante",
            "/Calificaciones",
            "/getAsignaturasporCurso",
            "/obtenerEstudiantes",
            "/guardarCalificaciones",
            "/actualizarCalificaciones",
            "/Boletines"
            ] 
            ]
           
    ];
}
