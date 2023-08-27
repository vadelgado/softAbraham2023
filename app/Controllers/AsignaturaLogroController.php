<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AsignaturaLogroModel;
use App\Models\CursoAsignaturaModel;
use App\Models\LogroModel;


class AsignaturaLogroController extends Controller{

    public function index()
    {
        
        $datosDisponibles = $this->obtenerDatosSelect();
        $datos['cursosAsignatura'] = $datosDisponibles['cursosAsignatura'];
        $datos['logros'] = $datosDisponibles['logros'];
        $datos['asignaturaLogro'] = $this->obtenerDatosTabla();
        return view('Cursos/AsignaturaLogroView', $datos);
    }

    public function obtenerDatosSelect()
    {
        $cursoAsignaturaModel = new CursoAsignaturaModel();
        $logroModel = new LogroModel();

        $datosDisponibles = [
            'cursosAsignatura' => $cursoAsignaturaModel->findAll(),
            'logros' => $logroModel->findAll(),
        ];

        return $datosDisponibles;
    }

    public function asignarPorcentaje()
    {
        $id_curso_asignatura = $this->request->getPost('curso');
        $id_logro = $this->request->getPost('logro');
        $porcenteje = $this->request->getPost('porcenteje');
        $periodo = $this->request->getPost('periodo');
  
        if (empty($id_curso_asignatura) || empty($id_logro) || empty($porcenteje) || empty($periodo)) {
            return redirect()->to(base_url('/AsignaturaLogro'))->with('mensajeError', 'Debes seleccionar un valor en todos los select.');
        }

        $asignaturaLogroModel = new AsignaturaLogroModel();
        $existeCombinacion = $asignaturaLogroModel
            ->where('curso_asignatura_id', $id_curso_asignatura)
            ->where('logro_id', $id_logro)
            ->where('periodo', $periodo)
            ->countAllResults() > 0;
    
        if ($existeCombinacion) {
            return redirect()->to(base_url('/AsignaturaLogro'))->with('mensajeError', 'Ya existe una combinación con los valores seleccionados.');
        }
    
        $data = [
            'curso_asignatura_id' => $id_curso_asignatura,
            'logro_id' => $id_logro,
            'porcenteje' => $porcenteje,
            'periodo' => $periodo,
        ];
    
        if ($asignaturaLogroModel->insert($data)) {
            return redirect()->to(base_url('/AsignaturaLogro'))->with('mensaje', 'Asignación realizada correctamente.');
        } else {
            return redirect()->to(base_url('/AsignaturaLogro'))->with('mensajeError', 'Ha ocurrido un error al realizar la asignación.');
        }
    }

    public function obtenerDatosTabla(){
        $asignaturaLogroModel = new AsignaturaLogroModel();

        $datosTabla = $asignaturaLogroModel
            ->join('cursosasignatura', 'cursosasignatura.id_curso_asignatura = asignaturalogro.curso_asignatura_id')
            ->join('cursos', 'cursos.id_curso = cursosasignatura.curso_id')
            ->join('profesores', 'profesores.id = cursosasignatura.profesor_id')
            ->join('usuarios', 'usuarios.id_usuario = profesores.usuario_id')
            ->join('asignaturas', 'asignaturas.id_asignatura = cursosasignatura.asignatura_id')
            ->join('logro', 'logro.id_logro = asignaturalogro.logro_id')
            ->findAll();

        return $datosTabla;
    }    

    public function editarAsignaturaLogro(){
        $id_asignatura_logro = $this->request->getPost('id_asignatura_logro');
        $nuevo_porcentaje = $this->request->getPost('editarPorcentaje');

        if ($nuevo_porcentaje < 0.01 || $nuevo_porcentaje > 0.99) {
            return redirect()->to(base_url('/AsignaturaLogro'))->with('mensajeError', 'El porcentaje debe estar entre 0.01 y 0.99.');
        }

        $asignaturaLogroModel = new AsignaturaLogroModel();

        $data = [
            'porcenteje' => $nuevo_porcentaje,
        ];

        if ($asignaturaLogroModel->update($id_asignatura_logro, $data)) {
            return redirect()->to(base_url('/AsignaturaLogro'))->with('mensaje', 'Porcentaje editado correctamente.');
        } else {
            return redirect()->to(base_url('/AsignaturaLogro'))->with('mensajeError', 'Ha ocurrido un error al editar el porcentaje.');
        }
    }

}