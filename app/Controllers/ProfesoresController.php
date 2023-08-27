<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProfesoresModel;
use App\Models\usuarios;

class ProfesoresController extends Controller{

    public function index(){
        // Obtener el modelo de Usuarios
        $usuariosModel = new usuarios();

        // Obtener todos los usuarios con rol "docente" y estado "1" junto con sus datos de profesor asociado
        $docentesCompletos = $usuariosModel->where('rol', 'docente')
                                         ->where('estado', 1)
                                         ->join('profesores', 'profesores.usuario_id = usuarios.id_usuario') // Carga los datos de profesor asociado automáticamente
                                         ->findAll();

        // Ahora tienes los docentes con todos sus datos completos, incluyendo los datos de profesor
        // Puedes pasar $docentesCompletos a tu vista para mostrar la información

        return view('profesores/listarProfesores', ['docentesCompletos' => $docentesCompletos]);
    }
    
    public function  crear()
    {
        $searchTerm = $this->request->getPost('search_term');
        if ($searchTerm=== NULL) {
            $data['mensaje'] = 'Ingrese el número de documento del docente a registrar con el cual se registro en Usuarios.';
            $data['id_usuario'] = '';
            $data['documento'] = '';
            $data['nombre'] = '';
            $data['correo'] = '';
        } else {
                // Aquí realizamos la búsqueda del usuario por su número de documento.
                $usuarioModel = new usuarios();
                $usuario = $usuarioModel->buscarPorDocumento($searchTerm);
                if ($usuario && $usuario['rol'] === 'docente' && $usuario['estado'] == 1) {
                    // Si encontramos el usuario y es un docente con estado 1, verificamos si ya está registrado como profesor.
                    $profesorModel = new ProfesoresModel();
                    $profesor = $profesorModel->buscarPorUsuarioId($usuario['id_usuario']);
                    
                    if ($profesor && $profesor['usuario_id'] === $usuario['id_usuario']) {
                        // Si ya está registrado como profesor, mostramos un mensaje de error.
                        $data['error'] = 'El usuario ya se encuentra registrado como profesor.';
                        $data['id_usuario'] = '';
                        $data['documento'] = '';
                        $data['nombre'] = '';
                        $data['correo'] = '';
                    } else {
                        // Si no está registrado como profesor, pasamos los datos a la vista para rellenar los campos.
                        $data['id_usuario'] = $usuario['id_usuario'];
                        $data['documento'] = $usuario['documento'];
                        $data['nombre'] = $usuario['nombre'];
                        $data['correo'] = $usuario['correo'];
                    }
                } else  {
                    // Si no encontramos el usuario o no es un docente válido, mostramos un mensaje de error.
                    $data['error'] = 'No se encontró un docente válido con el número de documento ingresado.';
                    $data['id_usuario'] = '';
                    $data['documento'] = '';
                    $data['nombre'] = '';
                    $data['correo'] = '';
                }

                
        }
        return view('profesores/crearProfesores', $data);
        
    }
    
    public function guardarProfesor()
    {
        $docenteModel = new ProfesoresModel();
        $data = [
            'usuario_id' => $this->request->getPost('id_usuario'),
            'fecha_nacimiento' => $this->request->getPost('fecha_nacimiento'),
            'numero_telefono' => $this->request->getPost('numero_telefono'),
            'direccion_residencial' => $this->request->getPost('direccion_residencial'),
            'fecha_inicio_empleo' => $this->request->getPost('fecha_inicio_empleo'),             
            'doc_contactosemergencia' => $this->request->getPost('doc_contactosemergencia'),
            'nombre_emergencia' => $this->request->getPost('nombre_emergencia'),
            'telefono_emergencia' => $this->request->getPost('telefono_emergencia'),
            'titulo_academico' => $this->request->getPost('titulo_academico'),
            'especializacion' => $this->request->getPost('especializacion'),
        ];
        $docenteModel->insert($data);
        return redirect()->to(base_url().'listarProfesores');
    }

    public function editar()
    {
        // Obtenemos el usuario_id del formulario
        $usuario_id = $this->request->getPost('usuario_id');
        
        // Cargamos el modelo de Profesores
        $model = new ProfesoresModel();
    
        // Buscamos el registro del profesor en la base de datos
        $profesor = $model->buscarPorUsuarioId($usuario_id);
    
        // Verificamos si se encontró el registro
        if ($profesor) {
            // Carga la vista con el formulario de edición y los datos del profesor
            return view('profesores\editarProfesores', ['profesor' => $profesor]);
        } else {
            // En caso de que no se encuentre el profesor, puedes mostrar un error o redirigir a otra página
            return redirect()->to(base_url('/listarProfesores'));
        }
    }
    
// ProfesoresController.php

// ProfesoresController.php

public function actualizarProfesor()
{
    echo "<script>console.log('El método activarUsuario está siendo accedido.');</script>";
    // Verificamos si el formulario fue enviado
    if ($this->request->getMethod() === 'post') {
        // Obtenemos los datos del formulario
        $usuario_id = $this->request->getPost('usuario_id');
        $fecha_nacimiento = $this->request->getPost('fecha_nacimiento');
        $numero_telefono = $this->request->getPost('numero_telefono');
        $direccion_residencial = $this->request->getPost('direccion_residencial');
        $fecha_inicio_empleo = $this->request->getPost('fecha_inicio_empleo');
        $doc_contactosemergencia = $this->request->getPost('doc_contactosemergencia');
        $nombre_emergencia = $this->request->getPost('nombre_emergencia');
        $telefono_emergencia = $this->request->getPost('telefono_emergencia');
        $titulo_academico = $this->request->getPost('titulo_academico');
        $especializacion = $this->request->getPost('especializacion');

        // Cargamos el modelo de Profesores
        $model = new ProfesoresModel();

        // Obtenemos los datos del formulario
        $data = [
            'usuario_id' => $usuario_id, 
            'fecha_nacimiento' => $fecha_nacimiento,
            'numero_telefono' => $numero_telefono,
            'direccion_residencial' => $direccion_residencial,
            'fecha_inicio_empleo' => $fecha_inicio_empleo,
            'doc_contactosemergencia' => $doc_contactosemergencia,
            'nombre_emergencia' => $nombre_emergencia,
            'telefono_emergencia' => $telefono_emergencia,
            'titulo_academico' => $titulo_academico,
            'especializacion' => $especializacion,
        ];

        // Actualizamos los datos del profesor en la base de datos
        $model->updateProfesor($usuario_id, $data);

        // Redirigimos a la página de lista de profesores o a otra acción que desees
        return redirect()->to(base_url('/listarProfesores'));
    } else {
        // Si no se envió el formulario, puedes redirigir a la página de lista de profesores o a otra página
        return redirect()->to(base_url('/listarProfesores'));
    }
}  

}
