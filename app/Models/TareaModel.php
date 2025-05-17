<?php
namespace App\Models;
use CodeIgniter\Model;

class TareaModel extends Model
{
    protected $table = 'tarea';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id_usuario',
        'tema',
        'descripcion',
        'prioridad',
        'estado',
        'fecha_vencimiento',
        'fecha_recordatorio',
        'fecha_creacion',
        'archivo',
        'colaborador'
    ];

    public $reglas = [
        'tema' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'El campo tema es obligatorio.',
                'min_length' => 'El tema debe tener al menos 3 caracteres.'
            ]
        ],
        'descripcion' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'El campo descripcion es obligatorio.',
                'min_length' => 'La descripcion debe tener al menos 3 caracteres.'
            ]
        ],
        'vencimiento' => [
            'rules' => 'required|valid_date',
            'errors' => [
                'required' => 'El campo fecha es obligatorio.',
                'valid_date' => 'Por favor ingresa una fecha válida.'
            ]
        ],
    ];


    public function mostrarTareaID($data){
        $query = $this->db->table($this->table);

        if (!empty($data['id'])) {
            $query->where('id', esc($data['id']));
        }

        return $query->get()->getResultArray();
    }

    public function seleccionarTarea($data)
    {
        $query = $this->db->table($this->table);

        if (!empty($data['id_usuario'])) {
            $query->where([
                'id_usuario' => esc($data['id_usuario']),
                'estado !=' => 'Completada',
                'estado_actualizado' => ''
            ]);
        }

        if (!empty($data['estado_actualizado_vacio']) && $data['estado_actualizado_vacio'] === true) {
            $query->where('estado_actualizado', '');
        }

        $query->where('fecha_vencimiento >=', date('Y-m-d'));

        return $query->get()->getResultArray();
    }

//controla id usuario o correo como colab
    public function obtenerTareas($id, $correo)
{
    return $this->groupStart()
                   ->where('id_usuario', $id)
                   ->orLike('colaborador', $correo) // Busca si el correo aparece en el string
                ->groupEnd()
                ->findAll();
}

    public function obtener_tarea($id)
    {
        return $this->db->table('tarea')
            ->select('id, tema, descripcion, fecha_creacion, fecha_vencimiento, estado, prioridad,archivo')
            ->where('id', $id)
            ->get()
            ->getRowArray(); // Para obtener un solo resultado en forma de array
    }


    public function obtenerNombreEstado($estadoId){
        $estados = [
            1 => 'Pendiente',
            2 => 'En progreso',
            3 => 'Completado',
            4 => 'Eliminado'
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