<?php

namespace App\Controllers;

use CodeIgniter\Controller;


class CursoViewController extends BaseController
{
    public function index()
    {
        return view('Cursos\CursoView');
    }
}