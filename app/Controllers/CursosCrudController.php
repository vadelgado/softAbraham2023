<?php

namespace App\Controllers;
use App\Models\CursoModel;

class CursosCrudController extends BaseController
{
    public function index()
    {
        $curso = new CursoModel();
       $data = $curso->findAll();
       $data =['data' => $data];
        return view('CursosCrud\listarcursos', $data);
       
    }
    public function nuevoCurso(){
        return view('CursosCrud\newcurso' );
    }

    public function registrarCurso()
    {
        $cursoModel = new CursoModel();
        $data = [
            'nombre_curso' => $this->request->getPost('nombre_curso'),
            'tipo_curso' => $this->request->getPost('tipo_curso'),
            'estado_curso'=> $this->request->getPost('estado_curso')
        ];
        $cursoModel->insert($data);
        return redirect()->to(base_url().'cursos');
    }
    // public function editarCurso($id_curso){
    //     $cursoModel = new CursoModel();
    //     $data = $cursoModel->find($id_curso);
    //     $data = ['data' => $data ];

    //     return view('CursosCrud/editarcurso',$data);
    // }

    public function editarCurso(){
        if (isset($_POST['id_curso'])) {
            $id = $_POST['id_curso'];
        
            $cursoModel = new CursoModel();
            $data = $cursoModel->find($id);
            $data = ['data' => $data ];
            echo json_encode($data);
            exit;
        }
        else{
            echo json_encode(['error' => 'Error al obtener los datos del curso']);
            exit;
        }
       
    }

     public function edicionCurso(){
       
        $cursoModel = new CursoModel();
        $id_curso = $this->request->getPost('id_curso');
        $data = [
            'nombre_curso' => $this->request->getPost('nombre_curso'),
            'tipo_curso' => $this->request->getPost('tipo_curso'),
            'estado_curso'=> $this->request->getPost('estado_curso')
        ];
        
        $isCorrect = $cursoModel->actualizarCurso($id_curso, $data);
        
        if($isCorrect){
            return redirect()->to(base_url('/cursos'))->with('mensaje', 'Curso actualizado con éxito');
        } 
        else{
            return redirect()->to(base_url('/cursos'))->with('mensaje', 'Ha ocurrido un error en la actualización');
        }
    

     }
}
