<?php

namespace App\Controllers;
use App\Models\CursoModel;
use App\Models\CursoAsignaturaModel;
use App\Models\EstudiantesModel;
use App\Models\LogroModel;
use App\Models\AsignaturaLogroModel;
use App\Models\NotasModel;

class BoletinController extends BaseController
{
    public function index()
    {
        $asigCurso = new CursoAsignaturaModel();

        $boletines= $asigCurso
        ->distinct('cursos.id_curso')
        ->select('cursos.nombre_curso, asignaturalogro.periodo, cursos.id_curso')
        ->join('cursos', 'cursosAsignatura.curso_id = cursos.id_curso')
        ->join('asignaturalogro', 'cursosAsignatura.id_curso_asignatura=asignaturalogro.curso_asignatura_id')
        ->findAll();

        $data = [
            'boletines' => $boletines
        ];

        return view('boletines\boletinList', $data);
    }

    public function verBoletin($id){

        $notas = new NotasModel();
        $cursoAsignatura = new CursoAsignaturaModel();
        $curso = new CursoModel();
        $logroAsig = new AsignaturaLogroModel();

        $listadoEstudiantesCurso = $cursoAsignatura
        ->distinct('usuarios.documento')
        ->select('usuarios.documento, usuarios.nombre')
        ->join('estudiantes', 'cursosAsignatura.curso_id=estudiantes.curso_id')
        ->join('usuarios', 'estudiantes.usuario_id=usuarios.id_usuario')    
        ->join('cursos', 'cursosAsignatura.curso_id=cursos.id_curso')
        ->where('cursos.id_curso',$id)
        ->findAll();


        $total=0;
        foreach ($listadoEstudiantesCurso as &$estudiante) {
            $notasEstudiante = $notas
                ->distinct('usuarios.documento')
                ->select('usuarios.documento, SUM(notas.notaSr) as sumaNotaSr,
                SUM(notas.notaSb) as sumaNotaSb, SUM(notas.notaHc) as sumaNotaHc')
                ->join('usuarios', 'notas.usuario_doc=usuarios.documento')  
                ->join('cursosAsignatura', 'cursosAsignatura.id_curso_asignatura=notas.curso_asignatura_id')  
                ->join('cursos', 'cursosAsignatura.curso_id=cursos.id_curso')
                ->where('cursos.id_curso', $id)
                ->where('usuarios.documento', $estudiante['documento'])
                ->findAll();

            // Acceder a la suma de notas notaSr
            $sumaNotaSr = $notasEstudiante[0]['sumaNotaSr'];
            $sumaNotaSb = $notasEstudiante[0]['sumaNotaSb'];
            $sumaNotaHc = $notasEstudiante[0]['sumaNotaHc'];

            $totaAsig = $cursoAsignatura
            ->select('COUNT(asignaturas.area_asignatura) as total_asignaturas')
            ->join('asignaturas', 'cursosasignatura.asignatura_id = asignaturas.id_asignatura')
            ->join('cursos', 'cursosasignatura.curso_id = cursos.id_curso')
            ->where('cursos.id_curso', $id)
            ->findAll();

            $sumaDefinitivas = ( $sumaNotaHc+$sumaNotaSb+$sumaNotaSr)/$totaAsig[0]['total_asignaturas'];
            $estudiante['sumaNotas']=number_format($sumaDefinitivas , 2, '.', '');

            $estudiante['desempenio'] = $this->CalcularDesempenio(number_format($sumaDefinitivas , 2, '.', ''));
        }

        $estudiantesConNota = $cursoAsignatura
            ->where('cursosAsignatura.curso_id', $id)
            ->join('notas', 'cursosAsignatura.id_curso_asignatura = notas.curso_asignatura_id')
            ->join('usuarios', 'notas.usuario_doc = usuarios.documento') 
            ->join('asignaturas','cursosAsignatura.asignatura_id=asignaturas.id_asignatura')
            ->join('profesores','cursosAsignatura.profesor_id=profesores.id')
            ->findAll();

        foreach ($estudiantesConNota as &$estudiante) {

            //nombre del docente que imparte la materia
            $docente = 'docente';
            $profesorCurso = $cursoAsignatura
            ->select('usuarios.nombre')
            ->where('cursosAsignatura.curso_id', $id)
            ->where('profesores.id', $estudiante['profesor_id'])
            ->where('usuarios.rol', $docente)
            ->join('profesores','cursosAsignatura.profesor_id=profesores.id')
            ->join ('usuarios','profesores.usuario_id=usuarios.id_usuario')
            ->first();
            $estudiante['docente'] = $profesorCurso;

            // Calcular la suma de las notas
            $sumaNotas = number_format(($estudiante['notaSr'] + $estudiante['notaSb'] + $estudiante['notaHc']), 2, '.', '');
            $estudiante['sumaNotas'] = $sumaNotas;

            //validacion del rango de desempeño
            $estudiante['desempenio'] = $this->CalcularDesempenio($sumaNotas);
            
            //porcentajes relacionados con cada asignatura
            $porcentajeHacer= $logroAsig->porcentajeLogro(1, $estudiante['curso_asignatura_id']);
            $porcentajeSaber= $logroAsig->porcentajeLogro(2, $estudiante['curso_asignatura_id']);
            $porcentajeSer= $logroAsig->porcentajeLogro(3, $estudiante['curso_asignatura_id']);

            $estudiante['porcentajeHacer'] = $porcentajeHacer['porcenteje'];
            $estudiante['porcentajeSaber'] = $porcentajeSaber['porcenteje'];
            $estudiante['porcentajeSer'] =$porcentajeSer['porcenteje'];

            //notas ingresadas al sistema
            $estudiante['notaSr2'] = number_format($estudiante['notaSr'] /  $porcentajeSer['porcenteje'] , 2, '.', '');
            $estudiante['notaSb2'] = number_format($estudiante['notaSb'] /  $porcentajeSaber['porcenteje'], 2, '.', '');  
            $estudiante['notaHc2'] = number_format($estudiante['notaHc'] /  $porcentajeHacer['porcenteje'] , 2, '.', '');
        }

        $nombreCurso = $curso
        ->select('nombre_curso')
        ->where('id_curso',$id)
        ->first();

        $data = [
            'nombrecurso' => $nombreCurso,
            'estudiantesConNota' => $estudiantesConNota,
            'listadoEstudiantesCurso' =>$listadoEstudiantesCurso
        ];

        return view('boletines\viewBoletin', $data);
    }

    public function CalcularDesempenio($notas){
        $desempenio='';
        if($notas>=1.0 && $notas<=2.99){
            $desempenio= 'BAJO';
        }
        else if($notas>=3.0 && $notas<=3.99){
            $desempenio = 'BÁSICO';
        }
        else if($notas>=4.0 && $notas<=4.69){
            $desempenio = 'ALTO';
        }
        else if($notas>=4.7 && $notas<=5.0){
            $desempenio = 'SUPERIOR';
        }
        return $desempenio;
    }
}
