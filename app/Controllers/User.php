<?php

namespace App\Controllers;
use App\Models\UserModel;
class User extends BaseController
{
	protected $userModel;
	protected $session;
	public function __construct()
	{
		$this->userModel = new UserModel();
		$this->session = \Config\Services::session();
		// if (!isset($_SESSION['last'])) {
		// 	$_SESSION['last'] = "";
		// };
	}
	public function login()
	{
        $title = [
			'title' => 'Masuk | Scrum Tool',
			'link' => 	$this->request->uri->getSegment(1)
		];
		$data = [
			'validation' =>  \Config\Services::validation()
		];
		echo view('header1_v',$title);
        echo view('login_v',$data);
		echo view('footer1_v');
        
    }
	public function auth(){
		// $last =;
		$username = $this->request->getVar('useremail');
		$password = $this->request->getVar('password');
		$data = esc($this->userModel->where('username',$username)->first());
		if ($data == null) {
			$data = esc($this->userModel->where('email',$username)->first());
		}
		// dd($data);
		// dd($_SESSION['last']);
		
		if ($username =="" || $password =="") {
			$this->session->setFlashdata('pesan', 'Username dan Password Wajib diisi');
			return redirect()->to(base_url('login'))->withInput();
		}
		else {
			if($data){
				$pass = $data['password'];
				$verify_pass = (password_verify($password,$pass));
				
				// dd($verify_pass);
				if ($verify_pass) {
					$sess_data = [
					'id_user' => $data['id_user'],
					'is_admin' => $data['is_admin'],
					'username' => $data['username'],
					'profil' => $data['foto_profile'],
					'logged_in'=> TRUE
					];
					$this->session->set($sess_data);
					
					// dd($_SESSION['last']);
						if ($data['is_admin'] == 'N') {
							return redirect()->to( base_url('proyek'));
						}
						else {
							return redirect()->to( base_url('dashboard'));
						}
	
				}
				else {
					$this->session->setFlashdata('pesan', 'Password salah');
					return redirect()->to(base_url('login'))->withInput();
				}
			}
			else {
				$this->session->setFlashdata('pesan', 'Username / Email Tidak terdaftar');
				return redirect()->to(base_url('login'))->withInput();
			
			}
		}
	}
    public function register()
	{
        $title = [
			'title' => 'Daftar | Scrum Tool',
			'link' => 	$this->request->uri->getSegment(1)
        ];
        $data = [
            'validation' =>  \Config\Services::validation()
		];
		echo view('header1_v',$title);
        echo view('register_v',$data);
		echo view('footer1_v');
        
    }
    
    public function addUser()
	{
		if(!$this->validate([
			'username' => ['rules'=>'required|is_unique[user.username]',
						'errors'=>[ 'required'=>  'Nama User Harus diisi',
									'is_unique'=> 'Nama User telah digunakan']
					   ],
			'nama_user' => ['rules'=>'required',
						'errors'=>[ 'required'=>  'Nama Lengkap Harus diisi']
					   ],
            'email' => ['rules'=>'required|is_unique[user.email]',
                        'errors'=>[ 'required'=> 'Alamat Surel Harus diisi',
                                    'is_unique'=>'Alamat Surel Pernah digunakan']
                        ],
			'password1' => ['rules'=>'required|min_length[8]',
							 'errors'=>[ 'required'=>  'Kata Sandi wajib diisi',
							 			'min_length'=> 'Kata Sandi minimal 8 karakter']

                              ],
			'password2' => ['rules'=> 'required|matches[password1]',
							 'errors'=>[ 'required'=>  'Kata Sandi wajib diisi',
							 			'matches'=> 'Kata Sandi Harus sama']

                              ],
            'sk' => ['rules'=> 'required',
							 'errors'=>[ 'required'=>  'Harus Menyetujui Syarat dan ketentuan yang berlaku']
                              ],
                               
                               
		])) {
			// $validation = \Config\Services::validation();
			// return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
			return redirect()->to(base_url('/register/'))->withInput();
		}
		
		$this->userModel->save([
			'username' 		=> $this->request->getVar('username'),
			'nama_user'  	=> $this->request->getVar('nama_user'),
			'email'     	=> $this->request->getVar('email'),
            'password' 		=>  password_hash($this->request->getVar('password2'),PASSWORD_DEFAULT),
            'is_admin'     	=> 'N'
				
		]);
		session()->setFlashdata('pesan', 'User Berhasil Ditambahkan.');
		return redirect()->to(base_url('/login'));
	}
	public function logout()
    {
		session()->destroy();
		// session()->setFlashdata('pesan', 'Anda telah logout.');
		return redirect()->to(base_url('/login'));
        
	}
	public function profil()
    {
			$title = [
				'title' => 'Profil Saya | Scrum Tool',
				'link' => 	$this->request->uri->getSegment(1)
			];
			$id= $_SESSION['id_user'];
			$data = [ 
				'profil' => $this->userModel->where('id_user',$id)->first()
			];
			// dd($data);
			echo view('header1_v',$title);
			echo view('profil_v',$data);
			// echo view('login_v');
			echo view('footer1_v');
		}
	public function edit()
    {
		
		
			$id= $this->session->id_user;
			$title = [
				'title' => 'Edit Profil | Scrum Tool',
				'link' => 	$this->request->uri->getSegment(1)
			];
			$data = [ 
				'profil' => esc($this->userModel->where('id_user',$id)->first()),
				'validation' =>  \Config\Services::validation(),
				'back' => $_SESSION['_ci_previous_url']
			];
			//  dd( base_url('/user/update'));
			echo view('header1_v',$title);
			echo view('editprofil_v',$data);
			echo view('footer1_v');
        
	}
	public function update()
	{
		if(!$this->validate([
			'username' => ['rules'=>'required|is_unique[user.username,id_user,{id_user}]',
						'errors'=>[ 'required'=>  'Nama User Harus diisi',
									'is_unique'=> 'Nama User telah digunakan']
								],
			'nama_user' => ['rules'=>'required',
						'errors'=>[ 'required'=>  'Nama Lengkap Harus diisi']
					   ],
            'email' => ['rules'=>'required|is_unique[user.email,id_user,{id_user}]',
                        'errors'=>[ 'required'=> 'Alamat Surel Harus diisi',
                                    'is_unique'=>'Alamat Surel Pernah digunakan']
								],
			'password' => ['rules'=>'required|min_length[8]',
							 'errors'=>[ 'required'=>  'Kata Sandi wajib diisi',
										 'min_length'=> 'Kata Sandi minimal 8 karakter']
                              ],
			'foto_profile' =>['rules'=>'is_image[foto_profile]|mime_in[foto_profile,image/jpg,image/jpeg,image/png]',
			'errors'=>[  'is_image'	=> 'File harus berupa gambar',
										   'mime_in'	=> 'File berformat jpg/jpeg/png']
							]
                               
                               
		])) {
			// $validation = \Config\Services::validation();
			// return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
			return redirect()->to(base_url('/profil/edit'))->withInput();
		}
	// dd($this->request->getFile('foto_profile'));
	$data = esc($this->userModel->where('id_user',$this->request->getVar('id_user'))->first());
	if (password_verify($this->request->getVar('password'),$data['password'])) {
			
			$foto_profile = $this->request->getFile('foto_profile');
			if ($foto_profile->getError() == 4){
				$nama_foto_profile = $this->request->getVar('foto_profile_old');
			}
			else {
				$nama_foto_profile = $foto_profile->getRandomName();
				$foto_profile->move('img/profil/', $nama_foto_profile);
			}
			// dd($nama_foto_profile);
			$id_user = $this->request->getVar('id_user');
			
			$this->userModel->save([
				'id_user'		=> $id_user,
				'username' 		=> $this->request->getVar('username'),
				'nama_user'  	=> $this->request->getVar('nama_user'),
				'email'     	=> $this->request->getVar('email'),
				'foto_profile' 	=> $nama_foto_profile
				]);
				return redirect()->to(base_url('profil'));
		}
		else { 
			session()->setFlashdata('password', 'Password Salah');
			return redirect()->to(base_url('/profil/edit'))->withInput();
		}
	}

	public function gantipassword(){
	
		$title = [
			'title' => 'Ganti Kata Sandi | Scrum Tool',
			'link' => 	$this->request->uri->getSegment(1)
		];
		$id= $this->session->id_user;
		$data = [
			'profil' => esc($this->userModel->where('id_user',$id)->first()),
			'validation' =>  \Config\Services::validation()
		];
		echo view('header1_v',$title);
        echo view('gantipassword_v',$data);
		echo view('footer1_v');
		
	}
	public function updatepassword()
	{
		if(!$this->validate([

			'password' => ['rules'=>'required|min_length[8]',
							 'errors'=>[ 'required'=>  'Kata Sandi wajib diisi',
							 'min_length'=> 'Kata Sandi minimal 8 karakter']
							  ],
			'password1' => ['rules'=>'required|min_length[8]',
							  'errors'=>[ 'required'=>  'Kata Sandi wajib diisi',
										  'min_length'=> 'Kata Sandi minimal 8 karakter']
 
							   ],
			 'password2' => ['rules'=> 'required|matches[password1]',
							  'errors'=>[ 'required'=>  'Kata Sandi wajib diisi',
							  'matches'=> 'Kata Sandi Harus sama']
							],
		]
                               
                               
		)) {
			// $validation = \Config\Services::validation();
			// return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
			return redirect()->to(base_url('/user/gantipassword'))->withInput();
		}
		$data = esc($this->userModel->where('id_user',$this->request->getVar('id_user'))->first());
		if (password_verify($this->request->getVar('password'),$data['password'])) {
			$this->userModel->save([
				'id_user' 		=> $this->request->getVar('id_user'),
				'password' 		=> password_hash($this->request->getVar('password2'),PASSWORD_DEFAULT)
				
				]);
			session()->setFlashdata('pesan', 'Password Berhasil diganti, silahkan login kembali');
			return redirect()->to(base_url('/logout'));
		}
		else { 
			session()->setFlashdata('password', 'Password Lama Salah');
			return redirect()->to(base_url('/profil/gantipassword'))->withInput();
		}
	}
	
	public function registerAdmin()
	{
		$title = [
			'title' => 'Register Admin | Scrum Tool',
			'link' => 	$this->request->uri->getSegment(1)
		];
		$data = [
			'validation' =>  \Config\Services::validation(),
			'user' => esc($this->userModel->getDetailbyId($this->session->id_user)),
		];
		echo view('header1_v',$title);
		echo view('sidebar_admin',$data);
		echo view('registeradmin_v',$data);
		echo view('footer1_v');
		
	}

	public function addAdmin()
	{
		if(!$this->validate([
			'username' => ['rules'=>'required|is_unique[user.username]',
						'errors'=>[ 'required'=>  'Nama User Harus diisi',
									'is_unique'=> 'Nama User telah digunakan']
					],
			'nama_user' => ['rules'=>'required',
						'errors'=>[ 'required'=>  'Nama Lengkap Harus diisi']
					],
			'email' => ['rules'=>'required|is_unique[user.email]',
						'errors'=>[ 'required'=> 'Alamat Surel Harus diisi',
									'is_unique'=>'Alamat Surel Pernah digunakan']
						],
			'password1' => ['rules'=>'required|min_length[8]',
							'errors'=>[ 'required'=>  'Kata Sandi wajib diisi',
										'min_length'=> 'Kata Sandi minimal 8 karakter']

							],
			'password2' => ['rules'=> 'required|matches[password1]',
							'errors'=>[ 'required'=>  'Kata Sandi wajib diisi',
										'matches'=> 'Kata Sandi Harus sama']

							],
			'sk' => ['rules'=> 'required',
							'errors'=>[ 'required'=>  'Harus Menyetujui Syarat dan ketentuan yang berlaku']
							],
							
							
		])) {
			// $validation = \Config\Services::validation();
			// return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
			return redirect()->to(base_url('/registeradmin/'))->withInput();
		}
		$this->userModel->save([
			'username' 		=> $this->request->getVar('username'),
			'nama_user'  	=> $this->request->getVar('nama_user'),
			'email'     	=> $this->request->getVar('email'),
            'password' 		=> password_hash($this->request->getVar('password2'),PASSWORD_DEFAULT),
            'is_admin'     	=> 'Y'
				
		]);
		session()->setFlashdata('pesan', 'User Berhasil Ditambahkan.');
		return redirect()->to(base_url('/login'));
	}
}