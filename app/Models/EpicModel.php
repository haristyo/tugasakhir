<?php namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
class EpicModel extends Model
{
    protected $table         = 'epic';
    protected $primaryKey    = 'id_epic';
    protected $useTimestamps = true;
    protected $createdField  = 'created_epic';
    protected $updatedField  = 'updated_epic';
    protected $allowedFields = ['id_epic','id_sprint','isi','status','estimated','elapsed','creator_epic','editor_epic'];
    public function getEpicbyProject($id_project = false)
    {
        if($id_project == false)
        {return $this->join('sprint','sprint.id_sprint=epic.id_sprint')->join('project','project.id_project=sprint.id_project')->orderBy('updated_epic', 'DESC')
            ->findAll(); 
        }
        else {
            
            // return $this->join('sprint','sprint.id_sprint=epic.id_sprint')->join('project','project.id_project=sprint.id_project')
            return $this->select('epic.*, sprint.*, project.*, creator.id_user AS pembuat, editor.id_user AS pengedit, user_creator.nama_user AS nama_pembuat, user_editor.nama_user AS nama_pengedit')
            ->join('sprint','sprint.id_sprint=epic.id_sprint')
            ->join('project','project.id_project=sprint.id_project')
            ->join("member creator" ,'creator.id_member=epic.creator_epic','left')
            ->join("member editor",'editor.id_member=epic.editor_epic','left')
            ->join('user user_creator','user_creator.id_user=creator.id_user','left')
            ->join('user user_editor','user_editor.id_user=editor.id_user','left')
            ->where('sprint.id_project',$id_project)->orderBy('updated_epic', 'DESC')
            ->findAll();
        }
    }
    public function getEpicbyId($id_epic)
    {
        return $this->join('sprint','sprint.id_sprint=epic.id_sprint')->join('project','project.id_project=sprint.id_project')->where('epic.id_epic',$id_epic)->first();
    }
    public function getCount($id_project)
    {
        return $this->select('epic.id_sprint,epic.status')->selectSum('estimated')->selectSum('elapsed')->join('sprint','sprint.id_sprint=epic.id_sprint')->join('project','project.id_project=sprint.id_project')->groupBy(['epic.id_sprint','epic.status'])->where('sprint.id_project',$id_project)->findAll();
    }
    public function getCountDo($id_project)
    {
        return $this->select("epic.id_sprint,sprint.start_sprint , DATE_FORMAT(sprint.start_sprint,'%Y-%m-%d') as tanggal_mulai")->selectSum('estimated')->join('sprint','sprint.id_sprint=epic.id_sprint')->join('project','project.id_project=sprint.id_project')->groupBy(['epic.id_sprint'])->where('sprint.id_project',$id_project)->whereIn('epic.status',['TO DO','ON PROGRESS','VERIFY','DONE'])->findAll();
    }

    public function countEpicbyUserProject()
    {
        return $this->select('user.id_user,epic.creator_epic,sprint.id_project')->selectCount('epic.id_epic')
        ->join('member','member.id_member=epic.creator_epic')->join('user','user.id_user=member.id_user')
        ->join('sprint','sprint.id_sprint=epic.id_sprint')
        ->groupBy('epic.creator_epic','sprint.id_project,')->findAll();
    }
    

}