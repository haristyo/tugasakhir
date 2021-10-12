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
    protected $allowedFields = ['id_backlog','id_project','isi','sprint','point','creator_backlog','editor_backlog'];
    public function getBacklogbyProject($id_project = false)
    {
        if($id_project == false)
        {return $this->join('project','project.id_project=backlog.id_project')->orderBy('point', 'DESC')
            ->findAll(); 
        }
        else {
            
            return $this->select('backlog.*, project.*, creator.id_user AS pembuat, editor.id_user AS pengedit, user_creator.nama_user AS nama_pembuat, user_editor.nama_user AS nama_pengedit')
            ->join('project','project.id_project=backlog.id_project')
            ->join("member creator" ,'creator.id_member=backlog.creator_backlog')
            ->join("member editor",'editor.id_member=backlog.editor_backlog','left')
            ->join('user user_creator','user_creator.id_user=creator.id_user')
            ->join('user user_editor','user_editor.id_user=editor.id_user','left')
            ->where('backlog.id_project',$id_project)->orderBy('point', 'DESC')
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