<?php

namespace App\Controllers;
use App\Models\ProjectModel;
use App\Models\MemberModel;
use App\Models\MeetingModel;
use App\Models\PresensiModel;
use App\Models\UserModel;
class Admin extends BaseController
{
    protected $session;   
    protected $proyekModel;
    protected $memberModel;
    protected $meetingModel;
    protected $presensiModel;
    protected $userModel;
    
	public function __construct()
	{
       
        $this->proyekModel = new ProjectModel();
        $this->memberModel = new MemberModel();
        $this->meetingModel = new MeetingModel();
        $this->presensiModel = new PresensiModel();
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
		// if (!isset($_SESSION['last'])) {
		// 	$_SESSION['last'] = "";
		// };
    }
    
    public function dashboard()
    {
        $title = [
            'title' => 'Dashboard Admin | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            'user' => $this->userModel->getDetailbyId($this->session->id_user)
        ];
        // dd($data);
        // echo ($this->memberModel->getMemberbyUserProject(1,1)['id_member']);
        // echo $data['memberuserproject']['id_member'];
        // dd($data);
        // dd( base_url('css/font-awesome.min.css'));
        // dd($data['user']);
        echo view('header1_v',$title);
        echo view('sidebar_admin',$data);
        // echo 'lol';
        echo view('dashboard_v',$data);
        echo view('footer1_v');
    }
    public function project($id_project = false)
    {
        $title = [
            'title' => 'Dashboard Project | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            'user' => esc($this->userModel->getDetailbyId($this->session->id_user)),
            'project' => esc($this->proyekModel->getProjectCreator($id_project)),
            // 'member' =>esc($this->memberModel->getMemberbyProject($id_project)),
            // 'meeting' =>esc($this->meetingModel->getMeetingbyProject($id_project)),
            // 'resource' =>esc(),

        ];
        // dd($data);
        echo view('header1_v',$title);
        echo view('sidebar_admin',$data);
        if ($id_project == false) {
            // dd($data['project']);
            echo view('dashboard_project_v',$data);
        }
        else {
                // dd($data['project']);
                echo view('dashboard_detail_project_v',$data);
            }
        echo view('footer1_v');
    }
    public function member($id_project = false,$id_member = false)
    {
        $title = [
            'title' => 'Dashboard Member | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            'user' => esc($this->userModel->getDetailbyId($this->session->id_user)),
            // 'project' => esc($this->proyekModel->getProjectCreator($id_project)),
            'member' =>esc($this->memberModel->getMemberAllbyProject($id_project)),
            // 'meeting' =>esc($this->meetingModel->getMeetingbyProject($id_project)),
            // 'resource' =>esc(),

        ];
        // dd($data);
        echo view('header1_v',$title);
        echo view('sidebar_admin',$data);
        if ($id_project == false) {
            // dd($data['project']);
            echo view('dashboard_member_v',$data);
        }
        else {
                // dd($data['project']);
                echo view('dashboard_detail_memberproject_v',$data);
            }
        echo view('footer1_v');
    }
    public function toScrumMaster($id_project,$id_member)
    {
        $this->memberModel->save([
            'id_member' 	=> $id_member,
            'position'      => 'Scrum Master'
        ]);
        return redirect()->to(base_url('dashboard/member/'.$id_project));
    }
    public function toDevelopmentTeam($id_project,$id_member)
    {
        $this->memberModel->save([
            'id_member' 	=> $id_member,
            'position'      => 'Development Team'
        ]);
        return redirect()->to(base_url('dashboard/member/'.$id_project));
    }
    public function reactivation($id_project,$id_member)
    {
        $this->memberModel->save([
            'id_member' 	=> $id_member,
            'left_at'      => null
        ]);
        return redirect()->to(base_url('dashboard/member/'.$id_project));
        
    }
    public function meeting($id_project = false,$id_meeting = false)
    {
        $title = [
            'title' => 'Dashboard Member | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            'user' => esc($this->userModel->getDetailbyId($this->session->id_user)),
            // 'project' => esc($this->proyekModel->getProjectCreator($id_project)),
            // 'member' =>esc($this->memberModel->getMemberAllbyProject($id_project)),
            'meeting' =>esc($this->meetingModel->getMeetingbyProject($id_project)),
            // 'resource' =>esc(),

        ];
        // dd($data);
        echo view('header1_v',$title);
        echo view('sidebar_admin',$data);
        if ($id_project == false) {
            // dd($data['project']);
            echo view('dashboard_meeting_v',$data);
        }
        else {
                // dd($data['project']);
                echo view('dashboard_detail_meetingproject_v',$data);
            }
        echo view('footer1_v');
    }
    public function deleteMeeting($id_project,$id_meeting)
    {
        $this->meetingModel->delete($id_meeting);
        return redirect()->to(base_url('dashboard/meeting/'.$id_project));
    }
    public function deleteUser($id_user)
    {
        $this->userModel->delete($id_user);
        return redirect()->to(base_url('dashboard/user/'));
    }
    public function user($id_user = false)
    {
        $title = [
            'title' => 'Dashboard Member | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            'user' => esc($this->userModel->getDetailbyId($this->session->id_user)),
            // 'project' => esc($this->proyekModel->getProjectCreator($id_project)),
            // 'member' =>esc($this->memberModel->getMemberAllbyProject($id_project)),
            // 'meeting' =>esc($this->meetingModel->getMeetingbyProject($id_project)),
            'users' => esc($this->userModel->getDetailbyId())
            // 'resource' =>esc(),

        ];
        // dd($data);
        echo view('header1_v',$title);
        echo view('sidebar_admin',$data);
        if ($id_user == false) {
            // dd($data['project']);
            echo view('dashboard_user_v',$data);
        }
        else {
                // dd($data['project']);
                echo view('dashboard_detail_meetingproject_v',$data);
            }
        echo view('footer1_v');
    }
}