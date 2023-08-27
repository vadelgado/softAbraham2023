<?php 
namespace App\Models;

use CodeIgniter\Model;

class CursoModel extends Model{
    protected $table = 'cursos';
    protected $primaryKey = 'id_curso';
    protected $allowedFields = [
        'nombre_curso',
        'tipo_curso',
        'estado_curso'
    ];

    // Relación con la tabla "estudiantes"
    public function estudiantes()
    {
        return $this->hasMany('App\Models\EstudianteModel', 'curso_id', 'id_curso');
    }

    // Relación con la tabla "cursosAsignatura"
    public function cursosAsignatura()
    {
        return $this->hasMany('App\Models\CursoAsignaturaModel', 'curso_id', 'id_curso');
    }


    public function actualizarCurso($id_curso, $data) {
        $curso = $this->db->table('cursos');
        $curso->set($data); // Utilizamos set() para establecer los nuevos datos
        $curso->where($this->primaryKey, $id_curso); // Utilizamos $this->primaryKey para referenciar la clave primaria
        return $curso->update();
    }
}