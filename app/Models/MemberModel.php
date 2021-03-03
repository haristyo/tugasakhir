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
    protected $allowedFields = ['id_member','id_project','id_user','position'];
    public function getProjectbyUser($id_user)
    {
        return $this->join('user','user.id_user=member.id_user')
               ->join('project','project.id_project=member.id_project')->where('member.id_user',$id_user)->get()->getResultArray();
    }

}