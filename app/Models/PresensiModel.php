<?php namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
class PresensiModel extends Model
{
    protected $table      = 'presensi';
    protected $primaryKey = 'id_presensi';
    protected $useTimestamps = true;
    protected $createdField  = 'join_time';
    protected $updatedField  = 'last_join_time';
    protected $allowedFields = ['id_presensi','id_member','id_meeting'];
    public function getCountPresensibyUserMeeting($id_user,$id_meeting)
    {
        return $this->selectCount('id_presensi')->join('member','member.id_member=presensi.id_member')->where(['member.id_user' => $id_user, 'id_meeting' => $id_meeting])->first();  
    }
    public function getIdbyUserMeeting($id_user,$id_meeting)
    {
        return $this->select('id_presensi')->join('member','member.id_member=presensi.id_member')->where(['member.id_user' => $id_user, 'id_meeting' => $id_meeting])->first();  
    }
    
    public function getCountUserbyProject($id_project)
    {
       return $this->select('presensi.id_meeting, id_project, count(id_presensi) as banyaknya')
       ->join('meeting','meeting.id_meeting=presensi.id_meeting')->groupBy('presensi.id_meeting')->where('meeting.id_project',$id_project)->findAll();
    }
    public function getCountPresensiMemberbyProject($id_project)
    {
        return $this->select('presensi.id_member,user.username,count(id_presensi) as banyaknya,position')
        ->join('meeting','meeting.id_meeting=presensi.id_meeting')
        ->join('member','member.id_member=presensi.id_member')->join('user','user.id_user=member.id_user')->where('meeting.id_project',$id_project)->groupBy('presensi.id_member')->findAll();
    }
    public function getPresensibyProject($id_project)
    {
        $notnull = "! null";
        //,'member.left_at'=>$notnull]
        return $this->select('id_presensi,meeting.id_project,presensi.id_meeting,member.id_user')->join('meeting','meeting.id_meeting=presensi.id_meeting')
        ->join('member','member.id_member=presensi.id_member')->where(['meeting.id_project'=>$id_project])->findAll();
    }

}