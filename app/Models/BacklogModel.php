<?php namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
class BacklogModel extends Model
{
    protected $table         = 'backlog';
    protected $primaryKey    = 'id_backlog';
    protected $useTimestamps = true;
    protected $createdField  = 'created_backlog';
    protected $updatedField  = 'updated_backlog';
    protected $allowedFields = ['id_backlog','id_project','isi','sprint','point'];
    public function getBacklogbyProject($id_project = false)
    {
        if($id_project == false)
        {return $this->join('project','project.id_project=backlog.id_project')->orderBy('point', 'DESC')
            ->findAll(); 
        }
        else {
            
            return $this->join('project','project.id_project=backlog.id_project')->where('backlog.id_project',$id_project)->orderBy('point', 'DESC')
            ->findAll();
        }
    }
    public function getBacklogbyId($id_backlog = false)
    {
        if($id_backlog == false)
        {return $this->join('project','project.id_project=backlog.id_project')->orderBy('point', 'DESC')
            ->findAll(); 
        }
        else {
            
            return $this->join('project','project.id_project=backlog.id_project')->where('backlog.id_backlog',$id_backlog)->first();
        }
    }

    

}