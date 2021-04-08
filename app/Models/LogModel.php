<?php namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
class LogModel extends Model
{
    protected $table         = 'log';
    protected $primaryKey    = 'id_log';
    protected $useTimestamps = true;
    protected $createdField  = 'created_log';
    protected $updatedField  = '';
    protected $allowedFields = ['id_log','id_epic','progress','id_member'];
    
    public function getLogbyProject($id_project)
    {
     return $this->select("epic.id_sprint, DATE_FORMAT(created_log,'%Y-%m-%d') as tanggal, sum(progress)")->join('epic','epic.id_epic=log.id_epic')->join('sprint','sprint.id_sprint=epic.id_sprint')->join('project','project.id_project=sprint.id_project')->groupBy(['epic.id_sprint','tanggal'])->where('sprint.id_project',$id_project)->findAll();
    }
    
    

}