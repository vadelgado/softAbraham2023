<?php

namespace App\Controllers;
use App\Models\usuarios;

class loginController extends BaseController
{
    public function index()
    {
        $mensaje=session('mensaje');
        return view('auth/login', ["mensaje" => $mensaje]);
    }

    public function prueba()
    {
        return view('auth/prueba');
    }

    
    public function login(){

        $user = $this->request->getpost('usuario');
        $password = $this->request->getpost('password');

        $usuario = new usuarios();

        $datosUsuario = $usuario->obtenerUsuario(['correo' => $user]);
        
        if(count ($datosUsuario) > 0 && password_verify($password, $datosUsuario[0]['contrasenia'])){
           
            $data = [
                "correo" => $datosUsuario[0]['correo'],
                "nombre" => $datosUsuario[0]['nombre'],
                "rol" => $datosUsuario[0]['rol'],
                "estado"=> $datosUsuario[0]['estado']
            ];

            $session = session();
            $session->set($data);

            if(session('estado')==true){
                return redirect()->to(base_url('/inicio'));
            }
            else{
                return redirect()->to(base_url('/'))->with('mensaje', 'Usuario inactivo');
            }         
        }else{
            return redirect()->to(base_url('/'))->with('mensaje', 'Correo o contraseña incorrectos');
        }

    }

    public function salir(){ 
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
}