<?php 
namespace App\Models;

use CodeIgniter\Model;

class AsignaturaModel extends Model{
    protected $table = 'asignaturas';
    protected $primaryKey = 'id_asignatura';
    protected $allowedFields = [
        'area_asignatura',
        'descripcion_asignatura',
    ];

    // Relación con la tabla "cursosAsignatura"
    public function cursosAsignatura()
    {
        return $this->hasMany('App\Models\CursoAsignaturaModel', 'asignatura_id', 'id_asignatura');
    }
}