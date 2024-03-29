<?php namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
class MemberModel extends Model
{
    protected $table      = 'member';
    protected $primaryKey = 'id_member';
    protected $useTimestamps = true;
    protected $createdField  = 'created_member';
    protected $updatedField  = 'updated_member';
    protected $allowedFields = ['id_project','id_user','position','left_at'];
    public function getMemberbyUser($id_user = false)
    {
        if($id_user == false)
        {return $this->join('user','user.id_user=member.id_user')
               ->join('project','project.id_project=member.id_project')->findAll();}
        else {return $this->join('user','user.id_user=member.id_user')
               ->join('project','project.id_project=member.id_project')->where(['member.id_user'=>$id_user,'member.left_at'=>null])->get()->getResultArray();}
    }
    public function getCountMemberbyUserProject($id_user = false, $id_project = false)
    {
        if($id_user == false)
        { return $this->selectCount('member.id_member')->findAll();
        } else 
        { return $this->selectCount('member.id_member')->where(['member.id_user' => $id_user, "member.id_project" => $id_project,'member.left_at'=>null])->first();
        }
    }
    public function getMemberbyProject($id_project = false)
    {
        if($id_project == false)
        {return $this->join('user','user.id_user=member.id_user')
                ->join('project','project.id_project=member.id_project')->where(['member.left_at'=>null])->findAll();}
        else {return $this->join('user','user.id_user=member.id_user')
                ->join('project','project.id_project=member.id_project')->where(['member.id_project'=>$id_project,'member.left_at'=>null])->orderBy('position', 'DESC')->get()->getResultArray();}
    }
    public function getMemberAllbyProject($id_project = false)
    {
        if($id_project == false)
        {return $this->join('user','user.id_user=member.id_user')
                ->join('project','project.id_project=member.id_project')->findAll();}
        else { return $this->join('user','user.id_user=member.id_user')
                ->join('project','project.id_project=member.id_project')->where(['member.id_project' => $id_project])->orderBy('position', 'DESC')->findAll();}
    }
    public function getMemberDetailbyProject($id_project = false)
    {
        if($id_project == false)
        {return $this->select('member.id_member,member.id_user,user.nama_user as nama anggota,member.position,member.created_member as tanggal gabung,member.id_project,project.nama_project,project.creator_project,members.nama_user as nama_creator,project.created_project as tanggal pembuatan')->join('user','user.id_user=member.id_user')
                ->join('project','project.id_project=member.id_project')->join('user as members','project.creator_project=members.id_user')->findAll();}
        else {return $this->select('member.id_member,member.id_user,user.nama_user as nama anggota,member.position,member.created_member as tanggal gabung,member.id_project,project.nama_project,project.creator_project,members.nama_user as nama_creator,member.created_member,project.created_project as tanggal pembuatan')->join('user','user.id_user=member.id_user')
                ->join('project','project.id_project=member.id_project')->join('user as members','members.id_user=project.creator_project')->where(['member.id_project'=>$id_project,'member.left_at'=>null])->get()->getResultArray();}
    }
    public function getIdbyUserProject($id_user,$id_project)
    {
        return $this->select('id_member')->where(['id_user' => $id_user, "id_project" => $id_project,'member.left_at'=>null])->first();
    }
    public function getMemberDetailbyUserProject($id_user = false, $id_project = false)
    {
        if($id_user == false)
        { return $this->join('user','user.id_user=member.id_user')
            ->join('project','project.id_project=member.id_project')->findAll();
        } else 
        { return $this->join('user','user.id_user=member.id_user')
            ->join('project','project.id_project=member.id_project')->where(['member.id_user' => $id_user, "member.id_project" => $id_project,'member.left_at'=>null])->first();
        }
    }
    public function getCountMemberbyPosition($id_project = false,$type)
    { $position = ['Product Owner'];
        if ($type == "all") {
            return $this->selectCount('member.id_member')->where(["member.id_project" => $id_project,'member.left_at'=>null])->first();
        }
        else 
        {
            return $this->selectCount('member.id_member')->where(['member.id_project'=> $id_project,'member.left_at'=>null])->whereNotIn('member.position', $position)->first();
        }
    }
    public function isHaveScrumMaster($id_project)
    {
        return $this->where(['position'=>'Scrum Master', 'id_project'=>$id_project])->first();
    }

    

}