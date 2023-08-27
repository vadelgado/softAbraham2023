<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CursoModel;
use App\Models\AsignaturaModel;
use App\Models\ProfesoresModel;
use App\Models\CursoAsignaturaModel;

class AsignaturaCursosController extends Controller{

    public function index(){
        $datos = $this->obtenerDatosSelect();
        $datosTabla = $this->obtenerDatosTabla();
        $datos['cursosAsignatura'] = $datosTabla;
        return view('Cursos/CursoAsignaturaView', $datos);
    }

 public function obtenerDatosTabla()
    {
        $cursoAsignaturaModel = new CursoAsignaturaModel();
        
        // Cargar los datos utilizando la consulta personalizada del modelo
        $cursosAsignatura = $cursoAsignaturaModel->obtenerDatosTabla();

        return $cursosAsignatura;
    }

    
    

    public function obtenerDatosSelect(){        

        $cursoModel = new CursoModel();
        $asignaturaModel = new AsignaturaModel();
        $profesoresModel = new ProfesoresModel();
        
        $datosDisponibles = [
            'cursos' => $cursoModel->findAll(),
            'asignaturas' => $asignaturaModel->findAll(),
            'profesores' => $profesoresModel->buscarConUsuario(),
        ];



        return ($datosDisponibles);
    }

public function agregarDatosSelect(){
    $curso_id = $this->request->getPost('curso_id');
    $asignatura_id = $this->request->getPost('asignatura_id');
    $profesor_id = $this->request->getPost('profesor_id');

    // Verificar si se ha seleccionado un valor en los campos obligatorios
    if (empty($curso_id) || empty($asignatura_id) || empty($profesor_id)) {
        return redirect()->to(base_url('/AsignaturaCursos'))->with('mensajeError', 'Debes seleccionar un valor en todos los select.');
    }

    // Verificar si la combinación ya existe en la tabla cursosasignatura
    $cursoAsignaturaModel = new CursoAsignaturaModel();
    $existeCombinacion = $cursoAsignaturaModel
        ->where('curso_id', $curso_id)
        ->where('asignatura_id', $asignatura_id)
        ->where('profesor_id', $profesor_id)
        ->countAllResults() > 0;

    if ($existeCombinacion) {
        return redirect()->to(base_url('/AsignaturaCursos'))->with('mensajeError', 'La combinación ya existe!');
    }

    // Si la combinación no existe, realizar la inserción
    $datosEnviar = [
        'curso_id' => $curso_id,
        'asignatura_id' => $asignatura_id,
        'profesor_id' => $profesor_id
    ];

    if ($cursoAsignaturaModel->insert($datosEnviar)) {
        return redirect()->to(base_url('/AsignaturaCursos'))->with('mensaje', 'Registro Agregado Exitosamente');
    } else {
        return redirect()->to(base_url('/AsignaturaCursos'))->with('mensajeError', 'Ha ocurrido un error al agregar el registro.');
    }
}

public function guardarEdicion()
{
    $id_curso_asignatura = $this->request->getPost('id_curso_asignatura');
    $cursoAsignaturaModel = new CursoAsignaturaModel();
    $registro = $cursoAsignaturaModel->find($id_curso_asignatura);

    if (!$registro) {
        // Redirigir o mostrar un mensaje de error si el registro no existe
        return redirect()->back();
    }

    // Obtener los datos del formulario de edición
    $curso_id = $this->request->getPost('curso_id');
    $asignatura_id = $this->request->getPost('asignatura_id');
    $profesor_id = $this->request->getPost('profesor_id');

    // Verificar si la combinación ya existe en la tabla cursosasignatura
    $existeCombinacion = $cursoAsignaturaModel
        ->where('curso_id', $curso_id)
        ->where('asignatura_id', $asignatura_id)
        ->where('profesor_id', $profesor_id)
        ->where('id_curso_asignatura !=', $id_curso_asignatura) // Excluir el registro actual para edición
        ->countAllResults() > 0;

    if ($existeCombinacion) {
        return redirect()->to(base_url('/AsignaturaCursos'))->with('mensajeError', 'La combinación ya existe!');
    }

    // Actualizar el registro en la base de datos
    $datosEditar = [
        'curso_id' => $curso_id,
        'asignatura_id' => $asignatura_id,
        'profesor_id' => $profesor_id
    ];

    if ($cursoAsignaturaModel->update($id_curso_asignatura, $datosEditar)) {
        return redirect()->to(base_url('/AsignaturaCursos'))->with('mensaje', 'Curso Actualizado con éxito');
    } else {
        return redirect()->to(base_url('/AsignaturaCursos'))->with('mensajeError', 'Ha ocurrido un error en la actualización');
    }
}

public function inactivarActivarRegistro()
{
    $id_curso_asignatura = $this->request->getPost('id_curso_asignatura');
    $estadoca = $this->request->getPost('estadoca');

    $cursoAsignaturaModel = new CursoAsignaturaModel();
    $registro = $cursoAsignaturaModel->find($id_curso_asignatura);

    if (!$registro) {
        return redirect()->to(base_url('/AsignaturaCursos'))->with('mensajeError', 'Registro no encontrado.');
    }

    // Cambiar el estado del registro en la base de datos
    $nuevoEstado = $estadoca == 1 ? 0 : 1;
    $datosEditar = [
        'estadoca' => $nuevoEstado
    ];

    if ($cursoAsignaturaModel->update($id_curso_asignatura, $datosEditar)) {
        $mensaje = $nuevoEstado ? 'Registro inactivado exitosamente.' : 'Registro activado exitosamente.';
        return redirect()->to(base_url('/AsignaturaCursos'))->with('mensaje', $mensaje);
    } else {
        return redirect()->to(base_url('/AsignaturaCursos'))->with('mensajeError', 'Ha ocurrido un error al actualizar el estado del registro.');
    }
}





    

}