<?php 
namespace App\Models;

use CodeIgniter\Model;

class LogroModel extends Model{
    protected $table = 'logro';
    protected $primaryKey = 'id_logro';
    protected $allowedFields = [
        'nombre_logro',
    ];

    // Relación con la tabla "asignaturaLogro"
    public function asignaturaLogros()
    {
        return $this->hasMany('App\Models\AsignaturaLogroModel', 'logro_id', 'id_logro');
    }
}