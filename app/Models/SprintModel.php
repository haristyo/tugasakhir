<?php namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
class SprintModel extends Model
{
    protected $table         = 'sprint';
    protected $primaryKey    = 'id_sprint';
    protected $useTimestamps = true;
    protected $createdField  = 'created_sprint';
    protected $updatedField  = 'updated_sprint';
    protected $allowedFields = ['id_sprint','id_project','start_sprint','end_sprint','goal'];
    public function getSprintbyProject($id_project = false)
    {
        if($id_project == false)
        {return $this->join('project','project.id_project=sprint.id_project')->orderBy('start_sprint', 'DESC')
            ->findAll(); 
        }
        else {
            
            return $this->join('project','project.id_project=sprint.id_project')->where('sprint.id_project',$id_project)->orderBy('start_sprint', 'DESC')
            ->findAll();
        }
    }
    public function getSprintbyId($id_sprint)
    {
        return $this->join('project','project.id_project=sprint.id_project')->where('sprint.id_sprint',$id_sprint)->first();
    }
    
    public function getLastSprintbyProject($id_project)
    {
        return $this->join('project','project.id_project=sprint.id_project')->where('sprint.id_project',$id_project)->orderBy('start_sprint', 'DESC')->first();
    }

    

}