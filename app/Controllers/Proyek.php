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
use App\Models\NotesModel;
use App\Models\LogModel;
use App\Models\FileModel;
use App\Models\CheckboxModel;
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
    protected $notesModel;
    protected $logModel;
    protected $fileModel;
    protected $checkboxModel;
    
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
        $this->logModel = new LogModel();
        $this->notesModel = new NotesModel();
        $this->fileModel = new FileModel();
        $this->checkboxModel = new CheckboxModel();
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
            'proyek' =>  esc($this->memberModel->getMemberbyUser($this->session->id_user)),
            'link' =>    $this->request->uri->getPath(),
            'user' => esc($this->userModel->getDetailbyId($this->session->id_user))
        ];
        // dd($data['user']['is_admin']);
            // dd($data);
            // echo ($this->memberModel->getMemberbyUserProject(1,1)['id_member']);
            // echo $data['memberuserproject']['id_member'];
            if ($data['user']['is_admin'] == "Y") {
                return redirect()->to(base_url('/dashboard'));
            }
            else {
            echo view('header1_v',$title);
            echo view('proyek_v',$data);
            echo view('footer1_v');
            }
    }
    public function create()
	{
        $title = [
            'title' => 'Proyek Saya | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1),
        ];
        $data = [
            'link' => 	$this->request->uri->getSegment(1),
            'validation' =>  \Config\Services::validation()
        ];
        echo view('header1_v',$title);
        echo view('createproyek_v',$data);
        echo view('footer1_v');
    }

    public function add()
	{
		if(!$this->validate([

			'nama_project' => ['rules'=>'required|max_length[50]',
						'errors'=>[ 'required'=>  'Nama Proyek Harus diisi',
                                    'max_length'=>'Nama Proyek maksimal 50 karakter']
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
    public function editproyek($id_project)
    {
        if ($this->proyekModel->getProject($id_project)['kode_join'] != $this->request->getVar('kode_join')) {
            
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
                return redirect()->to(base_url('/proyek/'.$id_project))->withInput();
            }
        } else {
            if(!$this->validate([

                'nama_project' => ['rules'=>'required',
                            'errors'=>[ 'required'=>  'Nama Proyek Harus diisi']
                        ],
                'password_project' => ['rules'=> 'required|min_length[4]|max_length[32]',
                                        'errors'=>[ 'required'=>  'Kata Sandi harus diisi',
                                        'min_length'=>'Kata Sandi minimal 4 karakter',
                                        'max_length'=>'Kata Sandi maksimal 32 karakter']
                            ],
                                
                                
            ])) {
                // $validation = \Config\Services::validation();
                // return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
                return redirect()->to(base_url('/proyek/'.$id_project))->withInput();
            }
        }
        if ($this->request->getVar('csrf_test_name')) {
            $this->proyekModel->save([
                'id_project'        => $id_project,
                'nama_project' 		=> $this->request->getVar('nama_project'),
                'kode_join'  	    => $this->request->getVar('kode_join'),
                'password_project'  => $this->request->getVar('password_project'),
                'deskripsi'     	=> $this->request->getVar('deskripsi')
            
            ]);
        }
        // return redirect()->to(base_url('/proyek/'.$data['id_project']));
        
		return redirect()->to(base_url('/proyek/'.$id_project));
    }

    public function join()
    {
        $title = [
            'title' => 'Bergabung | Scrum Tool',
            'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            'validation' =>  \Config\Services::validation(),
            'link' => 	$this->request->uri->getSegment(1)
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
        if ($this->request->getVar('csrf_test_name')) {
            $this->memberModel->save([
                'id_project'    => $data['id_project'],
                'id_user'       => $this->session->id_user,
                'position'      => $this->request->getVar('position')
            ]);
            }
        return redirect()->to(base_url('/proyek/'));
    }
    public function detail($id_project)
    {
        $data = [
			'project' => esc($this->proyekModel->getProjectCreator($id_project)),
            'member' => esc($this->memberModel->getMemberDetailbyUserProject($this->session->id_user,$id_project)),
            'link' =>    $this->request->uri->getPath(),
            'members' => esc($this->memberModel->getMemberbyProject($id_project)),
            'validation' =>  \Config\Services::validation(),
            'ishavescrummaster' => $this->memberModel->isHaveScrumMaster($id_project),
            'incomingmeeting' => $this->meetingModel->incomingmeeting($id_project),
            
		];
        $title = ['title' => 'Detail Project | Scrum Tool',
        'link' => 	$this->request->uri->getSegment(1)];
        // dd($data['members']);
        // dd($data);
        // d(date('Y-m-d H:i:s', time()));
        // dd($data['incomingmeeting']);
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
            'ishavescrummaster' => $this->memberModel->isHaveScrumMaster($id_project),
            
            'meetings'=>esc($meeting->paginate(10,'meeting')),
            'pager'=>esc($this->meetingModel->join('member','member.id_member=meeting.creator_meeting')->join('project','project.id_project=meeting.id_project')->where('meeting.id_project',$id_project)->orderBy('time_meeting', 'DESC')->pager),
            'page'=>esc($this->request->getVar('page_meeting')),
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
    public function after($time)
    {
        $now =date('Y-m-d\TH:i');
        // d($now);
        // d( $this->$time);
        if($now < $time){
            return TRUE;
        }else {
            # code...
            return FALSE;
        }
    }
    public function createmeeting($id_project)
    {
        
        // d($this->request->getVar('time_meeting'));
       
        if(!$this->validate([
            'link_meeting' => ['rules'=>'required',
                                'errors'=>[ 'required'=> 'Tautan Meeting Harus diisi']
                                ],
            'time_meeting' => ['rules'=>'required|after',
                                'errors'=>[ 'required'=> 'Waktu Meeting Harus diisi',
                                'after'=> 'Waktu Meeting Harus Lebih Besar dari sekarang']
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
    if ($this->request->getVar('csrf_test_name')) {
        $this->meetingModel->save([
                'id_project'        => $id_project,
                'creator_meeting'   => $this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member'],
                'agenda'            => $this->request->getVar('agenda'),
                'deskripsi_meeting' => $this->request->getVar('deskripsi_meeting'),
                'link_meeting'      => $this->request->getVar('link_meeting'),
                'time_meeting'      => $this->request->getVar('time_meeting')
                ]);
        }
        return redirect()->to(base_url('/proyek/'.$id_project.'/meeting'));
    }
    public function editmeeting($id_project,$id_meeting)
    {
        // dd($_POST);
        if(!$this->validate([
            'link_meeting'.$id_meeting => ['rules'=>'required',
                                        'errors'=>[ 'required'=> 'Tautan Meeting Harus diisi']
                                                    ],
            'time_meeting'.$id_meeting => ['rules'=>'required|after',
                                            'errors'=>[ 'required'=> 'Waktu Meeting Harus diisi',
                                            'after'=> 'Waktu Meeting Harus Lebih Besar dari sekarang']
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
        if ($this->request->getVar('csrf_test_name')) {
            $this->meetingModel->save([
                'id_meeting'        => $id_meeting,
                'agenda'            => $this->request->getVar('agenda'.$id_meeting),
                'deskripsi_meeting' => $this->request->getVar('deskripsi_meeting'.$id_meeting),
                'link_meeting'      => $this->request->getVar('link_meeting'.$id_meeting),
                'time_meeting'      => $this->request->getVar('time_meeting'.$id_meeting)
                ]);
        }
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
        if ($this->request->getVar('csrf_test_name')) {
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
            'ishavescrummaster' => $this->memberModel->isHaveScrumMaster($id_project),
            'incomingmeeting' => $this->meetingModel->incomingmeeting($id_project),
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
        if ($this->request->getVar('csrf_test_name')) {
            $this->memberModel->save([
                'id_member'    => $id_member,
                'left_at'      => date('Y-m-d H:i:s', time())
                ]);
        }
        return redirect()->to(base_url('/proyek/'.$id_project.'/presensi/'));
        
    }
    
    public function deleteMeeting($id_project,$id_meeting)
    {
        if ($this->request->getVar('csrf_test_name')) {
            $this->meetingModel->delete($id_meeting);
        }
        return redirect()->to(base_url('proyek/'.$id_project.'/meeting/'));
    }
    
    public function board($id_project)
	{ ;
        // dd(1*0);
        $title = [
                'title' => 'Papan Proyek | Scrum Tool',
                'link' => 	$this->request->uri->getSegment(1)
            ];
            $data = [
                'ishavescrummaster' => $this->memberModel->isHaveScrumMaster($id_project),
                'link' =>    $this->request->uri->getPath(),
                'member' => esc($this->memberModel->getMemberDetailbyUserProject($this->session->id_user,$id_project)),
                'backlog' => esc($this->backlogModel->getBacklogbyProject($id_project)),
                'sprint' => esc($this->sprintModel->getSprintbyProject($id_project)),
                'epic' => esc($this->epicModel->getEpicbyProject($id_project)),
                'count' => esc($this->epicModel->getCount($id_project)),
                'countdo' => esc($this->epicModel->getCountDo($id_project)),
                'countbacklog' => esc($this->backlogModel->getCount($id_project)),
                'note' => esc($this->notesModel->getNotesbyProject($id_project)),
                'totalsprint' => esc($this->sprintModel->totalSprint($id_project)),
                'log' => esc($this->logModel->getLogbyProject($id_project)),
                'checkbox' => $this->checkboxModel->getCheckboxbyProject($id_project),
                'checkboxall' => esc($this->checkboxModel->countAllByProject($id_project)),
                'checkboxchecked' => $this->checkboxModel->countCheckedByProject($id_project),
                'lastsprint' => $this->sprintModel->getLastSprintbyProject($id_project),
                'incomingmeeting' => $this->meetingModel->incomingmeeting($id_project),
                'validation' =>  \Config\Services::validation()

            ];
            // dd($data);
            // dd($data['lastsprint']);
            // d($data['checkboxall']);
            // dd($data['checkboxchecked']);
            //     d($this->epicModel->getEpicbyProject());
            
            // d($data['log']);
            // dd($data['countdo']);
            // dd($data['totalsprint']);
            if ($data['member'] == null)
            {
                return redirect()->to(base_url('/proyek/'));
            }
            else {
                echo view('header1_v',$title);
                echo view('sidebar',$data);
                echo view('boarddragrel_v',$data);
                // echo view('boarddrag_v',$data);
                // echo view('board_v',$data);
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
                'ishavescrummaster' => $this->memberModel->isHaveScrumMaster($id_project),
                'proyek' => esc($this->memberModel->getMemberbyUser($this->session->id_user)),
                'link' =>    $this->request->uri->getPath(),
                'member' => esc($this->memberModel->getMemberDetailbyUserProject($this->session->id_user,$id_project)),
                'file' => esc($this->fileModel->getFilebyProject($id_project)->paginate(20,'file')),
                'pager' => esc($this->fileModel->getFilebyProject($id_project)->pager),
                'incomingmeeting' => $this->meetingModel->incomingmeeting($id_project),
                'validation' =>  \Config\Services::validation()
                ];
            // d($data['validation']);
            // dd($data['file']);
            echo view('header1_v',$title);
            echo view('sidebar',$data);
            echo view('resource_v',$data);
            echo view('footer1_v');
    }
    public function createimage()
    {   
        // d($filename);
        // d($filerandomname);
        $id_project = $this->request->getVar('id_project');
        // dd($_POST);
        $file = $this->request->getFile('file');
        // $files = $this->request->getFile('files');
        // d($files);
        // d($file);
        // d($id_project);
        // d($this->session->id_user);
        // dd($this->memberModel->getIdbyUserProject($this->session->id_user, $id_project));
        if(!$this->validate([
			
			'file' =>['rules'=>'uploaded[file]|is_image[file]|mime_in[file,image/jpg,image/jpeg,image/png]|max_size[file,10240]',
			          'errors'=>[  'uploaded'   => 'Pilih file anda',
                                    'is_image'	=> 'File harus berupa gambar',
                                    'mime_in'	=> 'File harus berformat jpg/jpeg/png',
                                    'size'      => 'File lebih besar dari 10MB']
			         ]
		])) {
			// $validation = \Config\Services::validation();
			// return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
			return redirect()->to(base_url('/proyek/'.$id_project.'/resource'))->withInput();
        }
        
        $filename = $file->getName();
		$filerandomname = $file->getRandomName();

        $file->move('resource/'.$id_project, $filerandomname);
        if ($this->sprintModel->getLastSprintbyProject($id_project) == null) {
            $sprint = null;
        }
        else {
            $sprint = $this->sprintModel->getLastSprintbyProject($id_project)['id_sprint'];
        }
        if ($this->request->getVar('csrf_test_name')) {
            $this->fileModel->save([
                'id_project'    => $id_project,
                'nama_asli'  	=> $filename,
                'nama_file'     => $filerandomname,
                'type' 	        => 'gambar',
                'deskripsi_file'=> $this->request->getVar('deskripsi_file'),
                'uploader_file' => $this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member'],
                'sprint'        => $sprint
                ]);
        }
        return redirect()->to(base_url('/proyek/'.$id_project.'/resource'));
    }
    public function createdocument()
    {   
        

        // d($filename);
        // d($filerandomname);
        $id_project = $this->request->getVar('id_project');
        // dd($_POST);
        $file = $this->request->getFile('filedocument');
        // $files = $this->request->getFile('files');
        // d($files);
        // d($file);
        // d($id_project);
        // d($this->session->id_user);
        // dd($this->memberModel->getIdbyUserProject($this->session->id_user, $id_project));
        if(!$this->validate([
			
			'filedocument' =>['rules'=>'uploaded[filedocument]|ext_in[filedocument,doc,docx,ppt,pptx,xls,xlsx,pdf,txt]|max_size[filedocument,10240]',
			          'errors'=>[  'uploaded'   => 'Pilih file anda',
                                    'ext_in'	=> 'File harus berformat doc/docx/ppt/pptx/xls/xlsx/pdf/txt',
                                    'size'      => 'File lebih besar dari 10MB']
			         ]
		])) {
			// $validation = \Config\Services::validation();
			// return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
			return redirect()->to(base_url('/proyek/'.$id_project.'/resource'))->withInput();
        }
        
        $filename = $file->getName();
		$filerandomname = $file->getRandomName();

        $file->move('resource/'.$id_project, $filerandomname);
        if ($this->sprintModel->getLastSprintbyProject($id_project) == null) {
            $sprint = null;
        }
        else {
            $sprint = $this->sprintModel->getLastSprintbyProject($id_project)['id_sprint'];
        }
        if ($this->request->getVar('csrf_test_name')) {
            $this->fileModel->save([
                'id_project'    => $id_project,
                'nama_asli'  	=> $filename,
                'nama_file'     => $filerandomname,
                'type' 	        => 'dokumen',
                'deskripsi_file'=> $this->request->getVar('deskripsi_file'),
                'uploader_file' => $this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member'],
                'sprint'        => $sprint
                ]);
        }
        return redirect()->to(base_url('/proyek/'.$id_project.'/resource'));
    }
    public function createlink()
    {   
        // d($filename);
        // d($filerandomname);
        // d($this->request->getVar('csrf_test_name'));
        
        $id_project = $this->request->getVar('id_project');
        // $files = $this->request->getFile('files');
        // d($id_project);
        // d($this->session->id_user);
        // dd($this->memberModel->getIdbyUserProject($this->session->id_user, $id_project));
        if(!$this->validate([
			
			'link' => ['rules'=>'required',
            'errors'=>[ 'required'=> 'Tautan Harus diisi']
                        ],
		])) {
			// $validation = \Config\Services::validation();
			// return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
			return redirect()->to(base_url('/proyek/'.$id_project.'/resource'))->withInput();
        }
        
        if ($this->sprintModel->getLastSprintbyProject($id_project) == null) {
            $sprint = null;
        }
        else {
            $sprint = $this->sprintModel->getLastSprintbyProject($id_project)['id_sprint'];
        }
        if ($this->request->getVar('csrf_test_name')) {
            $this->fileModel->save([
                'id_project'    => $id_project,
                'nama_asli'  	=> $this->request->getVar('link'),
                'type' 	        => 'tautan',
                'deskripsi_file'=> $this->request->getVar('deskripsi_file'),
                'uploader_file' => $this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member'],
                'sprint'        => $sprint
                ]);
        }
        return redirect()->to(base_url('/proyek/'.$id_project.'/resource'));
    }
    public function deletefile($id_file)
    {   
        if ($this->request->getVar('csrf_test_name')) {
            # code...
        
            // dd($_POST);
            // dd($this->fileModel->getFilebyId($id_file));
            $id_project =  $this->fileModel->getFilebyId($id_file)['id_project'];
            $type =  $this->fileModel->getFilebyId($id_file)['type'];
            $file =  $this->fileModel->getFilebyId($id_file)['nama_file'];
            if ($type != 'link') {
                unlink('resource/'.$id_project.'/'.$file);
            }

            $this->fileModel->delete($id_file);
        }
        return redirect()->to(base_url('/proyek/'.$id_project.'/resource'));
    }

    public function editbacklog($id_backlog)
    {
        $id_project = $this->backlogModel->getBacklogbyId($id_backlog)['id_project'];
        // dd($_POST);
        if ($this->request->getVar('csrf_test_name')) {
            if ($this->request->getVar('submit')=='edit') {
                # code...
            
                if ( $this->request->getVar('posisi') == 'Product Backlog') {
                    $sprint = null ;
                }
                else {
                    $sprint = $this->sprintModel->getLastSprintbyProject($id_project)['id_sprint'];
                }

                if(!$this->validate([
                    'isibacklog'.$id_backlog => ['rules'=>'required',
                                                'errors'=>[ 'required'=> 'Isi Backlog Harus diisi']
                                                ]
                ]) ) {
                
                    return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
                }
                $this->backlogModel->save([
                    
                    'id_backlog'        => $id_backlog,
                    'isi'            => $this->request->getVar('isibacklog'.$id_backlog),
                    'sprint'        => $sprint,
                    'point'      => $this->request->getVar('point')
                    ]);
            }
            else {
                
                $this->backlogModel->delete($id_backlog);
            }
        }
        return redirect()->to(base_url('/proyek/'.$id_project.'/board'));
    }
    public function createbacklog()
    {
        $id_project = $this->request->getVar('id_project');
        if(!$this->validate([
            'isibacklog' => ['rules'=>'required',
                                        'errors'=>[ 'required'=> 'Isi Backlog Harus diisi']
                                                    ]
		]) ) {
			
			return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
        }
        $creator_backlog = ($this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member']);
        if ($this->request->getVar('csrf_test_name')) {
            $this->backlogModel->save([
                'isi'            => $this->request->getVar('isibacklog'),
                'id_project'     => $id_project,
                'point'          => $this->request->getVar('point'),
                'creator_backlog'=> $creator_backlog
                ]);
        }
        return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
    }
    public function editgoal($id_sprint)
    {
        $id_project = $this->sprintModel->getSprintbyId($id_sprint)['id_project'];
        // d($id_project);
        // dd($_POST);
        if ($this->request->getVar('csrf_test_name')) {
            $this->sprintModel->save([
                'id_sprint'     => $id_sprint,
                'goal'      => $this->request->getVar('goal'.$id_sprint)
                ]);
        }
        return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
    }
    public function editepic($id_epic)
    {
        $id_project = $this->epicModel->getEpicbyId($id_epic)['id_project'];

        // foreach ($this->request->getVar('checkbox') as $checkboxes) {
        //         d($checkboxes);
        // }
        // d($_POST);
        // dd($this->request->getVar('checkbox'));
        // dd($this->checkboxModel->getCheckboxbyEpic($id_epic));
        // dd($id_project);
    if ($this->request->getVar('csrf_test_name')) {
        if ($this->request->getVar('submit')=='edit') {

            if ($this->request->getVar('status'.$id_epic)=="DONE") {
                
                $progress = $this->request->getVar('elapsed'.$id_epic) - $this->epicModel->getEpicbyId($id_epic)['elapsed'];
                if ($progress!=0){
                    $this->logModel->save([
                
                        'id_epic'       => $id_epic,
                        'progress'      => $progress,
                        'id_member'     => $this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member'],
                        
                        ]);
                }
                else {
                    $this->logModel->save([
                
                        'id_epic'       => $id_epic,
                        'progress'      => $this->request->getVar('elapsed'.$id_epic),
                        'id_member'     => $this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member'],
                        
                        ]);
                }
            }
            elseif (($this->epicModel->getEpicbyId($id_epic)['status'] == "DONE") && ($this->epicModel->getEpicbyId($id_epic)['status'] != ($this->request->getVar('status'.$id_epic)))) {
                $this->logModel->save([
                
                    'id_epic'       => $id_epic,
                    'progress'      => -($this->request->getVar('elapsed'.$id_epic)),
                    'id_member'     => $this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member']
                    
                    ]);
                
            }
    

            if(!$this->validate([
                'isiepic'.$id_epic => ['rules'=>'required',
                                            'errors'=>[ 'required'=> 'Isi Epic Harus diisi']
                                                        ]
            ]) ) {
               
                return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
            }
            if ($this->request->getVar('elapsed'.$id_epic) > $this->request->getVar('estimated'.$id_epic) ) {
                $estimated = $this->request->getVar('elapsed'.$id_epic);
            }
            else {
                $estimated =  $this->request->getVar('estimated'.$id_epic);
            }
            
            $this->epicModel->save([
                
                'id_epic'       => $id_epic,
                'isi'           => $this->request->getVar('isiepic'.$id_epic),
                'status'        => $this->request->getVar('status'.$id_epic),
                'elapsed'       => $this->request->getVar('elapsed'.$id_epic),
                'estimated'     => $estimated
                ]);
            $selected = $this->request->getVar('checkbox');
            // d($selected)    ;
            $checkboxes = [];
            if ($this->checkboxModel->getCheckboxbyEpic($id_epic)!=null && $selected != null ) {
                # code...
                foreach ($this->checkboxModel->getCheckboxbyEpic($id_epic) as $checkbox) {
                    array_push($checkboxes, $checkbox['id_checkbox']);
                } ;
                // d($checkboxes);
                $nilai1 = (array_intersect($checkboxes, $selected));
                $nilai0 = (array_diff($checkboxes, $selected));
                // d($nilai1);
                // dd($nilai0);
                foreach ($nilai1 as $terpilih) {
                    $this->checkboxModel->save([
                        
                        'id_checkbox'       => $terpilih,
                        'value' => '1'
                        ]);
                    }
                    foreach ($nilai0 as $kosong) {
                        $this->checkboxModel->save([
                            
                            'id_checkbox'       => $kosong,
                            'value' => '0'
                            ]);
                        }
                        
                    }
                        // dd($_POST);
                        
                    }
                    else {
                
                $this->epicModel->delete($id_epic);
                
            }
    }
        return redirect()->to(base_url('/proyek/'.$id_project.'/board'));
    }
    public function createepic()
    {
        // dd($_POST);
        $id_sprint =  $this->request->getVar('id_sprint');
        $id_project = $this->sprintModel->getSprintbyId($id_sprint)['id_project'];
        
        if(!$this->validate([
            'isiepic' => ['rules'=>'required',
                      'errors'=>[ 'required'=> 'Isi Epic Harus diisi']
                     ]
		]) ) {
			
			return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
        }
        if ($this->request->getVar('csrf_test_name')) {
            $this->epicModel->save([
                'isi'       => $this->request->getVar('isiepic'),
                'status'    => 'TO DO',
                'id_sprint' => $id_sprint,
                'estimated' => $this->request->getVar('estimated'),
                'creator_epic'     => $this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member'],
                ]);
            }
        return redirect()->to(base_url('/proyek/'.$id_project.'/board'));
    }
    public function createsprint($id_project)
    {
        // dd($_POST);
        // dd($this->sprintModel->getLastSprintbyProject($id_project));
    
        if($this->sprintModel->getLastSprintbyProject($id_project) == null) {
            $this->sprintModel->save([
                'id_project'    => $id_project,
                
                ]); 
            $this->epicModel->save([
                'id_sprint' => $this->sprintModel->getLastSprintbyProject($id_project)['id_sprint'],
                'status'    => 'REVIEW'
            ]);
            $this->epicModel->save([
                'id_sprint' => $this->sprintModel->getLastSprintbyProject($id_project)['id_sprint'],
                'status'    => 'ANALYSIS'
            ]);
            $this->epicModel->save([
                'id_sprint' => $this->sprintModel->getLastSprintbyProject($id_project)['id_sprint'],
                'status'    => 'ACTION'
            ]);
        }
        elseif ($this->sprintModel->getLastSprintbyProject($id_project)['end_sprint'] !=null && $this->sprintModel->getLastSprintbyProject($id_project)['end_sprint'] < date('Y-m-d H:i:s', time()) ) {
            $this->sprintModel->save([
                'id_project'    => $id_project,
                
                ]); 
            $this->epicModel->save([
                'id_sprint' => $this->sprintModel->getLastSprintbyProject($id_project)['id_sprint'],
                'status'    => 'REVIEW'
            ]);
            $this->epicModel->save([
                'id_sprint' => $this->sprintModel->getLastSprintbyProject($id_project)['id_sprint'],
                'status'    => 'ANALYSIS'
            ]);
            $this->epicModel->save([
                'id_sprint' => $this->sprintModel->getLastSprintbyProject($id_project)['id_sprint'],
                'status'    => 'ACTION'
            ]);
        }
    
       
        return redirect()->to(base_url('/proyek/'.$id_project.'/board'));
    }
    public function endsprint($id_sprint)
    {
        $id_project = $this->sprintModel->getSprintbyId($id_sprint)['id_project'];
        if ($this->request->getVar('csrf_test_name')) {
            $this->sprintModel->save([
                'id_sprint'     => $id_sprint,
                'id_project'    => $id_project,
                'end_sprint'  => date('Y-m-d H:i:s', time()),
                ]);
            }
        return redirect()->to(base_url('/proyek/'.$id_project.'/board')); 
    }
    public function editnotes($id_notes)
    {
        // dd($_POST);
        $id_project = $this->notesModel->getNotesbyId($id_notes)['id_project'];
        // dd($_POST);
    if ($this->request->getVar('csrf_test_name')) {
        if ($this->request->getVar('submit')=='edit') {

            if(!$this->validate([
                'isinotesedit'.$id_notes => ['rules'=>'required',
                                    'errors'=>[ 'required'=> 'Isi Notes Harus diisi']
                                   ]
            ]) ) {
               
                return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
            }
            $this->notesModel->save([
                
                'id_notes'        => $id_notes,
                'isi'            => $this->request->getVar('isinotesedit'.$id_notes),
                'editor_notes'     => $this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member'],
                
                ]);
        }
        else {
            $this->notesModel->delete($id_notes);
        }
    }
        return redirect()->to(base_url('/proyek/'.$id_project.'/board'));
    }
    public function createNotes($sprint = false)
    {
        // dd($_POST);
        $id_project = $this->request->getVar('id_project');
        if ($this->request->getVar('csrf_test_name')) {
        if ($sprint != false ){
            if(!$this->validate([
                'isinotes'.$sprint => ['rules'=>'required',
                                    'errors'=>[ 'required'=> 'Isi Notes Harus diisi']
                                ]
            ]) ) {
            
                return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
            }
            $this->notesModel->save([
                'isi'            => $this->request->getVar('isinotes'.$sprint),
                'id_project' => $id_project,
                'sprint'        => $sprint,
                'creator_notes'     => $this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member'],
                'editor_notes'     => $this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member'],
                ]);
        }
        else {
            if(!$this->validate([
                'isinotes' => ['rules'=>'required',
                          'errors'=>[ 'required'=> 'Isi Notes Harus diisi']
                          ]
            ]) ) {
            return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
            }
            $this->notesModel->save([
                'isi'            => $this->request->getVar('isinotes'),
                'id_project' => $id_project,
                'creator_notes'     => $this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member'],
                'editor_notes'     => $this->memberModel->getIdbyUserProject($this->session->id_user, $id_project)['id_member'],
                ]);
        }
    }
        return redirect()->to(base_url('/proyek/'.$id_project.'/board'));
    }
    public function createCheckbox($id_epic)
    {
        // dd($_POST);
        $id_project = $this->epicModel->getEpicbyId($id_epic)['id_project'];
        if ($this->request->getVar('csrf_test_name')) {
            if(!$this->validate([
                'isicheckbox'.$id_epic => ['rules'=>'required',
                                             'errors'=>[ 'required'=> 'Isi Checkbox Harus diisi']
                          ]
            ]) ) {
                return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
            }
            $this->checkboxModel->save([
                'id_epic'    => $id_epic,
                'isi' =>  $this->request->getVar('isicheckbox'.$id_epic)
                ]);
            }
        $this->session->setFlashData('epic', $id_epic);
        return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();
    }
    public function deleteCheckbox($id_checkbox)
    {   $id_project = $this->checkboxModel->getCheckboxbyId($id_checkbox)['id_project'];
        $id_epic = $this->checkboxModel->getCheckboxbyId($id_checkbox)['id_epic'];
        $this->session->setFlashData('epic', $id_epic);
        $this->checkboxModel->delete($id_checkbox);
        return redirect()->to(base_url('/proyek/'.$id_project.'/board'))->withInput();

    }
    public function editdragepic(Type $var = null)
    {
        $this->epicModel->save([
            'id_epic'    => $this->request->getVar('id_epic'),
            'status'     => $this->request->getVar('status')
            ]);
            dd($_POST);
    }
    public function editdragbacklog(Type $var = null)
    {
        if($this->request->getVar('sprint')=='product') { $sprint = null;} else {
            $sprint = $this->request->getVar('sprint');
        }
        $this->backlogModel->save([
            'id_backlog'    => $this->request->getVar('id_backlog'),
            'sprint'     => $sprint
            ]);
            dd($_POST);
    }
}