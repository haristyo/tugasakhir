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
            'link' => 	$this->request->uri->getSegment(2),
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
        $keyword =  $this->request->getVar('search');
        if ($keyword) {
            $project = $this->proyekModel->join('user','user.id_user=project.creator_project')->like('nama_project',$keyword)->orLike('kode_join',$keyword)->orLike('username',$keyword);
        }
        else {
            $project = $this->proyekModel->join('user','user.id_user=project.creator_project');
        }
        $title = [
            'title' => 'Dashboard Project | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            'link' => 	$this->request->uri->getSegment(2),
            'user' => esc($this->userModel->getDetailbyId($this->session->id_user)),
            'project'=>$project->paginate(25,'project'),
            'pager'=>$this->proyekModel->join('user','user.id_user=project.creator_project')->pager,
            'page'=>$this->request->getVar('page_project'),
            'keyword'=>esc($keyword)
        ];
        echo view('header1_v',$title);
        echo view('sidebar_admin',$data);
        echo view('dashboard_project_v',$data);
        echo view('footer1_v');
    }
    
    public function detailProject($id_project)
    {       
    $title = [
        'title' => 'Dashboard Project | Scrum Tool',
        'link' => 	$this->request->uri->getSegment(1)
    ];
    $data = [
        'project' => esc($this->proyekModel->getProjectCreator($id_project)),
        'link' => 	$this->request->uri->getSegment(2),
        'user' => esc($this->userModel->getDetailbyId($this->session->id_user)),

         
        // 'member' =>esc($this->memberModel->getMemberbyProject($id_project)),
        // 'meeting' =>esc($this->meetingModel->getMeetingbyProject($id_project)),
        // 'resource' =>esc(),

    ];
        echo view('header1_v',$title);
        echo view('sidebar_admin',$data);
        echo view('dashboard_detail_project_v',$data);
        echo view('footer1_v');
    }

    public function member()
    {
        $keyword =  $this->request->getVar('search');
        if ($keyword) {
            $member = $this->memberModel->join('user','user.id_user=member.id_user')
                ->join('project','project.id_project=member.id_project')
                ->like('nama_project',$keyword)->orLike('username',$keyword)->orLike('nama_user',$keyword)->orLike('kode_join',$keyword)->orLike('email',$keyword);
        }
        else {
            $member = $this->memberModel->join('user','user.id_user=member.id_user')
                ->join('project','project.id_project=member.id_project');
            
        }
        $title = [
            'title' => 'Dashboard Member | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            
            'link' => 	$this->request->uri->getSegment(2),
            'user' => esc($this->userModel->getDetailbyId($this->session->id_user)),
            // 'project' => esc($this->proyekModel->getProjectCreator($id_project)),
            
            // 'meeting' =>esc($this->meetingModel->getMeetingbyProject($id_project)),
            // 'resource' =>esc(),
            'member'=>$member->paginate(25,'member'),
            'pager'=>$this->memberModel->join('user','user.id_user=member.id_user')->join('project','project.id_project=member.id_project')->pager,
            'page'=>$this->request->getVar('page_member'),
            'keyword'=>esc($keyword)
        ];
        
        // dd($id_project);
        echo view('header1_v',$title);
        echo view('sidebar_admin',$data);
        echo view('dashboard_member_v',$data);
        echo view('footer1_v');
    }
    public function projectMember($id_project)
    {
        $title = [
            'title' => 'Dashboard Member | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            'project' => esc($this->proyekModel->getProject($id_project)),
            'link' => 	$this->request->uri->getSegment(2),
            'user' => esc($this->userModel->getDetailbyId($this->session->id_user)),
            'member' => esc($this->memberModel->getMemberAllbyProject($id_project))
            // 'project' => esc($this->proyekModel->getProjectCreator($id_project)),
            
            // 'meeting' =>esc($this->meetingModel->getMeetingbyProject($id_project)),
            // 'resource' =>esc(),

        ];
        echo view('header1_v',$title);
        echo view('sidebar_admin',$data);
        echo view('dashboard_detail_memberproject_v',$data);
        echo view('footer1_v');

    }
    public function toScrumMaster($id_member, $id_project = false)
    {
        // dd($this->request->uri->getPath());
        $this->memberModel->save([
            'id_member' 	=> $id_member,
            'position'      => 'Scrum Master'
        ]);
        if ($id_project != false) {
            return redirect()->to(base_url('dashboard/proyek/'.$id_project.'/member'));
        }
        else {
            return redirect()->to(base_url('dashboard/member'));
        }
    }
    public function toDevelopmentTeam($id_member,$id_project = false)
    {
        $this->memberModel->save([
            'id_member' 	=> $id_member,
            'position'      => 'Development Team'
        ]);
        if ($id_project != false) {
            return redirect()->to(base_url('dashboard/proyek/'.$id_project.'/member'));
        }
        else {
            return redirect()->to(base_url('dashboard/member'));
        }
    }
    public function reactivation($id_member,$id_project = false)
    {
        $this->memberModel->save([
            'id_member' 	=> $id_member,
            'left_at'      => null
        ]);
        return redirect()->to(base_url('dashboard/member/'.$id_project));
        if ($id_project != false) {
            return redirect()->to(base_url('dashboard/proyek/'.$id_project.'/member'));
        }
        else {
            return redirect()->to(base_url('dashboard/member'));
        }
        
    }
    public function meeting()
    {
        $title = [
            'title' => 'Dashboard Meeting | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            'user' => esc($this->userModel->getDetailbyId($this->session->id_user)),
            // 'project' => esc($this->proyekModel->getProjectCreator($id_project)),
            // 'member' =>esc($this->memberModel->getMemberAllbyProject($id_project)),
            'meeting' =>esc($this->meetingModel->getMeetingbyProject()),
            'link' => 	$this->request->uri->getSegment(2)
            // 'resource' =>esc(),

        ];
        // dd($data);
        echo view('header1_v',$title);
        echo view('sidebar_admin',$data);
            echo view('dashboard_meeting_v',$data);
        
        echo view('footer1_v');
    }
    public function projectMeeting($id_project)
    {
        $title = [
            'title' => 'Dashboard Meeting | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            'project' => esc($this->proyekModel->getProject($id_project)),
            'user' => esc($this->userModel->getDetailbyId($this->session->id_user)),
            // 'project' => esc($this->proyekModel->getProjectCreator($id_project)),
            // 'member' =>esc($this->memberModel->getMemberAllbyProject($id_project)),
            'meeting' =>esc($this->meetingModel->getMeetingbyProject($id_project)),
            'link' => 	$this->request->uri->getSegment(2)
            // 'resource' =>esc(),

        ];
        echo view('header1_v',$title);
        echo view('sidebar_admin',$data);
        echo view('dashboard_detail_meetingproject_v',$data);
        echo view('footer1_v');
    }
    public function deleteMeeting($id_meeting,$id_project = false)
    {
        $this->meetingModel->delete($id_meeting);
        if ($id_project == false) {
            return redirect()->to(base_url('dashboard/meeting/'));
        }
        else {
            return redirect()->to(base_url('dashboard/proyek/'.$id_project.'/meeting'));
        }
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
            'link' => 	$this->request->uri->getSegment(2),
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