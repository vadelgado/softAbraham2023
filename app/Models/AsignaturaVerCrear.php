<?php

namespace App\Models;

use CodeIgniter\Model;

class AsignaturaVerCrear extends Model
{
    
    protected $table            = 'asignaturas';
    protected $primaryKey       = 'id_asignatura';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['area_asignatura','descripcion_asignatura','estado_asignatura'];

    public function actualizarAsignatura($id_asignatura, $data) {
      $asignatura = $this->db->table('asignaturas');
      $asignatura->set($data); // Utilizamos set() para establecer los nuevos datos
      $asignatura->where($this->primaryKey, $id_asignatura); // Utilizamos $this->primaryKey para referenciar la clave primaria
      return $asignatura->update();
  }

  /*public function eliminar_usuario($id_asignatura) {
    $this->db->where('id_asignatura', $id_asignatura);
    $this->db->delete('asignaturas');
}*/
    
    
}
