<?php
namespace App\Models;
use CodeIgniter\Model;

class UsuarioModel extends Model
{
   protected $table = 'usuario';
   protected $primaryKey = 'id';
   protected $useAutoIncrement = false;
   protected $returnType = 'array';
   protected $useSoftDeletes = false;
   protected $allowedFields = ['nombre', 'apellido', 'email', 'contra', 'fecha_creacion'];
   public $reglas = [
      'nombre' => [
         'rules' => 'required|min_length[3]',
         'errors' => [
            'required' => 'El campo nombre es obligatorio.',
            'min_length' => 'El nombre debe tener al menos 3 caracteres.'
         ]
      ],
      'apellido' => [
         'rules' => 'required|min_length[3]',
         'errors' => [
            'required' => 'El campo apellido es obligatorio.',
            'min_length' => 'El apellido debe tener al menos 3 caracteres.'
         ]
      ],
      'email' => [
         'rules' => 'required|valid_email|is_unique[usuario.email]',
         'errors' => [
            'required' => 'El campo email es obligatorio.',
            'valid_email' => 'Debes proporcionar un correo electrónico válido.',
            'is_unique' => 'Este correo electrónico ya está registrado.'
         ]
      ],
      'contra' => [
         'rules' => 'required|min_length[7]',
         'errors' => [
            'required' => 'La contraseña es obligatoria.',
            'min_length' => 'La contraseña debe tener al menos 7 caracteres.'
         ]
      ]
   ];
  

   public function obtenerUsuario($data)
   {
      $Usuario = $this->db->table('usuario');
      $Usuario->where($data);
      return $Usuario->get()->getResultArray();
   }
}
?>