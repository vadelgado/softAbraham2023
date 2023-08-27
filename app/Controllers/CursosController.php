<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CursoModel;
class CursosController extends Controller{

    public function obtenerCursos(){
        $cursoModel = new CursoModel();
        $cursos = $cursoModel->findAll();

        $listaCursos = [
            'cursos' => $cursos
        ];

        return view($listaCursos);
    }
   

}