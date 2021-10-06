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
    protected $allowedFields = ['id_backlog','id_project','isi','sprint','point','creator_backlog'];
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
    public function getCount($id_project)
    {
        return $this->select('backlog.sprint')->selectSum('point')->join('project','project.id_project=backlog.id_project')->groupBy('backlog.sprint')->where('backlog.id_project',$id_project)->findAll();
    }
    public function countBacklogbyUserProject()
    {
        return $this->select('user.id_user,backlog.creator_backlog,backlog.id_project')->selectCount('backlog.id_backlog')
        ->join('member','member.id_member=backlog.creator_backlog')->join('user','user.id_user=member.id_user')
        ->groupBy('backlog.creator_backlog','backlog.id_project,')->findAll();
    }

    

}