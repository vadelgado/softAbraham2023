<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class sessionAdministrador implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if((session('rol') != 'administrador')){
            if(session('rol')=='docente'){
                return redirect()->to(base_url('/prueba'));
            }
            return redirect()->to(base_url('/'));
        }     
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}