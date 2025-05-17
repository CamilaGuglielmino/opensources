<?php

namespace App\Controllers;
use App\Models\SubtareaModel;
use App\Models\ColabModel;
use App\Models\TareaModel;

class Tareas extends BaseController
{

    public function index() {
    $usuario_id = session()->get('usuario')['id'];
    $usuario_correo = session()->get('usuario')['email'];

    $tareaModel = new TareaModel();
    $subtareaModel = new SubtareaModel();

    // Obtener tareas y subtareas del usuario
    $tareas = $tareaModel->obtenerTareas($usuario_id , $usuario_correo);
    $subtareas = $subtareaModel->obtenerSubtarea($usuario_id , $usuario_correo);

    if (empty($tareas)) {
        // No hay tareas, mostrar solo subtareas
        $data = [
            'subtareas' => $subtareas
        ];
        return view('header') . view('panel_subtareas', $data) . view('footer');
    } else {
        // Hay tareas, asociar subtareas a cada una
        foreach ($tareas as &$tarea) {
            $tarea['subtareas'] = $subtareaModel->where('id_tarea', $tarea['id'])->findAll();
        }

        $data = [
            'tareas' => $tareas
        ];
        return view('header') . view('panel', $data) . view('footer');
    }
}


//FORMULARIO CREAR
    public function formulario(){
        $usuario_id = session()->get('usuario')['id'];

        return view('header') . view('tareas/crear') . view('footer');
    }

   public function create(){
    $tareaModel = new TareaModel();
     $reglas = [
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
            'fecha_vencimiento' => [
                'rules' => 'required|valid_date|fechaNoPasada',
                'errors' => [
                    'required' => 'El campo fecha es obligatorio.',
                    'valid_date' => 'Por favor ingresa una fecha válida.',
                    'fechaNoPasada' => 'La fecha de vencimiento no puede ser anterior a hoy.'
                ]
            ],
            'fecha_recordatorio' => [
                'rules' => 'permit_empty|valid_date|validarRecordatorioVsVencimiento[vencimiento]',
                 'errors' => [
                    'valid_date' => 'Por favor ingresa una fecha válida.',
                    'validarRecordatorioVsVencimiento' => 'La fecha de recordatorio no puede ser posterior al vencimiento.'
                ]
           ],
        ];

      if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

    $data = [
        'id' => mt_rand(1,100),
        'id_usuario' => $this->request->getPost('usuario'),
        'tema' => $this->request->getPost('tema'),
        'descripcion' => $this->request->getPost('descripcion'),
        'prioridad' => $this->request->getPost('prioridad'),
        'estado' => $this->request->getPost('estado'),
        'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
        'fecha_recordatorio' => $this->request->getPost('fecha_recordatorio'),
        'fecha_creacion' => date('Y-m-d'),
        'archivo' => '1',
    ];

    $tareaModel->insert($data);

    return redirect()->to(base_url('tareas'))->with('mensaje', 'Tarea creada.');
}


public function detalles($id)
{
    $tareaModel = new TareaModel();
    $subtareaModel = new SubtareaModel();

    // Obtener tarea
    $tarea = $tareaModel->find($id);

    // Obtener subtareas asociadas a esta tarea
    $subtareas = $subtareaModel->where('tarea_id', $id)->findAll();

    // Pasar datos a la vista
    return view('tareas/detalles', [
        'tarea' => $tarea,
        'subtareas' => $subtareas
    ]);
}


public function detalle($id)
{
    $tareaModel = new TareaModel();
    $subtareaModel = new SubtareaModel();

    $data['tarea'] = $tareaModel->obtener_tarea($id);

    // Validar si la tarea existe antes de seguir
    if (!$data['tarea']) {
        return view('errors/html/error_404'); // Redirige si no encuentra la tarea
    }

    // Agregar el nombre del estado y la prioridad de la tarea
    $data['tarea']['nombre_estado'] = $tareaModel->obtenerNombreEstado($data['tarea']['estado']);
    $data['tarea']['nombre_prioridad'] = $tareaModel->obtenerNombrePrioridad($data['tarea']['prioridad']);

    // Obtener las subtareas asociadas (una sola vez)
    $subtareas = $subtareaModel->where('id_tarea', $id)->findAll();

    // Si hay subtareas, agregarles nombre_estado y nombre_prioridad individualmente
    if (!empty($subtareas)) {
        foreach ($subtareas as &$subtarea) {
            $subtarea['nombre_estado'] = $subtareaModel->obtenerNombreEstado($subtarea['estado']);
            $subtarea['nombre_prioridad'] = $subtareaModel->obtenerNombrePrioridad($subtarea['prioridad']);
        }
    }

    // Asignar subtareas (puede ser arreglo vacío)
    $data['subtareas'] = $subtareas;

    // Cargar la vista con las subtareas
    return view('header') . view('tareas/detalles', $data) . view('footer');
}


public function guardar(){
        $tareaModel = new TareaModel();

        $data = [
            'tema' => $this->request->getPost('tema'),
            'descripcion' => $this->request->getPost('descripcion'),
            'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
            'estado' => $this->request->getPost('estado'),
            'prioridad' => $this->request->getPost('prioridad')
        ];

        // Validar si es una edición o nueva tarea
        $id = $this->request->getPost('id');
        if ($id) {
            $tareaModel->update($id, $data);
        }

     return redirect()->to(base_url('detalles/' . $id));
 }

//TAREA COMPLETADA
   public function finalizar($id){
    $model = new TareaModel();
    $tarea = $model->find($id);
    if (!$tarea) {
        return $this->response->setJSON(['error' => 'Tarea no encontrada'])->setStatusCode(404);
    }

    // Actualiza el estado y el archivo con el modelo, NO con el objeto $tarea
    $model->update($id, ['estado' => 3, 'archivo' => 3]);

    return redirect()->to(base_url('detalles/' . $id));

}
 

//ELIMINAR TAREA
    public function eliminar($id)
    {
        $model = new TareaModel();

        // Verifica que la tarea existe
        if (!$model->find($id)) {
            return $this->response->setJSON(['error' => 'Tarea no encontrada'])->setStatusCode(404);
        }

        // Elimina la tarea
        $model->update($id, ['estado' => 4, 'archivo' => 3]);
        return redirect()->to(base_url('/'));


    
    }
    public function editar($id)
    {
        $tareaModel = new TareaModel();
        $data['tarea'] = $tareaModel->obtener_tarea($id);

        if (!$data['tarea']) {
            return view('errors/html/error_404');
        }

        return view('header') . view('tareas/editar', $data) . view('footer');
    }
    

//HISTORIAL
    public function historial() {

        $usuario_id = session()->get('usuario')['id'];
         $usuario_correo = session()->get('usuario')['email'];

        $tareaModel = new TareaModel();
        $subtareaModel = new SubtareaModel();

        // Obtener todas las tareas del usuario
          $tareas = $tareaModel->obtenerTareas($usuario_id , $usuario_correo);

        // Asociar subtareas a cada tarea
        foreach ($tareas as &$tarea) {
            $tarea['subtareas'] = $subtareaModel->where('id_tarea', $tarea['id'])->findAll();
        }

        // Pasar los datos correctamente a la vista
        $data['tareas'] = $tareas;

        return view('header') . view('historial', $data) . view('footer');
    }

  public function detalle_historial($id){
    $tareaModel = new TareaModel();
    $subtareaModel = new SubtareaModel(); 

    $data['tarea'] = $tareaModel->obtener_tarea($id);

    // Validar si la tarea existe antes de seguir
    if (!$data['tarea']) {
        return view('errors/html/error_404'); // Redirige si no encuentra la tarea
    }

    // Agregar el nombre del estado y la prioridad
    $data['tarea']['nombre_estado'] = $tareaModel->obtenerNombreEstado($data['tarea']['estado']);
    $data['tarea']['nombre_prioridad'] = $tareaModel->obtenerNombrePrioridad($data['tarea']['prioridad']);

    // Obtener las subtareas asociadas
    $data['subtareas'] = $subtareaModel->where('id_tarea', $id)->findAll();

    // Cargar la vista con las subtareas
    return view('header') . view('tareas/detalles_historial', $data) . view('footer');
}

 // Mostrar formulario para compartir tarea
    public function formulario_compartir($id){
        $tareaModel = new TareaModel();
        $tarea = $tareaModel->find($id);

        if (!$tarea) {
            return redirect()->to(site_url('tareas'))->with('error', 'Tarea no encontrada');
        }

        return view('header')
             . view('tareas/formulario', ['tarea' => $tarea])
             . view('footer');
    }

   
public function compartirYEnviar($id = null)
{
    $tareaModel = new TareaModel();
    $tarea = $tareaModel->find($id);
    $colabModel = new ColabModel(); 

$data = [
    'id_colab'=> mt_rand(1, 1000),
    'id_usuario'    =>   session()->get('usuario')['id'],
    'email_colab'   => $this->request->getPost('correos'),
    'id_tarea'      => $id
];

$colabModel->insert($data);


    if (!$tarea) {
        return redirect()->to(site_url('tareas'))->with('error', 'Tarea no encontrada');
    }

    $emailList = $this->request->getPost('correos');
    if (!$emailList) {
        return redirect()->back()->with('error', 'Debe ingresar uno o más correos');
    }



    // Convertir y normalizar listas de colaboradores (existentes + nuevos)
    $colaboradoresExistentes = array_filter(array_map('strtolower', array_map('trim', explode(',', $tarea['colaborador'] ?? ''))));
    $colaboradoresNuevos = array_filter(array_map('strtolower', array_map('trim', explode(',', $emailList))));
    $todosLosColaboradores = array_unique(array_merge($colaboradoresExistentes, $colaboradoresNuevos));
    $colaboradoresFinal = implode(',', $todosLosColaboradores);

    // Actualizar colaboradores en BD
    $tareaModel->update($id, ['colaborador' => $colaboradoresFinal]);

    // Formatear fechas para mostrar en el mail
    $vencimiento = (new \DateTime($tarea['fecha_vencimiento']))->format('d-m-Y');
    $recordatorio = (new \DateTime($tarea['fecha_recordatorio']))->format('d-m-Y');

    // Preparar email
    $email = \Config\Services::email();
    $email->setFrom('openSource@gmail.com', 'Gestor de Tareas');
    $email->setTo($todosLosColaboradores);
    $email->setSubject("Invitación a colaborar en la tarea: " . $tarea['tema']);

    $mensaje = "
        <h3>📌 Información de la tarea</h3>
        <ul>
            <li><strong>Tema:</strong> {$tarea['tema']}</li>
            <li><strong>Descripción:</strong> {$tarea['descripcion']}</li>
            <li><strong>Prioridad:</strong> {$tarea['prioridad']}</li>
            <li><strong>Estado:</strong> {$tarea['estado']}</li>
            <li><strong>Fecha de vencimiento:</strong> $vencimiento</li>
            <li><strong>Recordatorio:</strong> $recordatorio</li>
        </ul>
        <p><strong>Haz clic aquí para ver y gestionar la tarea: </strong><a href='" . site_url("http://localhost/opensources/public/") . "'>Acceder a la tarea</a></p>
    ";

    $email->setMessage($mensaje);

    if ($email->send()) {
        return redirect()->to(site_url('tareas'))->with('success', '📧 Correo enviado con éxito a: ' . $colaboradoresFinal);
    } else {
        // Para debugging (quitar en producción)
        // $debug = $email->printDebugger();
        return redirect()->to(site_url('tareas'))->with('error', '❌ No se pudo enviar el correo.');
    }
}
public function colaborador()
{
    $usuario_correo = session()->get('usuario')['email'];
    $model = new ColabModel();
    $tareas = $model->obtenerTareasPorColaborador($usuario_correo);
    return view('header') . view('tareas/colaboraciones', ['tareas' => $tareas, 'usuario_correo' => $usuario_correo]) . view('footer');
}

}