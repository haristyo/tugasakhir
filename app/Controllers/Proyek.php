<?php

namespace App\Controllers;
use App\Models\ProjectModel;
use App\Models\MemberModel;
class Proyek extends BaseController
{
    protected $session;   
    protected $proyekModel;
    protected $memberModel;
    
	public function __construct()
	{
       
        $this->proyekModel = new ProjectModel();
        $this->memberModel = new MemberModel();
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
                'proyek' => $this->memberModel->getMemberbyUser($this->session->id_user)
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
    {
        if (!$this->request->getVar('kode_join')=="") {
            $data = esc($this->proyekModel->getProjectbyKode($this->request->getVar('kode_join')));
            $joined = $this->memberModel->getMemberbyUserProject($this->session->id_user ,$data['id_project']);
        //  dd($joined['id_member']);
        }
        // $joined = $this->memberModel->getMemberbyUserProject($this->session->id_user ,$data['id_project'])['id_member'];
        
        
		if(!$this->validate([
            'kode_join' => ['rules'=>'required|is_not_unique[project.kode_join]|min_length[4]|max_length[32]',
                        'errors'=>[ 'required'=> 'Kode Join Harus diisi',
                                    'is_unique'=>'Kode Gabung Tidak terdaftar',
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
		]) || !$data['password_project'] == $this->request->getVar('password_project') || !$joined==null) {
			// $validation = \Config\Services::validation();
            // return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
            if ($joined>0) { $this->session->setFlashdata('kode_join', 'Anda Telah bergabung dengan Proyek ini');}
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
			'member' => esc($this->memberModel->getMemberDetailbyUserProject($this->session->id_user,$id_project))
		];
        $title = ['title' => 'Detail Project | Scrum Tool',
        'link' => 	$this->request->uri->getSegment(1)];
		// dd($data);
        echo view('header1_v',$title);
        
		echo view('sidebar',$data);
		// echo view('detailproyek_v',$data);
		echo view('footer1_v');
    }

    public function meeting($id_meeting)
    {
        # code...
    }
    public function presensi($id_meeting)
    {
        # code...
    }
}