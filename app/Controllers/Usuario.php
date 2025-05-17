<?php

namespace App\Controllers;

use App\Models\SubtareaModel;
use App\Models\TareaModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use App\Models\IngresoModel;
use App\Models\RegistroUsuarioModel;
use App\Models\RegistroTareaModel;
use App\Models\RegistroSubtareaModel;

class Usuario extends BaseController
{

    public function index()
    {
        return view('header') . view('inicio') . view('footer');
    }
    public function ingreso()
    {
        return view('header') . view('usuario/login') . view('footer');
    }
    public function registro()
    {
        return view('header') . view('usuario/registro') . view('footer');
    }
    public function create()
    {
        $usuarioModel = new UsuarioModel();
        $reglas = $usuarioModel->reglas;

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        $usuarioModel->save([
            'id' => mt_rand(1, 1000),
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'email' => $this->request->getPost('email'),
            'contra' => password_hash($this->request->getPost('contra'), PASSWORD_DEFAULT)
        ]);


        return redirect()->to(base_url('/'))->with('mensaje', 'Usuario registrado exitosamente.');
    }
    public function login()
    {
        $email = $this->request->getPost('email');
        $contra = $this->request->getPost('contra');

        $UsuarioModel = new UsuarioModel();
        $data = $UsuarioModel->obtenerUsuario([
            'email' => $email,
            'contra' => $contra
        ]);

        if (!empty($data) && is_array($data)) {
            // Iniciar sesión
            $session = session();
            $session->set([
                'usuario' => $data[0], // Guarda todo el array del usuario
                'logueado' => true
            ]);

            if (!session()->has('usuario')) {
                return redirect()->to('/login');
            }

            // Instancias de los modelos
            $tareaModel = new TareaModel();
            $subtareaModel = new SubtareaModel();

            // Obtener el ID del usuario desde la sesión correctamente
            $usuario_id = session()->get('usuario')['id'];

            // Obtener las tareas y subtareas
            $tareas = $tareaModel->where('id_usuario', $usuario_id)->findAll();
            $subtareas = $subtareaModel->where('id_usuario', $usuario_id)->findAll();

            // Guardar tareas y subtareas en la sesión
            $session->set([
                'tareas' => !empty($tareas) ? $tareas : [],
                'subtareas' => !empty($subtareas) ? $subtareas : []
            ]);



            return redirect()->to(base_url('/'))->with('mensaje', '¡Bienvenido!');

        } else {
            return redirect()->to(base_url('login'))->with('mensajeError', 'Datos incorrectos. Ingrese nuevamente.');
        }
    }
    public function salir()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }




}