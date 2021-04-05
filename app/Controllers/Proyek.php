<?php

namespace App\Controllers;
use App\Models\ProjectModel;
use App\Models\MemberModel;
use App\Models\MeetingModel;
use App\Models\PresensiModel;
use App\Models\UserModel;
use App\Models\BacklogModel;
use App\Models\SprintModel;
use App\Models\EpicModel;
class Proyek extends BaseController
{
    protected $session;   
    protected $proyekModel;
    protected $memberModel;
    protected $meetingModel;
    protected $presensiModel;
    protected $userModel;
    protected $backlogModel;
    protected $sprintModel;
    protected $epicModel;
    
	public function __construct()
	{
       
        $this->proyekModel = new ProjectModel();
        $this->memberModel = new MemberModel();
        $this->meetingModel = new MeetingModel();
        $this->presensiModel = new PresensiModel();
        $this->userModel = new UserModel();
        $this->backlogModel = new BacklogModel();
        $this->sprintModel = new SprintModel();
        $this->epicModel = new EpicModel();
        $this->session = \Config\Services::session();
		// if (!isset($_SESSION['last'])) {
		// 	$_SESSION['last'] = "";
		// };
    }
    public function index()
	{ 
        
        // dd($this->memberModel->getProjectbyUser());
            $title = [
                'title' => 'Proyek Saya | Scrum Tool',
                'link' => 	$this->request->uri->getSegment(1)
            ];
            $data = [
                'proyek' => $this->memberModel->getMemberbyUser($this->session->id_user),
                'link' =>    $this->request->uri->getPath(),
            ];
            // dd($data);
            // echo ($this->memberModel->getMemberbyUserProject(1,1)['id_member']);
            // echo $data['memberuserproject']['id_member'];
            echo view('header1_v',$title);
            echo view('proyek_v',$data);
            echo view('footer1_v');
    }
    public function create()
	{
        $title = [
            'title' => 'Proyek Saya | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            'validation' =>  \Config\Services::validation()
        ];
        echo view('header1_v',$title);
        echo view('createproyek_v',$data);
        echo view('footer1_v');
    }
    public function add()
	{
		if(!$this->validate([

			'nama_project' => ['rules'=>'required',
						'errors'=>[ 'required'=>  'Nama Proyek Harus diisi']
					   ],
            'kode_join' => ['rules'=>'required|is_unique[project.kode_join]|min_length[4]|max_length[32]',
                        'errors'=>[ 'required'=> 'Kode Join Harus diisi',
                                    'is_unique'=>'Kode Gabung Pernah digunakan',
                                    'min_length'=>'Kode Gabung minimal 4 karakter',
                                    'max_length'=>'Kode Gabung maksimal 32 karakter']
                        ],

            'password_project' => ['rules'=> 'required|min_length[4]|max_length[32]',
                                    'errors'=>[ 'required'=>  'Kata Sandi harus diisi',
                                    'min_length'=>'Kata Sandi minimal 4 karakter',
                                    'max_length'=>'Kata Sandi maksimal 32 karakter']
                        ],
                               
                               
		])) {
			// $validation = \Config\Services::validation();
			// return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
			return redirect()->to(base_url('/proyek/create'))->withInput();
		}

		$this->proyekModel->save([
			'nama_project' 		=> $this->request->getVar('nama_project'),
            'kode_join'  	    => $this->request->getVar('kode_join'),
            'creator_project'   => $this->session->id_user,
			'password_project'  => $this->request->getVar('password_project'),
            'deskripsi'     	=> $this->request->getVar('deskripsi')
		
        ]);
        $data = esc($this->proyekModel->getProjectbyKode($this->request->getVar('kode_join')));
        $this->memberModel->save([
            'id_project'    => $data['id_project'],
            'id_user'       => $this->session->id_user,
			'position'      => 'Scrum Master'
        ]);
        // return redirect()->to(base_url('/proyek/'.$data['id_project']));
        
		return redirect()->to(base_url('/proyek'));
    }

    public function join()
    {
        $title = [
            'title' => 'Bergabung | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            'validation' =>  \Config\Services::validation()
        ];
        echo view('header1_v',$title);
        echo view('join_v',$data);
        echo view('footer1_v');
        

    }
    public function joined()
    {   //dd(esc($this->proyekModel->getProjectbyKode($this->request->getVar('kode_join'))));
        // dd($this->memberModel->getCountMemberbyUserProject($this->session->id_user,$this->proyekModel->getProjectbyKode($this->request->getVar('kode_join'))));
        if (!$this->request->getVar('kode_join')=="") {
            $data = esc($this->proyekModel->getProjectbyKode($this->request->getVar('kode_join')));
            if($data != null) {
                // dd($data);
            // $data = esc($this->proyekModel->getProjectbyKode($this->request->getVar('kode_join')));
            $joined = $this->memberModel->getCountMemberbyUserProject($this->session->id_user,$data['id_project'])['id_member'];
            }
            else {
                $joined = 0;
            }
            // dd($joined['id_member']);
        }
        else {
            $joined = 0;
        }
        // d($data);
        // dd($joined);
        // $joined = $this->memberModel->getMemberbyUserProject($this->session->id_user ,$data['id_project'])['id_member'];
        // dd($joined);
        
		if(!$this->validate([
            'kode_join' => ['rules'=>'required|is_not_unique[project.kode_join]|min_length[4]|max_length[32]',
                        'errors'=>[ 'required'=> 'Kode Join Harus diisi',
                                    'is_not_unique'=>'Kode Gabung Tidak terdaftar',
                                    'min_length'=>'Kode Gabung minimal 4 karakter',
                                    'max_length'=>'Kode Gabung maksimal 32 karakter']
                        ],

            'password_project' => ['rules'=> 'required|min_length[4]|max_length[32]',
                                    'errors'=>[ 'required'=>  'Kata Sandi harus diisi',
                                    'min_length'=>'Kata Sandi minimal 4 karakter',
                                    'max_length'=>'Kata Sandi maksimal 32 karakter']
                    ],
            'position' => ['rules'=> 'in_list[Development Team,Scrum Master,Product Owner]',
                            'errors'=>[ 'in_list'=>  'Pilih Posisi Anda' ] 
                            ]       
		]) || !$data['password_project'] == $this->request->getVar('password_project') || $joined>0) {
			// $validation = \Config\Services::validation();
            // return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
            if ($joined>0) { $this->session->setFlashdata('kode_join', 'Anda sudah pernah bergabung dengan Proyek ini');}
			return redirect()->to(base_url('/proyek/join'))->withInput();
        }
        $this->memberModel->save([
            'id_project'    => $data['id_project'],
            'id_user'       => $this->session->id_user,
			'position'      => $this->request->getVar('position')
        ]);
        return redirect()->to(base_url('/proyek/'));
    }
    public function detail($id_project)
    {
        $data = [
			'project' => esc($this->proyekModel->getProject($id_project)),
            'member' => esc($this->memberModel->getMemberDetailbyUserProject($this->session->id_user,$id_project)),
            'link' =>    $this->request->uri->getPath(),
            'members' => esc($this->memberModel->getMemberbyProject($id_project))
            
		];
        $title = ['title' => 'Detail Project | Scrum Tool',
        'link' => 	$this->request->uri->getSegment(1)];
        // dd($data['members']);
        if ($data['member'] == null)
        {
            return redirect()->to(base_url('/proyek/'));
        }
        else {
            echo view('header1_v',$title);
		    echo view('sidebar',$data);
		    echo view('detailproyek_v',$data);
            echo view('footer1_v');
        }
            
    }

    public function meeting($id_project)
    {
        $keyword =  $this->request->getVar('search');
        $agenda =  $this->request->getVar('agenda');
        if ($keyword) {
            if($agenda) {
            $meeting = $project = $this->meetingModel->join('member','member.id_member=meeting.creator_meeting')
                ->join('project','project.id_project=meeting.id_project')->where(['meeting.id_project'=>$id_project,'meeting.agenda'=>$agenda])->orderBy('time_meeting', 'DESC')
                ->like('agenda',$keyword)->orLike('deskripsi_meeting',$keyword);
            }
            else {
            $meeting = $this->meetingModel->join('member','member.id_member=meeting.creator_meeting')
                ->join('project','project.id_project=meeting.id_project')->where('meeting.id_project',$id_project)->orderBy('time_meeting', 'DESC')
                ->like('agenda',$keyword)->orLike('deskripsi_meeting',$keyword);
            }
        }
        else {
            if ($agenda) {
                $meeting = $this->meetingModel->join('member','member.id_member=meeting.creator_meeting')
                ->join('project','project.id_project=meeting.id_project')->where(['meeting.id_project'=>$id_project,'meeting.agenda'=>$agenda])->orderBy('time_meeting', 'DESC');
            }
            else {
                $meeting = $this->meetingModel->join('member','member.id_member=meeting.creator_meeting')
                ->join('project','project.id_project=meeting.id_project')->where('meeting.id_project',$id_project)->orderBy('time_meeting', 'DESC');
            }
        }

        $data = [
			'project' => esc($this->proyekModel->getProject($id_project)),
            'member' => esc($this->memberModel->getMemberDetailbyUserProject($this->session->id_user,$id_project)),
            'members' => esc($this->memberModel->getMemberbyProject($id_project)),
            'link' =>    $this->request->uri->getPath(),

            'meetings'=>esc($meeting->paginate(10,'meeting')),
            'pager'=>$this->meetingModel->join('member','member.id_member=meeting.creator_meeting')->join('project','project.id_project=meeting.id_project')->where('meeting.id_project',$id_project)->orderBy('time_meeting', 'DESC')->pager,
            'page'=>$this->request->getVar('page_meeting'),
            'keyword'=>esc($keyword),
            'agenda'=>esc($agenda),

            'presensiall' => esc($this->presensiModel->getPresensibyProject($id_project)),
            //'meetings' => esc($this->meetingModel->getMeetingbyProject($id_project)),
            'countall' => esc($this->memberModel->getCountMemberbyPosition($id_project,"all")),
            'countex' => esc($this->memberModel->getCountMemberbyPosition($id_project,"")),
            'yanghadir' =>esc($this->presensiModel->getCountUserbyProject($id_project)),
            'validation' =>  \Config\Services::validation()
        ];
        // dd($data['meetings']);
        // dd($data['meetings']);
        if ($data['member'] == null)
        {
            return redirect()->to(base_url('/proyek/'));
        }
        else {
            $title = ['title' =>    'Meeting | Scrum Tool',
            'link' =>    $this->request->uri->getSegment(1)];
                    //    dd($data['yanghadir']);
                    if ($data['member'] == null)
            {
                return redirect()->to(base_url('/proyek/'));
            }
            else {
                echo view('header1_v',$title);
                echo view('sidebar',$data);
                echo view('meeting_v',$data);
                echo view('footer1_v');
            }
        }
    }
    public function createmeeting($id_project)
    {
        // dd($_POST);
        if(!$this->validate([
            'link_meeting' => ['rules'=>'required',
            'errors'=>[ 'required'=> 'Tautan Meeting Harus diisi']
                        ],
                        'time_meeting' => ['rules'=>'required',
                        'errors'=>[ 'required'=> 'Waktu Meeting Harus diisi']
                        ],
                        'agenda' => ['rules'=> 'in_list[Sprint Planning,Sprint Retrospective,Daily Scrum,Sprint Review]',
                            'errors'=>[ 'in_list'=>  'Pilih Agenda Anda' ] 
                            ]
		]) ) {
			// $validation = \Config\Services::validation();
            // return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
			return redirect()->to(base_url('/proyek/'.$id_project.'/meeting'))->withInput();
        }
        // $creator=$this->memberModel->getIdbyUserProject($this->session->id_user, $id_project);
        // dd($this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member'] );
        // dd($this->memberModel->getIdbyUserProject($this->session->id_user, $id_project),);
        $this->meetingModel->save([
            'id_project'        => $id_project,
            'creator_meeting'   => $this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member'],
            'agenda'            => $this->request->getVar('agenda'),
            'deskripsi_meeting' => $this->request->getVar('deskripsi_meeting'),
            'link_meeting'      => $this->request->getVar('link_meeting'),
            'time_meeting'      => $this->request->getVar('time_meeting')
            ]);
        return redirect()->to(base_url('/proyek/'.$id_project.'/meeting'));
    }
    public function editmeeting($id_project,$id_meeting)
    {
        // dd($_POST);
        if(!$this->validate([
            'link_meeting'.$id_meeting => ['rules'=>'required',
                                        'errors'=>[ 'required'=> 'Tautan Meeting Harus diisi']
                                                    ],
            'time_meeting'.$id_meeting => ['rules'=>'required',
                                            'errors'=>[ 'required'=> 'Waktu Meeting Harus diisi']
            ],
            'agenda'.$id_meeting => ['rules'=> 'in_list[Sprint Planning,Sprint Retrospective,Daily Scrum,Sprint Review]',
                                    'errors'=>[ 'in_list'=>  'Pilih Agenda Anda' ] 
                                                ]
		]) ) {
			// $validation = \Config\Services::validation();
            // return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
			return redirect()->to(base_url('/proyek/'.$id_project.'/meeting'))->withInput();
        }
        // $creator=$this->memberModel->getIdbyUserProject($this->session->id_user, $id_project);
        // dd($this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member'] );
        // dd($this->memberModel->getIdbyUserProject($this->session->id_user, $id_project),);
        $this->meetingModel->save([
            
            'id_meeting'        => $id_meeting,
            'agenda'            => $this->request->getVar('agenda'.$id_meeting),
            'deskripsi_meeting' => $this->request->getVar('deskripsi_meeting'.$id_meeting),
            'link_meeting'      => $this->request->getVar('link_meeting'.$id_meeting),
            'time_meeting'      => $this->request->getVar('time_meeting'.$id_meeting)
            ]);
        return redirect()->to(base_url('/proyek/'.$id_project.'/meeting'));
    }
    public function meetingjoin($id_meeting)
    {
        $data = esc($this->meetingModel->getMeetingbyId($id_meeting));
        $countpresensi = esc($this->presensiModel->getCountPresensibyUserMeeting($this->session->id_user,$id_meeting));
        $present = esc($this->presensiModel->getIdbyUserMeeting($this->session->id_user,$id_meeting));
        $id_project = esc($this->meetingModel->getMeetingbyId($id_meeting)['id_project']);
        // d($countpresensi);
        // d($data);
        // dd($id_project);
        // dd($this->memberModel->getIdbyUserProject($this->session->id_user,$this->meetingModel->getMeetingbyId($id_meeting)['id_project']));
        if ($countpresensi['id_presensi']>0){
            $this->presensiModel->save([
                'id_presensi' 		=> esc($present['id_presensi'])
            ]);
        ;}
        else {
            $this->presensiModel->save([
                'id_meeting' 		=> $id_meeting,
                'id_member'  	    => $this->memberModel->getIdbyUserProject($this->session->id_user,$this->meetingModel->getMeetingbyId($id_meeting)['id_project'])['id_member']
            ]);
        }
        return redirect()->to($data['link_meeting']);
    }
    public function presensi($id_project)
    {
        $data = [
            'project' => esc($this->proyekModel->getProject($id_project)),
            'member' => esc($this->memberModel->getMemberDetailbyUserProject($this->session->id_user,$id_project)),
            'members' => esc($this->memberModel->getMemberbyProject($id_project)),
            'link' =>    $this->request->uri->getPath(),

            'presensi' => esc($this->presensiModel->getCountPresensiMemberbyProject($id_project)),
            'meetingall' => esc($this->meetingModel->getCountMeetingbyAgenda($id_project,'all')),
            'meetingex' => esc($this->meetingModel->getCountMeetingbyAgenda($id_project,'')),
            'meetingsemua' => esc($this->meetingModel->getMeetingbyProject($id_project)),
            'meetingexcept' => esc($this->meetingModel->getMeetingbyProject($id_project,"ex")),
            'presensiall' => esc($this->presensiModel->getPresensibyProject($id_project))
        ];
        $title = ['title' =>    'Presensi | Scrum Tool',
                'link' =>    $this->request->uri->getSegment(1)];
        // dd($data);
        if ($data['member'] == null)
        {
            return redirect()->to(base_url('/proyek/'));
        }
        else {
            // d($data['meetingall']);
            // d($data['meetingall']);
            //  dd($data['members']);
            // dd($data['presensiall']);
            echo view('header1_v',$title);
            echo view('sidebar',$data);
            echo view('presensi_v',$data);
            echo view('footer1_v');
        }
    }
    public function deletemember($id_project,$id_member)
    {
        // d($id_project);
        // d(time() );
        // d(date('Y-m-d H:i:s', time()) );
        // d(date('Y-m-d h-i-s'));
        // dd($id_member);
        $this->memberModel->save([
            'id_member'    => $id_member,
            'left_at'      => date('Y-m-d H:i:s', time())
            ]);
        return redirect()->to(base_url('/proyek/'.$id_project.'/presensi/'));
        
    }
    
    public function deleteMeeting($id_project,$id_meeting)
    {
        $this->meetingModel->delete($id_meeting);
        return redirect()->to(base_url('proyek/'.$id_project.'/meeting/'));
    }
    
    public function board($id_project)
	{ 
            $title = [
                'title' => 'Papan Proyek | Scrum Tool',
                'link' => 	$this->request->uri->getSegment(1)
            ];
            $data = [
                'proyek' => $this->memberModel->getMemberbyUser($this->session->id_user),
                'link' =>    $this->request->uri->getPath(),
                'member' => esc($this->memberModel->getMemberDetailbyUserProject($this->session->id_user,$id_project)),
                'members' => esc($this->memberModel->getMemberbyProject($id_project)),
                'backlog' => esc($this->backlogModel->getBacklogbyProject($id_project)),
                'sprint' => esc($this->sprintModel->getSprintbyProject($id_project)),
                'epic' => esc($this->epicModel->getEpicbyProject($id_project)),
                'validation' =>  \Config\Services::validation()

            ];
            //     d($this->epicModel->getEpicbyProject());
            // dd($data);
            if ($data['member'] == null)
            {
                return redirect()->to(base_url('/proyek/'));
            }
            else {
                echo view('header1_v',$title);
                echo view('sidebar',$data);
                echo view('board_v',$data);
                echo view('footer1_v');
            }
    }

    public function resource($id_project)
	{ 
            $title = [
                'title' => 'Sumber Daya | Scrum Tool',
                'link' => 	$this->request->uri->getSegment(1)
            ];
            $data = [
                'proyek' => $this->memberModel->getMemberbyUser($this->session->id_user),
                'link' =>    $this->request->uri->getPath(),
                'member' => esc($this->memberModel->getMemberDetailbyUserProject($this->session->id_user,$id_project)),
                'members' => esc($this->memberModel->getMemberbyProject($id_project))
                ];
            echo view('header1_v',$title);
            echo view('sidebar',$data);
            echo "<div id='content' class='p-4 p-md-5 pt-5'><div><div>";
            echo view('footer1_v');
    }

    public function editbacklog($id_backlog)
    {
        $id_project = $this->backlogModel->getBacklogbyId($id_backlog)['id_project'];
        // dd($_POST);
        if ($this->request->getVar('submit')=='edit') {
            # code...
        
            if ( $this->request->getVar('posisi') == 'Product Backlog') {
                $sprint = null ;
            }
            else {
                $sprint = $this->sprintModel->getLastSprintbyProject($id_project)['id_sprint'];
            }

            if(!$this->validate([
                'isi'.$id_backlog => ['rules'=>'required',
                                            'errors'=>[ 'required'=> 'Isi Backlog Harus diisi']
                                                        ]
            ]) ) {
               
                return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
            }
            $this->backlogModel->save([
                
                'id_backlog'        => $id_backlog,
                'isi'            => $this->request->getVar('isi'.$id_backlog),
                'sprint'        => $sprint,
                'point'      => $this->request->getVar('point')
                ]);
        }
        else {
            $this->backlogModel->delete($id_backlog);
        }
        return redirect()->to(base_url('/proyek/'.$id_project.'/board'));
    }
    public function createbacklog()
    {
        $id_project = $this->request->getVar('id_project');
        if(!$this->validate([
            'isi' => ['rules'=>'required',
                                        'errors'=>[ 'required'=> 'Isi Backlog Harus diisi']
                                                    ]
		]) ) {
			
			return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
        }

        $this->backlogModel->save([
            'isi'            => $this->request->getVar('isi'),
            'id_project'     => $id_project,
            'point'      => $this->request->getVar('point')
            ]);
        return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
    }
    public function editgoal($id_sprint)
    {
        $id_project = $this->sprintModel->getSprintbyId($id_sprint)['id_project'];
        // d($id_project);
        // dd($_POST);
        $this->sprintModel->save([
            'id_sprint'     => $id_sprint,
            'goal'      => $this->request->getVar('goal'.$id_sprint)
            ]);
        return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
    }
    public function editepic($id_epic)
    {
        $id_project = $this->epicModel->getEpicbyId($id_epic)['id_project'];
        // d($_POST);
        // dd($id_project);
        
        if ($this->request->getVar('submit')=='edit') {
            # code...
        

            if(!$this->validate([
                'isi'.$id_epic => ['rules'=>'required',
                                            'errors'=>[ 'required'=> 'Isi Epic Harus diisi']
                                                        ]
            ]) ) {
               
                return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
            }
            $this->epicModel->save([
                
                'id_epic'       => $id_epic,
                'isi'           => $this->request->getVar('isi'.$id_epic),
                'status'        => $this->request->getVar('status'.$id_epic),
                'elapsed'       => $this->request->getVar('elapsed'.$id_epic),
                'estimated'     => $this->request->getVar('estimated'.$id_epic),
                ]);
        }
        else {
            $this->backlogModel->delete($id_backlog);
        }
        return redirect()->to(base_url('/proyek/'.$id_project.'/board'));
    }
    public function createepic()
    {
        // dd($_POST);
        $id_sprint =  $this->request->getVar('id_sprint');
        $id_project = $this->sprintModel->getSprintbyId($id_sprint)['id_project'];
        
        if(!$this->validate([
            'isi' => ['rules'=>'required',
                                        'errors'=>[ 'required'=> 'Isi Epic Harus diisi']
                                                    ]
		]) ) {
			
			return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
        }

        $this->epicModel->save([
            'isi'            => $this->request->getVar('isi'),
            'status'        => 'TO DO',
            'id_sprint'     => $id_sprint,
            'estimated'      => $this->request->getVar('estimated')
            ]);
        return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
    }

}