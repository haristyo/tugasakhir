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
    protected $allowedFields = ['id_meeting','id_project','creator_meeting','agenda','deskripsi_meeting','link_meeting','time_meeting'];
    public function getMeetingbyProject($id_project = false, $type = false)
    {
        $agenda = ['Daily Scrum','Sprint Retrospective'];
        if($id_project == false && $type == false )
        {return $this->join('member','member.id_member=meeting.creator_meeting')
                ->join('project','project.id_project=meeting.id_project')->orderBy('time_meeting', 'ASC')->findAll();
        }
        else {
                if ($type == false) {
                        # code...
                        return $this->join('member','member.id_member=meeting.creator_meeting')
                        ->join('project','project.id_project=meeting.id_project')->where('meeting.id_project',$id_project)->orderBy('time_meeting', 'ASC')->get()->getResultArray();
                }
                else {
                        return $this->join('member','member.id_member=meeting.creator_meeting')
                        ->join('project','project.id_project=meeting.id_project')->where('meeting.id_project',$id_project)->whereNotIn('meeting.agenda',$agenda)->orderBy('time_meeting', 'ASC')->get()->getResultArray();
                }
        }

    }
    public function getMeetingbyId($id_meeting = false)
    {
        if($id_meeting == false)
        {return $this->join('member','member.id_member=meeting.creator_meeting')
                ->join('project','project.id_project=meeting.id_project')->orderBy('time_meeting', 'ASC')->findAll();}
        else {return $this->join('member','member.id_member=meeting.creator_meeting')
                ->join('project','project.id_project=meeting.id_project')->where('meeting.id_meeting',$id_meeting)->first();}
    }
    public function getCountMeetingbyAgenda($id_project = false,$type)
    { $agenda = ['Daily Scrum','Sprint Retrospective'];
        if ($type == "all") {
            return $this->selectCount('meeting.id_meeting')->where("meeting.id_project", $id_project)->first();
        }
        else 
        {
            return $this->selectCount('meeting.id_meeting')->where('meeting.id_project', $id_project)->whereNotIn('meeting.agenda', $agenda)->first();
        }
    }

    

}