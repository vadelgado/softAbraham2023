<?php namespace App\Models;
use CodeIgniter\Model;

class usuarios extends Model{

    protected $table            = 'usuarios';
    protected $primaryKey       = 'documento';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['documento', 'nombre','correo','contrasenia','rol','estado'];
        
    protected $belongsTo  = [
           'profesor' => [
           'model' => 'App\Models\ProfesoresModel',
           'foreign_key' => 'usuario_id',
            'local_key' => 'id_usuario'
        ]
    ];  
    public function buscarPorDocumento($documento)
    {
        // Realiza la búsqueda del usuario por su número de documento y verifica el estado y el rol.
        // Reemplaza 'documento' con el nombre del campo en tu tabla, y 'docente' con el valor del rol de docente.
        return $this->where('documento', $documento)
                    ->where('estado', 1)
                    ->where('rol', 'docente')
                    ->first();
    }
    
    public function buscarEstudiante($documento)
    {
        return $this->where('documento', $documento)
                    ->where('estado', 1)
                    ->where('rol', 'estudiante')
                    ->first();
    }  
   

    //busca al usuario enviadole el correo y la contraseña en la variable data
    public function obtenerUsuario($data){
        $usuario = $this->db->table('usuarios');
        $usuario->where($data);
        return $usuario->get()->getResultArray();
    }
    
    
    public function actualizarUsuario($idUsuario, $data) {
        $usuario = $this->db->table('usuarios');
        $usuario->set($data); // Utilizamos set() para establecer los nuevos datos
        $usuario->where($this->primaryKey, $idUsuario); // Utilizamos $this->primaryKey para referenciar la clave primaria
        return $usuario->update();
    }

    /*ADD @VADELGADO*/
    // Relación con la tabla "estudiantes"
    public function estudiantes()
    {
        return $this->hasMany('App\Models\EstudianteModel', 'usuario_id', 'id_usuario');
    }

    // Relación con la tabla "profesores"
    public function profesores()
    {
        return $this->belongsTo('App\Models\ProfesorModel', 'usuario_id', 'id_usuario');
    }
    /*END*/

}