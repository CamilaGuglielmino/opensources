<?php
namespace App\Models;
use CodeIgniter\Model;

class SubtareaModel extends Model
{
    protected $table = 'subtarea';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_tarea', 'id_usuario', 'descripcion', 'estado', 'prioridad', 'fecha_creacion', 'fecha_vencimiento', 'fecha_recordatorio', 'comentario', 'colaborador','archivo'];

    public function mostrarSubtarea($data)
    {
        $query = $this->table; // Usa la tabla definida en el modelo

        if (!empty($data['id_usuario'])) {
            $query->groupStart()
                ->where('id_usuario', $data['id_usuario'])
                ->orWhere("FIND_IN_SET('" . esc($data['id_usuario']) . "', colaborador) >", 0)
                ->groupEnd();
        }

        if (!empty($data['ordenar']) && in_array($data['ordenar'], ['fecha_vencimiento', 'prioridad', 'estado'])) {
            $query->orderBy($data['ordenar'], 'ASC');
        }

        return $query->get()->getResultArray();
    }

    public function mostrarSubtareaID($data)
    {
        $query = $this->db->table('subtarea');

        if (!empty($data['tarea'])) {
            $query->where('tarea', $data['tarea']);
        }

        return $query->get()->getResultArray();
    }

    public function mostrarSubtareaID2($data)
    {
        $query = $this->db->table('subtarea');

        if (!empty($data['id'])) {
            $query->where('id', $data['id']);
        }

        return $query->get()->getResultArray();
    }

    //controla id usuario o correo como colab
    public function obtenerSubtarea($id, $correo){
    return $this->groupStart()
                   ->where('id_usuario', $id)
                   ->orLike('colaborador', $correo) // Busca si el correo aparece en el string
                ->groupEnd()
                ->findAll();
}

    public function obtener_subtarea($id)
    {
        return $this->db->table('subtarea')
            ->select('id, descripcion, fecha_creacion, fecha_vencimiento, estado, prioridad,comentario')
            ->where('id', $id)
            ->get()
            ->getRowArray(); // Para obtener un solo resultado en forma de array
    }

        public function obtenerNombreEstado($estadoId){
        $estados = [
            1 => 'Pendiente',
            2 => 'En progreso',
            3 => 'Completado',
            4 => 'Cancelado'
        ];

        return isset($estados[$estadoId]) ? $estados[$estadoId] : 'Desconocido';
    }
    public function obtenerNombrePrioridad($prioridadId)  {
        $prioridades = [
            1 => 'Alta',
            2 => 'Media',
            3 => 'Baja'
        ];

        return isset($prioridades[$prioridadId]) ? $prioridades[$prioridadId] : 'Desconocida';
    }
}
?>