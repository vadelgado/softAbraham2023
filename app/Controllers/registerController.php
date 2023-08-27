<?php

namespace App\Controllers;
use App\Models\usuarios;

//verifica si esta ingresando al metodo
//var_dump("Método editUser invocado"); 
// echo "<script>console.log('El método activarUsuario está siendo accedido.');</script>";

class registerController extends BaseController
{
    public function index()
    {
       $usuario = new usuarios();
       $data = $usuario->findAll();
       $data =['data' => $data];
        return view('auth\userList', $data);
    }

    public function register()
    {
        return view('auth\register');
    }

    public function registrar(){
        try{
            $usuario = new usuarios();
            $documento = $this->request->getPost('documento');
            $correo = $this->request->getPost('correo');

            // Verificar si el número de documento ya existe
            $existeDocumento = $usuario->where('documento', $documento)->first();
            if ($existeDocumento) {
                return redirect()->to(base_url('/register'))->with('mensajeError', 'El número de documento ya está registrado');
            }

            // Verificar si el correo ya existe
            $existeCorreo = $usuario->where('correo', $correo)->first();
            if ($existeCorreo) {
                return redirect()->to(base_url('/register'))->with('mensajeError', 'El correo ya está registrado');
            }

            // Si no existen duplicados, proceder con el registro
            $data=[
                'documento' => $documento,
                'nombre' => $this->request->getPost('nombre'),
                'correo' => $correo,
                'contrasenia' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'rol' => $this->request->getPost('rol'),
                'estado' => true
            ];
    
            $usuario->insert($data);
            return redirect()->to(base_url('/usuarios'))->with('mensaje', 'Usuario creado con éxito');
        }
        catch(Exception $e){
            return redirect()->to(base_url('/usuarios'))->with('mensajeError', 'Ha ocurrido un error, usuario no creado');
        }
    }


    //EDITAR USUARIO
    public function editUser(){
     
          // Verificar si se recibió el documento del usuario en la solicitud POST
          if (isset($_POST['documento'])) {
            $documento = $_POST['documento'];

            $userData = $this->getUserDataFromDatabase($documento);

            // Devolver los datos del usuario en formato JSON
            echo json_encode($userData);
            exit;
           }
        // Si no se recibió el documento o ocurrió un error, devolver un mensaje de error
        echo json_encode(['error' => 'Error al obtener los datos del usuario']);
        exit;
    }

    // Método para obtener los datos del un usuario a partir del numero de documento
    private function getUserDataFromDatabase($documento)
    {
        $usuario = new usuarios();
        $existeUsuario = $usuario->where('documento', $documento)->first();
        return $existeUsuario; 
    }

    public function editUserSave(){
        $usuario = new usuarios();
        $documento = $this->request->getPost('documento');
        $nuevoNombre = $this->request->getPost('nombre');

        $nuevoRol= $this->request->getPost('rol');
        $estado= $this->request->getPost('estado');
        $esActivo = ($estado == 1) ? true : false;
        
    
        // Realizar la actualización utilizando el modelo
        $data = array(
            'nombre' => $nuevoNombre,
            //'correo' => $nuevoCorreo,
            'rol' => $nuevoRol,
            'estado'=> $esActivo

        );

        $isCorrect = $usuario->actualizarUsuario($documento, $data);
        if($isCorrect){
            return redirect()->to(base_url('/usuarios'))->with('mensaje', 'Usuario actualizado con éxito');
        } 
        else{
            return redirect()->to(base_url('/usuarios'))->with('mensaje', 'Ha ocurrido un error en la actualización');
        }
       
    }

    public function activeUser(){
        // Verificar si se recibió el documento del usuario en la solicitud POST
        if (isset($_POST['documento']) && isset($_POST['estado'])) {
            $documento = $_POST['documento'];
            $estado = $_POST['estado'];
            $esActivo = ($estado == 0) ? true : false;

            $usuario = new usuarios();      
    
            // Realizar la actualización utilizando el modelo
            $data = array(
                'estado'=> $esActivo
            );
            
            $isCorrect = $usuario->actualizarUsuario($documento, $data);
            if($isCorrect){
                if($estado==1)
                 echo json_encode(['exito' => 'Usuario activado']);
                else
                 echo json_encode(['exito' => 'Usuario desactivado']);
                exit;
            } 
            else{
                echo json_encode(['error' => 'Error al obtener los datos del usuario']);
                exit;
            }
        }
        // Si no se recibió el documento o ocurrió un error, devolver un mensaje de error
        echo json_encode(['error' => 'Error al obtener los datos del usuario']);
        exit;    
    }  

}
