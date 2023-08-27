<?php

namespace App\Controllers;
use App\Models\CursoModel;
use App\Models\CursoAsignaturaModel;
use App\Models\EstudiantesModel;
use App\Models\LogroModel;
use App\Models\AsignaturaLogroModel;
use App\Models\NotasModel;

class CalificacionesController extends BaseController
{
    public function index()
    {
        $curso = new CursoModel();
        $estudiantes = []; // Lista vacía de estudiantes
        $nomCursoAsig = []; // Inicializamos con un arreglo vacío
        $estudiantesConNota = []; // Inicializamos con un arreglo vacío

        $nombreCurso = ""; 
        $nombreAsignatura = ""; 
    
        // Asignamos los valores a $nomCursoAsig
        $nomCursoAsig['area_asignatura'] = $nombreAsignatura;
        $nomCursoAsig['nombre_curso'] = $nombreCurso;

        $data = [
            'cursos' => $curso->findAll(),
            'estudiantes' => $estudiantes,
            'estudiantesConNota'=>$estudiantesConNota,
            'nomCursoAsig' => $nomCursoAsig
        ];

        return view('Calificaciones\grades', $data);
    }

    public function getAsignaturasporCurso() {

        if (isset($_POST['curso'])) {
            $curso_id = $_POST['curso'];

            $asigCurso = new CursoAsignaturaModel();
    
            $asignaturas = $asigCurso->where('curso_id', $curso_id)
            ->join('asignaturas', 'cursosAsignatura.asignatura_id = asignaturas.id_asignatura') 
            ->findAll();
            if($asignaturas==null){
                echo json_encode(['vacio' => 'vacio']);
                exit;
            }
            else{
                echo json_encode($asignaturas);
                exit;
            }
           
        }
        else{
            echo json_encode(['error' => 'Error al obtener las asignaturas']);
            exit;
        }
    }

    public function obtenerEstudiantes(){

        $asigCurso = new CursoAsignaturaModel();
        $curso = new CursoModel();
        $logroAsig = new AsignaturaLogroModel();

        $curso_id = $this->request->getPost('curso');
        $asignatura_id = $this->request->getPost('asignatura');

        $nomCursoAsig = $asigCurso
            ->where('cursosAsignatura.curso_id', $curso_id)
            ->where('asignatura_id', $asignatura_id)
            ->join('asignaturas', 'cursosAsignatura.asignatura_id = asignaturas.id_asignatura')
            ->join('cursos', 'cursosAsignatura.curso_id = cursos.id_curso')
            ->first();    

        $existeConfig= $logroAsig
                ->where('asignaturalogro.curso_asignatura_id', $nomCursoAsig['id_curso_asignatura'])
                ->countAllResults(); 
        
        if($existeConfig!=0){
            $estudiantes = $asigCurso
            ->where('cursosAsignatura.curso_id', $curso_id)
            ->where('asignatura_id', $asignatura_id)
            ->join('estudiantes', 'cursosAsignatura.curso_id = estudiantes.curso_id') 
            ->join('usuarios', 'estudiantes.usuario_id = usuarios.id_usuario')
            ->findAll();
        
            $estudiantesConNota = $asigCurso
                ->where('cursosAsignatura.curso_id', $curso_id)
                ->where('asignatura_id', $asignatura_id)
                ->join('notas', 'cursosAsignatura.id_curso_asignatura = notas.curso_asignatura_id')
                ->join('usuarios', 'notas.usuario_doc = usuarios.documento') 

                ->findAll();

            foreach ($estudiantesConNota as &$estudiante) {
                // Calcular la suma de las notas
                $sumaNotas = $estudiante['notaSr'] + $estudiante['notaSb'] + $estudiante['notaHc'];
                $estudiante['sumaNotas'] = number_format($sumaNotas, 2, '.', ''); // Agregar al arreglo
                
                $porcentajeHacer= $logroAsig->porcentajeLogro(1, $estudiante['curso_asignatura_id']);
                $porcentajeSaber= $logroAsig->porcentajeLogro(2, $estudiante['curso_asignatura_id']);
                $porcentajeSer= $logroAsig->porcentajeLogro(3, $estudiante['curso_asignatura_id']);

                $estudiante['notaSr'] = number_format($estudiante['notaSr'] /  $porcentajeSer['porcenteje'] , 2, '.', '');
                $estudiante['notaSb'] = number_format($estudiante['notaSb'] /  $porcentajeSaber['porcenteje'], 2, '.', '');  
                $estudiante['notaHc'] = number_format($estudiante['notaHc'] /  $porcentajeHacer['porcenteje'] , 2, '.', '');
            }

            $estudiantesSinNota = array_filter($estudiantes, function($estudiante) use ($estudiantesConNota) {
                foreach ($estudiantesConNota as $estudianteConNota) {
                    if ($estudiante['usuario_id'] == $estudianteConNota['id_usuario']) {
                        return false; // El estudiante tiene una nota, no se incluye
                    }
                }
                return true; // El estudiante no tiene nota, se incluye en $estudiantesSinNota
            });

            $curso = new CursoModel();
            
            $data = [
                'cursos' => $curso->findAll(),
                'estudiantes' => $estudiantesSinNota,
                'nomCursoAsig' => $nomCursoAsig,
                'estudiantesConNota' => $estudiantesConNota
            ];
            return view('Calificaciones\grades', $data);
        
        }
        else{
            $curso = new CursoModel();
            $estudiantes = []; // Lista vacía de estudiantes
            $nomCursoAsig = []; // Inicializamos con un arreglo vacío
            $estudiantesConNota = []; // Inicializamos con un arreglo vacío

            $nombreCurso = ""; 
            $nombreAsignatura = ""; 
            $mensaje = "El curso y la asignatura no tienen asignado los porcentajes de los logros";
              // Asignamos los valores a $nomCursoAsig
            $nomCursoAsig['area_asignatura'] = $nombreAsignatura;
            $nomCursoAsig['nombre_curso'] = $nombreCurso;

            $data = [
                'cursos' => $curso->findAll(),
                'estudiantes' => $estudiantes,
                'nomCursoAsig' => $nomCursoAsig,
                'estudiantesConNota' => $estudiantesConNota,
                'mensaje' => $mensaje
            ];
            
            return view('Calificaciones\grades', $data);
        }

        
    }


    public function guardarCalificaciones(){

        try{
        // Verificar si se recibió el documento del usuario en la solicitud POST
        if (isset($_POST['id_curso_asignatura']) && isset($_POST['documento'])
         && isset($_POST['hacer'])
         && isset($_POST['saber']) && isset($_POST['ser']) ) {

            $id_curso_asignatura = $_POST['id_curso_asignatura'];
            $documento = $_POST['documento'];
            $hacer = $_POST['hacer'];
            $saber = $_POST['saber'];
            $ser = $_POST['ser'];
            
            $logroAsig = new AsignaturaLogroModel();
            $notas = new NotasModel();
          
            $porcentajeHacer= $logroAsig->porcentajeLogro(1, $id_curso_asignatura);
            $porcentajeSaber= $logroAsig->porcentajeLogro(2, $id_curso_asignatura);
            $porcentajeSer= $logroAsig->porcentajeLogro(3, $id_curso_asignatura);

            $valHacer= $porcentajeHacer['porcenteje'] * floatval($hacer);
            $valSaber= $porcentajeSaber['porcenteje'] * floatval($saber);
            $valSer= $porcentajeSer['porcenteje'] * floatval($ser);

            $promedio=$valHacer+$valSaber+$valSer;

             // Realizar la inserción utilizando el modelo
             $data = array(
                'usuario_doc' => $documento,
                'curso_asignatura_id' => trim($id_curso_asignatura),
                'notaSr' => number_format($valSer, 2, '.', ''),
                'notaSb' => number_format($valSaber, 2, '.', ''),
                'notaHc' => number_format($valHacer, 2, '.', ''),
            );

           $correct = $notas->insert($data);
        
            echo json_encode(number_format($promedio, 2, '.', ''));
            
        }
        else{
            echo json_encode(['error' => 'Error al obtener los datos del usuario']);
            exit;
        }
        }
        catch (Exception $e) {
            echo json_encode(['error' => 'Error en el servidor: ' . $e->getMessage()]);
        }     
    }

    public function actualizarCalificaciones(){

        try{
        // Verificar si se recibió el documento del usuario en la solicitud POST
        if ( isset($_POST['id_nota']) &&isset($_POST['id_curso_asignatura']) && isset($_POST['documento'])
         && isset($_POST['hacer'])
         && isset($_POST['saber']) && isset($_POST['ser']) ) {

            $id_nota = $_POST['id_nota'];
            $id_curso_asignatura = $_POST['id_curso_asignatura'];
            $documento = $_POST['documento'];
            $hacer = $_POST['hacer'];
            $saber = $_POST['saber'];
            $ser = $_POST['ser'];
            
            $logroAsig = new AsignaturaLogroModel();
            $notas = new NotasModel();
          
            $porcentajeHacer= $logroAsig->porcentajeLogro(1, $id_curso_asignatura);
            $porcentajeSaber= $logroAsig->porcentajeLogro(2, $id_curso_asignatura);
            $porcentajeSer= $logroAsig->porcentajeLogro(3, $id_curso_asignatura);

            $valHacer= $porcentajeHacer['porcenteje'] * floatval($hacer);
            $valSaber= $porcentajeSaber['porcenteje'] * floatval($saber);
            $valSer= $porcentajeSer['porcenteje'] * floatval($ser);

            $promedio=$valHacer+$valSaber+$valSer;

             // Realizar la inserción utilizando el modelo
             $data = array(
                'usuario_doc' => $documento,
                'curso_asignatura_id' => trim($id_curso_asignatura),
                'notaSr' => number_format($valSer, 2, '.', ''),
                'notaSb' => number_format($valSaber, 2, '.', ''),
                'notaHc' => number_format($valHacer, 2, '.', ''),
            );

             $correct = $notas->actualizarNota($id_nota, $data);
        
            echo json_encode(number_format($promedio, 2, '.', ''));
            
        }
        else{
            echo json_encode(['error' => 'Error al obtener los datos del usuario']);
            exit;
        }
        }
        catch (Exception $e) {
            echo json_encode(['error' => 'Error en el servidor: ' . $e->getMessage()]);
        }     
    }

}
