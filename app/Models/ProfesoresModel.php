<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProfesoresModel extends Model
{
    protected $table            = 'profesores';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields = [
        'usuario_id',
        'fecha_nacimiento',
        'numero_telefono',
        'direccion_residencial',
        'fecha_inicio_empleo',
        'doc_contactosemergencia',
        'nombre_emergencia',
        'telefono_emergencia',
        'titulo_academico',
        'especializacion'
    ];
    
    protected $belongsTo  = [
        'usuario' => [
            'model' => 'App\Models\UsuariosModel',
            'foreign_key' => 'id_usuario',
            'local_key' => 'usuario_id'
        ]
    ];

    public function buscarPorUsuarioId($usuario_id)
    {
        $query = $this->where('usuario_id', $usuario_id)->get();
        return $query->getRowArray();
    }

    public function updateProfesor($usuario_id, $data)
    {
        // Realiza la validación de los datos antes de la actualización
        if ($this->hasValidData($data)) {
            // Convertir campos a sus tipos correspondientes
            $data['usuario_id'] = (int)$data['usuario_id'];
            $data['fecha_nacimiento'] = date('Y-m-d', strtotime($data['fecha_nacimiento']));
            $data['fecha_inicio_empleo'] = date('Y-m-d', strtotime($data['fecha_inicio_empleo']));
            $data['doc_contactosemergencia'] = (int)$data['doc_contactosemergencia'];

            // Realizar la actualización en la base de datos
            $builder = $this->builder();
            $builder->where('usuario_id', $usuario_id);
            $builder->set($data);
            $builder->update();

            return true;
        }

        return false;
    }

    private function hasValidData(array $data): bool
    {
        // Realiza la validación de los datos aquí
        // Por ejemplo, asegúrate de que los campos obligatorios no estén vacíos
        // Puedes agregar otras condiciones de validación según tus necesidades

        $valid = !empty($data['usuario_id']) &&
            !empty($data['fecha_nacimiento']) &&
            !empty($data['numero_telefono']) &&
            !empty($data['direccion_residencial']) &&
            !empty($data['fecha_inicio_empleo']) &&
            !empty($data['doc_contactosemergencia']) &&
            !empty($data['nombre_emergencia']) &&
            !empty($data['telefono_emergencia']) &&
            !empty($data['titulo_academico']) &&
            !empty($data['especializacion']);

        if (!$valid) {
            // Depurar los campos que no están pasando la validación
            $invalidFields = array_filter($data, function ($value) {
                return empty($value);
            });
            var_dump($invalidFields);
        }

        return $valid;
    }

    /*ADD @VADELGADO*/
        // Relación con la tabla "usuarios"
        // public function usuario()
        // {
        //     return $this->belongsTo('App\Models\UsuarioModel', 'usuario_id', 'documento');
        // }
    
        // Relación con la tabla "cursosAsignatura"
        public function cursosAsignatura()
        {
            return $this->hasMany('App\Models\CursoAsignaturaModel', 'profesor_id', 'id');
        }

            // Método para cargar ansiosamente la relación con la tabla 'usuarios'
    public function buscarConUsuario(){
        // Realizamos un JOIN para obtener los profesores que tienen una relación con usuarios
        $this->select('profesores.*, usuarios.nombre as nombre_usuario');
        $this->join('usuarios', 'usuarios.id_usuario = profesores.usuario_id', 'left');
        $this->where('usuarios.estado', 1);    

        return $this->findAll();
    }


    /*END*/
}