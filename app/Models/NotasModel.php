<?php 
namespace App\Models;

use CodeIgniter\Model;

class NotasModel extends Model{
    protected $table = 'notas';
    protected $primaryKey = 'id_nota';
    protected $allowedFields = [
        'usuario_doc',
        'curso_asignatura_id',
        'notaSr',
        'notaSb',
        'notaHc'
    ];


    public function actualizarNota($id_nota, $data) {
        $notas = $this->db->table('notas');
        $notas->set($data); // Utilizamos set() para establecer los nuevos datos
        $notas->where($this->primaryKey, $id_nota); // Utilizamos $this->primaryKey para referenciar la clave primaria
        return $notas->update();
    }

    // Relación con la tabla "estudiantes"
    // public function estudiante()
    // {
    //     return $this->belongsTo('App\Models\EstudianteModel', 'estudiante_id', 'id_Estudiante');
    // }

    // Relación con la tabla "asignaturaLogro"
    // public function asignaturaLogro()
    // {
    //     return $this->belongsTo('App\Models\AsignaturaLogroModel', 'asignatura_logro_id', 'id_asignatura_logro');
    // }


}