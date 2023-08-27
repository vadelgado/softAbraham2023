<?php 
namespace App\Models;

use CodeIgniter\Model;

class CursoAsignaturaModel extends Model{
    protected $table = 'cursosAsignatura';
    protected $primaryKey = 'id_curso_asignatura';
    protected $allowedFields = [
        'curso_id',
        'asignatura_id',
        'profesor_id',
        'estadoca',
    ];

    // Relación con la tabla "cursos"
    public function curso()
    {
        return $this->belongsTo('App\Models\CursoModel', 'curso_id', 'id_curso');
    }

    // Relación con la tabla "asignaturas"
    public function asignatura()
    {
        return $this->belongsTo('App\Models\AsignaturaModel', 'asignatura_id', 'id_asignatura');
    }

    // Relación con la tabla "profesores"
    public function profesor()
    {
        return $this->belongsTo('App\Models\ProfesorModel', 'profesor_id', 'id');
    }

    // Relación con la tabla "asignaturaLogro"
    public function asignaturaLogros()
    {
        return $this->hasMany('App\Models\AsignaturaLogroModel', 'curso_asignatura_id', 'id_curso_asignatura');
    }

        /**
     * Cargar relaciones con otros modelos.
     *
     * @param array|string $relations Nombre de las relaciones a cargar
     * @return $this
     */
    public function obtenerDatosTabla()
    {
        $this->select('cursosAsignatura.*, cursos.nombre_curso, asignaturas.area_asignatura, usuarios.nombre as nombre_profesor');
        $this->join('cursos', 'cursosAsignatura.curso_id = cursos.id_curso');
        $this->join('asignaturas', 'cursosAsignatura.asignatura_id = asignaturas.id_asignatura');
        $this->join('profesores', 'cursosAsignatura.profesor_id = profesores.id');
        $this->join('usuarios', 'profesores.usuario_id = usuarios.id_usuario');
               
        return $this->findAll();
    }


}