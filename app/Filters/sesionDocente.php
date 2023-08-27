<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class sesionDocente implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if((session('rol') == 'docente')){
            return redirect()->to(base_url('/prueba'));
        }     
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}