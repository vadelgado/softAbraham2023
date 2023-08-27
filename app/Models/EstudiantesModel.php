<?php namespace App\Models;
use CodeIgniter\Model;

class EstudiantesModel extends Model{

    protected $table            = 'estudiantes';
    protected $primaryKey       = 'id_Estudiante';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['usuario_id', 'fecha_registro_estuediante','direccion_estudiante',
    'celular_estudiante','fecha_nacimiento', 'genero_estudiante', 'curso_id', 'documento_acudiente',
    'nombre_acudiente', 'telefono_acudiente', 'correo_acudiente'
    ];


    public function actualizarEstudiante($idestudiante, $data) {
        $estudiante = $this->db->table('estudiantes');
        $estudiante->set($data); // Utilizamos set() para establecer los nuevos datos
        $estudiante->where($this->primaryKey, $idestudiante); // Utilizamos $this->primaryKey para referenciar la clave primaria
        return $estudiante->update();
    }
 

    
}