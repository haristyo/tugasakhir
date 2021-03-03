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
    public function getProyekAll()
    {
        return $this->findAll();
    }

}