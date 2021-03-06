<?php namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
class MeetingModel extends Model
{
    protected $table      = 'meeting';
    protected $primaryKey = 'id_meeting';
    protected $useTimestamps = true;
    protected $createdField  = 'created_meeting';
    protected $updatedField  = 'updated_meeting';
    protected $allowedFields = ['id_meeting','id_project','creator_meeting','agenda','deskripsi','link_meeting','time_meeting'];
    public function getMeetingbyProject($id_project = false)
    {
        if($id_project == false)
        {return $this->join('user','user.id_user=meeting.creator_meeting')
                ->join('project','project.id_project=meeting.id_project')->orderBy('time_meeting', 'ASC')->findAll();}
        else {return $this->join('user','user.id_user=meeting.creator_meeting')
                ->join('project','project.id_project=meeting.id_project')->where('meeting.id_project',$id_project)->orderBy('time_meeting', 'ASC')->get()->getResultArray();}
    }
    public function getMeetingbyId($id_meeting = false)
    {
        if($id_meeting == false)
        {return $this->join('user','user.id_user=meeting.creator_meeting')
                ->join('project','project.id_project=meeting.id_project')->orderBy('time_meeting', 'ASC')->findAll();}
        else {return $this->join('user','user.id_user=meeting.creator_meeting')
                ->join('project','project.id_project=meeting.id_project')->where('meeting.id_meeting',$id_meeting)->first();}
    }

}