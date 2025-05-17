<?php
namespace App\Models;
use CodeIgniter\Model;

class ColabModel extends Model
{
   protected $table = 'colaboradores';
   protected $primaryKey = 'id_colab';
   protected $useAutoIncrement = false;
   protected $returnType = 'array';
   protected $useSoftDeletes = false;
   protected $allowedFields = ['id_usuario', 'email_colab', 'id_tarea'];
 
  

   public function ObtenerColab($data)
   {
      $Usuario = $this->db->table('colaboradores');
      $Usuario->where($data);
      return $Usuario->get()->getResultArray();
   }

public function obtenerTareasPorColaborador($email)
{
    return $this->db->table('tarea')
        ->select('tarea.*, colaboradores.id_usuario, colaboradores.email_colab')
        ->join('colaboradores', 'colaboradores.id_tarea = tarea.id')
        ->where('colaboradores.email_colab', $email)
        ->get()
        ->getResultArray();
}


}
?>