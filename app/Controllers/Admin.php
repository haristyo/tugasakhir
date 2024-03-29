<?php

namespace App\Controllers;
use App\Models\ProjectModel;
use App\Models\MemberModel;
use App\Models\MeetingModel;
use App\Models\PresensiModel;
use App\Models\BacklogModel;
use App\Models\EpicModel;
use App\Models\UserModel;
use App\Models\UsersModel;
use App\Models\SprintModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends BaseController
{
    protected $session;   
    protected $proyekModel;
    protected $memberModel;
    protected $meetingModel;
    protected $presensiModel;
    protected $backlogModel;
    protected $epicModel;
    protected $userModel;
    protected $usersModel;
    protected $sprintModel;
    
	public function __construct()
	{
        $this->proyekModel = new ProjectModel();
        $this->memberModel = new MemberModel();
        $this->meetingModel = new MeetingModel();
        $this->presensiModel = new PresensiModel();
        $this->backlogModel = new BacklogModel();
        $this->epicModel = new EpicModel();
        $this->userModel = new UserModel();
        $this->usersModel = new UsersModel();
        $this->sprintModel = new SprintModel();
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
            'user' => esc($this->userModel->getDetailbyId($this->session->id_user))
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
            'project'=>esc($project->paginate(25,'project')),
            'pager'=>esc($this->proyekModel->join('user','user.id_user=project.creator_project')->pager),
            'page'=>esc($this->request->getVar('page_project')),
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
            'member'=>esc($member->paginate(25,'member')),
            'pager'=>esc($this->memberModel->join('user','user.id_user=member.id_user')->join('project','project.id_project=member.id_project')->pager),
            'page'=>esc($this->request->getVar('page_member')),
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
        if ($this->request->getVar('csrf_test_name')) {
            $this->memberModel->save([
                'id_member' 	=> $id_member,
                'position'      => 'Scrum Master'
            ]);
        }
        if ($id_project != false) {
            return redirect()->to(base_url('dashboard/proyek/'.$id_project.'/member'));
        }
        else {
            return redirect()->to(base_url('dashboard/member'));
        }
    }
    public function toDevelopmentTeam($id_member,$id_project = false)
    {
        if ($this->request->getVar('csrf_test_name')) {
            $this->memberModel->save([
                'id_member' 	=> $id_member,
                'position'      => 'Development Team'
            ]);
        }
        if ($id_project != false) {
            return redirect()->to(base_url('dashboard/proyek/'.$id_project.'/member'));
        }
        else {
            return redirect()->to(base_url('dashboard/member'));
        }
    }
    public function reactivation($id_member,$id_project = false)
    {
        if ($this->request->getVar('csrf_test_name')) {
            $this->memberModel->save([
                'id_member' 	=> $id_member,
                'left_at'      => null
            ]);
        }
        // return redirect()->to(base_url('dashboard/proyek/'.$id_project.'/member'));

        if ($id_project != false) {
            return redirect()->to(base_url('dashboard/proyek/'.$id_project.'/member'));
        }
        else {
            return redirect()->to(base_url('dashboard/member'));
        }
        
    }
    public function meeting()
    {
        // dd($_GET);
        $meeting = $this->meetingModel->pagination();
        $keyword =  $this->request->getVar('search');
        $agenda =  $this->request->getVar('agenda');
        $tanggal =  $this->request->getVar('tanggal');
        // $meetingin = $this->meetingModel->where('meeting.agenda','Sprint Planning');
        // $meetingan =$meetingin->findAll();
        // d($meetingan);
        // $meetingin = $meetingin->where('meeting.id_project',1)->findAll();
        // d($meetingin);
        // $meetingun = $this->meetingModel->where('meeting.agenda','Sprint Planning')->where('meeting.id_project',1)->findAll();
        // dd($meetingun);
        
        // d(date("Y-m-d H:i:s", strtotime($tanggal)));
        // d(date("Y-m-d H:i:s", strtotime($tanggal."+1 days -1 second")));
        // $meetingin = $meeting;
        // dd($meetingin->select('agenda,time_meeting')->findAll());
        if ($keyword) {
            if($agenda){
                if ($tanggal) {
                    $meeting = $meeting->where(['meeting.agenda'=>$agenda,'meeting.time_meeting >'=>date("Y-m-d H:i:s", strtotime($tanggal)),'meeting.time_meeting <'=>date("Y-m-d H:i:s", strtotime($tanggal."+1 days -1 second"))])->like('project.nama_project',$keyword)->orLike('meeting.agenda',$keyword);
                }else {
                    $meeting = $meeting->where('meeting.agenda',$agenda)->like('project.nama_project',$keyword)->orLike('meeting.agenda',$keyword);
                }
            }
            else {
                if ($tanggal) {
                    $meeting = $meeting->where(['meeting.time_meeting >'=>date("Y-m-d H:i:s", strtotime($tanggal."-1 second")),'meeting.time_meeting <'=>date("Y-m-d H:i:s", strtotime($tanggal."+1 days"))])->like('project.nama_project',$keyword)->orLike('meeting.agenda',$keyword);
                }
                else {
                    $meeting = $meeting->like('project.nama_project',$keyword)->orLike('meeting.agenda',$keyword);
                    
                }
            }

        }
        else {
            if($agenda){
                if ($tanggal) {
                    $meeting = $meeting->where(['meeting.agenda'=>$agenda,'meeting.time_meeting >'=>date("Y-m-d H:i:s", strtotime($tanggal)),'meeting.time_meeting <'=>date("Y-m-d H:i:s", strtotime($tanggal."+1 days -1 second"))]);

                }else {
                    $meeting = $meeting->where('meeting.agenda',$agenda);
                }
            }
            else {
                $meeting = $meeting->where(['meeting.time_meeting >'=>date("Y-m-d H:i:s", strtotime($tanggal)),'meeting.time_meeting <'=>date("Y-m-d H:i:s", strtotime($tanggal."+1 days -1 second"))]);
            }
        }




        $title = [
            'title' => 'Dashboard Meeting | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            'user' => esc($this->userModel->getDetailbyId($this->session->id_user)),
            // 'project' => esc($this->proyekModel->getProjectCreator($id_project)),
            // 'member' =>esc($this->memberModel->getMemberAllbyProject($id_project)),
            'link' => 	$this->request->uri->getSegment(2),
            'meeting' =>esc($meeting->paginate(25,'meeting')),
            'pager'=> $meeting->pager,
            'keyword'=>esc($keyword),
            'agenda'=>esc($agenda),
            'tanggal'=>esc($tanggal),
            'page'=>$this->request->getVar('page_meeting'),
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
        $meeting = $this->meetingModel->pagination($id_project);
        $agenda =  $this->request->getVar('agenda');
        $tanggal =  $this->request->getVar('tanggal');
        if($agenda){
            if ($tanggal) {
                $meeting = $meeting->where(['meeting.agenda'=>$agenda,'meeting.time_meeting >'=>date("Y-m-d H:i:s", strtotime($tanggal)),'meeting.time_meeting <'=>date("Y-m-d H:i:s", strtotime($tanggal."+1 days -1 second"))]);

            }else {
                $meeting = $meeting->where('meeting.agenda',$agenda);
            }
        }
        else {
            $meeting = $meeting->where(['meeting.time_meeting >'=>date("Y-m-d H:i:s", strtotime($tanggal)),'meeting.time_meeting <'=>date("Y-m-d H:i:s", strtotime($tanggal."+1 days -1 second"))]);
        }
        

        $title = [
            'title' => 'Dashboard Meeting | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            'project' => esc($this->proyekModel->getProject($id_project)),
            'user' => esc($this->userModel->getDetailbyId($this->session->id_user)),
            // 'project' => esc($this->proyekModel->getProjectCreator($id_project)),
            // 'member' =>esc($this->memberModel->getMemberAllbyProject($id_project)),
            'link' => 	$this->request->uri->getSegment(2),
            'meeting' =>esc($meeting->paginate(25,'meeting')),
            'pager'=> $meeting->pager,
            'agenda'=>esc($agenda),
            'tanggal'=>esc($tanggal),
            'page'=>$this->request->getVar('page_member'),
            // 'resource' =>esc(),

        ];
        echo view('header1_v',$title);
        echo view('sidebar_admin',$data);
        echo view('dashboard_detail_meetingproject_v',$data);
        echo view('footer1_v');
    }
    public function deleteMeeting($id_meeting,$id_project = false)
    {
        if ($this->request->getVar('csrf_test_name')) {
            $this->meetingModel->delete($id_meeting);
        }
            if ($id_project == false) {
                return redirect()->to(base_url('dashboard/meeting/'));
            }
            else {
                return redirect()->to(base_url('dashboard/proyek/'.$id_project.'/meeting'));
            }
    }
    public function deleteUser($id_user)
    {
        if ($this->request->getVar('csrf_test_name')) {
        $this->userModel->delete($id_user);
        }
        return redirect()->to(base_url('dashboard/user/'));
    }
    public function user()
    {
       
        $user = $this->usersModel;
        $keyword =  $this->request->getVar('search');
        $status =  $this->request->getVar('status');
        if ($keyword) {
            $user = $user->like('username',$keyword)->orLike('nama_user',$keyword)->orLike('email',$keyword);
            if ($status == "admin") {
                $user =  $user->where('is_admin','Y')->orwhere('is_admin','S');
            }
            elseif ($status == "bukanadmin"){
                $user =  $user->where('is_admin','N');
            }
        }
        else {
            if ($status == "admin") {
                $user =  $user->where('is_admin','Y')->orwhere('is_admin','S');
            }
            elseif ($status == "bukanadmin") {
                $user =  $user->where('is_admin','N');
            }
        }
        $title = [
            'title' => 'Dashboard User | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        
        // d($data['user']);
      
        $data = [
            'link' => 	$this->request->uri->getSegment(2),
            
            // 'project' => esc($this->proyekModel->getProjectCreator($id_project)),
            // 'member' =>esc($this->memberModel->getMemberAllbyProject($id_project)),
            // 'meeting' =>esc($this->meetingModel->getMeetingbyProject($id_project)),
            'user' => ($this->userModel->getDetailbyId($this->session->id_user)),
            'users' => esc($user->paginate(25,'user')),
            'pager'=> $user->pager,
            'page'=>$this->request->getVar('page_user'),
            'keyword'=>esc($keyword),
            'status'=>esc($status),
            'member'=>esc($this->memberModel->getMemberbyUser()),
            'backlog'=>esc($this->backlogModel->countBacklogbyUserProject()),
            'epic'=>esc($this->epicModel->countEpicbyUserProject()),
            // 'resource' =>esc(),

            
        ];
        // dd($data['epic']);
        // $data = ['user' => ($user->where('id_user',$this->session->id_user)->first())];
        
        // d(($data));
        // dd(($this->userModel));
        echo view('header1_v',$title);
        echo view('sidebar_admin',$data,);
            echo view('dashboard_user_v',$data);
        echo view('footer1_v');
    }

    public function exportUser()
    {
            
            // $user = esc($this->userModel->getDetailbyId($this->session->id_user)),
            $user = esc($this->userModel->getUser());
            $member= esc($this->memberModel->getMemberbyUser());
            $backlog = esc($this->backlogModel->countBacklogbyUserProject());
            $epic = esc($this->epicModel->countEpicbyUserProject());
            // 'resource' =>esc(),

        // dd($member);
    
        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Nama Pengguna')
                    ->setCellValue('B1', 'Nama Lengkap')
                    ->setCellValue('C1', 'Email')
                    ->setCellValue('D1', 'Nama Proyek')
                    ->setCellValue('E1', 'Posisi')
                    ->setCellValue('F1', 'Tanggal Bergabung')
                    ->setCellValue('G1', 'Backlog Dibuat')
                    ->setCellValue('H1', 'Task Dibuat');
        
        $kolom = 2;
        // tulis data mobil ke cell
        foreach($user as $users) {
           
            $i = 0;
            foreach ($member as $members) {
                if ($users['id_user']== $members['id_user']) {

                   $backlog_total = 0; 
                   foreach ($backlog as $backlogs ) {
                      if ($members['id_member']==$backlogs['creator_backlog']) {
                        $backlog_total += $backlogs['id_backlog'];
                      }
                    }
                      
                    $epic_total = 0; 
                    foreach ($epic as $epics) {
                      if ($members['id_member']==$epics['creator_epic']) {
                        $epic_total += $epics['id_epic'];
                      }
                    }

                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $kolom, $members['username'])
                        ->setCellValue('B' . $kolom, $members['nama_user'])
                        ->setCellValue('C' . $kolom, $members['email'])
                        ->setCellValue('D' . $kolom, $members['nama_project'])
                        ->setCellValue('E' . $kolom, $members['position'])
                        ->setCellValue('F' . $kolom, $members['created_member'])
                        ->setCellValue('G' . $kolom, $backlog_total)
                        ->setCellValue('H' . $kolom, $epic_total);
                    $i++;
                    $kolom++;
                }
            }

            if ($i==0) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $kolom, $users['username'])
                    ->setCellValue('B' . $kolom, $users['nama_user'])
                    ->setCellValue('C' . $kolom, $users['email'])
                    ->setCellValue('D' . $kolom, 'Belum Bergabung dengan proyek')
                    ->setCellValue('E' . $kolom, '-')
                    ->setCellValue('F' . $kolom, '-')
                    ->setCellValue('G' . $kolom, '-')
                    ->setCellValue('H' . $kolom, '-');
                $spreadsheet->getActiveSheet()->getStyle('A'.$kolom.':H'.$kolom.'')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('FF0000');
                $spreadsheet->getActiveSheet()->getStyle('A'.$kolom.':H'.$kolom.'')
                    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
                $kolom++;
            }
        }
        $spreadsheet->getActiveSheet()->setAutoFilter(
            $spreadsheet->getActiveSheet()->calculateWorksheetDimension()
        );

        $spreadsheet->getActiveSheet()->getStyle('A1:H1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('74A4F2');

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(32);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(16);
        // tulis dalam format .xlsx
        // $writer = new Xlsx($spreadsheet);
        $fileName = 'Export Data User '.date('Y-m-d_H-i');
        
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$fileName.'.xlsx"');
        header('Cache-Control: max-age=0');
        
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->setOffice2003Compatibility(true);
        
        die($writer->save('php://output'));
    }


    public function projectSprint($id_project)
    {
        $sprint = $this->sprintModel->pagination($id_project);
        // dd($sprint->findAll());
        $keyword =  $this->request->getVar('search');
        $tanggal =  $this->request->getVar('tanggal');
        // d($sprint->first());
        if($keyword){
            if ($tanggal) {
                $sprint = $sprint->where(['sprint.start_sprint <'=>date("Y-m-d H:i:s", strtotime($tanggal)),'sprint.end_sprint >'=>date("Y-m-d H:i:s", strtotime($tanggal))])->like('sprint.goal',$keyword);

            }else {
                $sprint = $sprint->like('sprint.goal',$keyword);
            }
        }
        else {
            if ($tanggal) {
                // dd(date("Y-m-d H:i:s", strtotime($tanggal)));
            $sprint = $sprint->where(['sprint.start_sprint <'=>date("Y-m-d H:i:s", strtotime($tanggal))])->Where(['sprint.end_sprint >'=>date("Y-m-d H:i:s", strtotime($tanggal))]);
            }
        }
        $title = [
            'title' => 'Dashboard Sprint | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            'project' => esc($this->proyekModel->getProject($id_project)),
            'user' => esc($this->userModel->getDetailbyId($this->session->id_user)),
            // 'project' => esc($this->proyekModel->getProjectCreator($id_project)),
            // 'member' =>esc($this->memberModel->getMemberAllbyProject($id_project)),
            'link' => 	$this->request->uri->getSegment(2),
            'sprint' =>esc($sprint->paginate(25,'sprint')),
            'pager'=> $sprint->pager,
            'keyword'=>esc($keyword),
            'tanggal'=>esc($tanggal),
            'page'=>$this->request->getVar('page_sprint'),
            // 'resource' =>esc(),

        ];
        echo view('header1_v',$title);
        echo view('sidebar_admin',$data);
        echo view('dashboard_detail_sprintproject_v',$data);
        echo view('footer1_v');
    }
    public function reactivationSprint($id_sprint,$id_project)
    {
        if ($this->request->getVar('csrf_test_name')) {
            $this->sprintModel->save([
                'id_sprint' 	=> $id_sprint,
                'end_sprint'      => null
                ]);
        }
        return redirect()->to(base_url('dashboard/proyek/'.$id_project.'/sprint'));

    }
    public function deletesprint($id_sprint,$id_project)
    {
        if ($this->request->getVar('csrf_test_name')) {
            $this->sprintModel->delete($id_sprint);
        }
        return redirect()->to(base_url('dashboard/proyek/'.$id_project.'/sprint'));
    }
    public function endSprint($id_sprint,$id_project)
    {
        if ($this->request->getVar('csrf_test_name')) {
            $this->sprintModel->save([
                'id_sprint' 	=> $id_sprint,
                'end_sprint'  => date('Y-m-d H:i:s', time())
                ]);
        }
        return redirect()->to(base_url('dashboard/proyek/'.$id_project.'/sprint'));
    }
}