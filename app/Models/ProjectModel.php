<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
class ProjectModel extends Model
{
    protected $table      = 'project';
    protected $primaryKey = 'id_project';
    protected $useTimestamps = true;
    protected $createdField  = 'created_project';
    protected $updatedField  = 'updated_project';
    protected $allowedFields = ['id_project','nama_project','deskripsi','creator_project','kode_join','password_project'];
    public function getProject($id_project = FALSE)
    {
        if ($id_project == false){
            return $this->findAll();
       }
       else {
           return $this->Where(['id_project' => $id_project])->first();
       }
    }
    public function getProjectCreator($id_project = FALSE)
    {
        if ($id_project == false){
            return $this->join('user','user.id_user=project.creator_project')->findAll();
       }
       else {
           return $this->join('user','user.id_user=project.creator_project')->Where(['id_project' => $id_project])->first();
       }
    }
    public function getProjectbyKode($kode_join)
    {
       return $this->where('kode_join', $kode_join)->first();
    }
 

}