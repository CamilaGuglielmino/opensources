<?php

namespace App\Controllers;
use App\Models\TareaModel;
use App\Models\SubtareaModel;

class Subtareas extends BaseController{


   public function crear($tarea_id)
{
    $tareaModel = new TareaModel();
    $data['tarea'] = $tareaModel->find($tarea_id);

    // Verificar si la tarea existe antes de cargar el formulario
    if (!$data['tarea']) {
        return view('errors/html/error_404');
    }

    return view('header') .view('subtarea/subtarea', $data) . view('footer');

}

//CREAR SUBTAREA
  public function create(){
    $subtareaModel = new SubtareaModel();
     $reglas = [
           'descripcion' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo descripcion es obligatorio.',
                    'min_length' => 'La descripcion debe tener al menos 3 caracteres.'
               ]
            ],
            'comentario' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo comentario es obligatorio.',
                    'min_length' => 'La comentario debe tener al menos 3 caracteres.'
               ]
            ],
        ];

      if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

    $data = [
        'id' => mt_rand(1,100),
        'id_tarea' => $this->request->getPost('tarea_id'),
        'id_usuario' => $this->request->getPost('usuario'),
        'tema' => $this->request->getPost('tema'),
        'descripcion' => $this->request->getPost('descripcion'),
        'estado' => $this->request->getPost('estado'),
        'prioridad' => $this->request->getPost('prioridad'),
        'fecha_creacion' => date('Y-m-d'),
        'fecha_vencimiento' => $this->request->getPost('vencimiento'),
        'comentario' => $this->request->getPost('comentario'),
        'archivo' => '1',
    ];

    $subtareaModel->insert($data);

    return redirect()->to(base_url('tareas'))->with('mensaje', 'Subtarea creada.');
}

  // Mostrar formulario para compartir subtarea
public function formulario_compartir($id){
    $subtareaModel = new SubtareaModel();
    $subtarea = $subtareaModel->find($id);

    if (!$subtarea) {
        return redirect()->to(site_url('subtareas'))->with('error', 'Subtarea no encontrada');
    }

    return view('header')
         . view('subtarea/formulario', ['subtarea' => $subtarea])
         . view('footer');
}


 public function compartirYEnviar($id = null)
{
    $subtareaModel = new SubtareaModel();
    $subtarea = $subtareaModel->find($id);

    if (!$subtarea) {
        return redirect()->to(site_url('subtareas'))->with('error', 'Subtarea no encontrada');
    }

    $emailList = $this->request->getPost('correos');
    if (!$emailList) {
        return redirect()->back()->with('error', 'Debe ingresar uno o más correos');
    }

    // Convertir y normalizar listas de colaboradores
    $colaboradoresExistentes = array_filter(array_map('strtolower', array_map('trim', explode(',', $subtarea['colaborador'] ?? ''))));
    $colaboradoresNuevos = array_filter(array_map('strtolower', array_map('trim', explode(',', $emailList))));
    $todosLosColaboradores = array_unique(array_merge($colaboradoresExistentes, $colaboradoresNuevos));
    $colaboradoresFinal = implode(',', $todosLosColaboradores);
    var_dump($colaboradoresFinal);
    // Actualizar subtarea con los nuevos colaboradores
    $subtareaModel->update($id, ['colaborador' => $colaboradoresFinal]);

    // Formatear fechas
    $vencimiento = (new \DateTime($subtarea['fecha_vencimiento']))->format('d-m-Y');

    // Preparar envío de email
    $email = \Config\Services::email();
    $email->setFrom('openSource@gmail.com', 'Gestor de Tareas');
    $email->setTo($todosLosColaboradores);
    $email->setSubject("Invitación a colaborar en la subtarea: " . $subtarea['descripcion']);

    $mensaje = "
        <h3>📌 Información de la subtarea</h3>
        <ul>
            <li><strong>Descripción:</strong> {$subtarea['descripcion']}</li>
            <li><strong>Prioridad:</strong> {$subtarea['prioridad']}</li>
            <li><strong>Estado:</strong> {$subtarea['estado']}</li>
            <li><strong>Fecha de vencimiento:</strong> $vencimiento</li>
        </ul>
       
    ";

    $email->setMessage($mensaje);

    if ($email->send()) {
        return redirect()->to(site_url('tareas'))->with('success', '📧 Correo enviado con éxito a: ' . $colaboradoresFinal);
    } else {
        return redirect()->to(site_url('tareas'))->with('error', '❌ No se pudo enviar el correo.');
    }
}
//PANEL SUBTAREA
    public function detalle($id){
    $subtareaModel = new SubtareaModel(); 

    $data['subtarea'] = $subtareaModel->obtener_subtarea($id);

    // Validar si la tarea existe antes de seguir
    if (!$data['subtarea']) {
        return view('errors/html/error_404'); // Redirige si no encuentra la tarea
    }

    // Agregar el nombre del estado y la prioridad
    $data['subtarea']['nombre_estado'] = $subtareaModel->obtenerNombreEstado($data['subtarea']['estado']);
    $data['subtarea']['nombre_prioridad'] = $subtareaModel->obtenerNombrePrioridad($data['subtarea']['prioridad']);

    // Cargar la vista con las subtareas
    return view('header') . view('subtarea/detalles_subtarea', $data) . view('footer');
}

// COMPLETADA
    public function finalizar($id){
        $subtareaModel = new SubtareaModel(); 
        $subtarea = $subtareaModel->find($id);
        if (!$subtarea) {
            return $this->response->setJSON(['error' => 'SubTarea no encontrada'])->setStatusCode(404);
        }

        // Actualiza el estado de la tarea
        $model->update($id, ['estado' => 3]); 

        return $this->response->setJSON(['mensaje' => 'SubTarea finalizada correctamente'])->setStatusCode(200);
    }

//ELIMINAR 
    public function eliminar($id)
    {
        $model = new SubtareaModel();

        if (!$model->find($id)) {
            return $this->response->setJSON(['error' => 'SubTarea no encontrada'])->setStatusCode(404);
        }

        // Elimina
        $model->update($id, [
           'archivo'=> '2',
       ]);
        return redirect()->to(base_url('/'));
    }
    public function editar($id)
    {
        $model = new SubtareaModel();
        $data['subtarea'] = $model->obtener_subtarea($id);

        if (!$data['subtarea']) {
            return view('errors/html/error_404');
        }

        return view('header') . view('subtarea/editar', $data) . view('footer');
    }
    
    public function guardar() {
    $subtareaModel = new SubtareaModel();

    $data = [
        'descripcion' => $this->request->getPost('descripcion'),
        'estado' => $this->request->getPost('estado'),
        'prioridad' => $this->request->getPost('prioridad'),
        'vencimiento' => $this->request->getPost('vencimiento'),
        'comentario' => $this->request->getPost('comentario'),
        'usuario' => $this->request->getPost('usuario'),
        'tarea_id' => $this->request->getPost('tarea_id')
    ];

    $id = $this->request->getPost('id');

    if ($id) {
        // Actualizar subtarea existente
        $subtareaModel->update($id, $data);
    } else {
        // Opcional: crear nueva subtarea si no viene id (depende de tu lógica)
        $id = $subtareaModel->insert($data);
    }

    // Redirigir a detalles de la tarea principal (o donde prefieras)
    return redirect()->to(base_url('tareas'));
}



}