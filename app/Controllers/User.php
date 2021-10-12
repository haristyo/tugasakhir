<?php

namespace App\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Models\UserModel;
use App\Models\ResetModel;

class User extends BaseController
{
	protected $userModel;
	protected $resetModel;
	protected $session;
	public function __construct()
	{
		$this->mail = new PHPMailer(true);
		helper('text');
		$this->userModel = new UserModel();
		$this->resetModel = new ResetModel();
		$this->session = \Config\Services::session();
		// if (!isset($_SESSION['last'])) {
		// 	$_SESSION['last'] = "";
		// };
		if ($this->userModel->getSuperAdmin() == null){
			$this->userModel->save([
				'username' 		=> 'superadmin',
				'nama_user'  	=> 'Superadmin ScrumTool',
				'email'     	=> 'scrum.tool55@gmail.com',
				'password' 		=>  password_hash('ScrumTool2021',PASSWORD_DEFAULT),
				'is_admin'     	=> 'S'
			]);
		}
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
			'username' => ['rules'=>'required|is_unique[user.username]|max_length[32]',
						'errors'=>[ 'required'=>  'Nama User Harus diisi',
									'is_unique'=> 'Nama User telah digunakan',
									'max_length'=> 'Maksimal 32 karakter']
					   ],
			'nama_user' => ['rules'=>'required|max_length[32]',
						'errors'=>[ 'required'=>  'Nama Lengkap Harus diisi',
									'max_length'=> 'Maksimal 50 karakter']
					   ],
            'email' => ['rules'=>'required|is_unique[user.email]|ipbemail|valid_email',
                        'errors'=>[ 'required'=> 'Alamat Surel Harus diisi',
									'ipbemail'=>'Alamat Surel Bukan alamat email ipb',
                                    'is_unique'=>'Alamat Surel Pernah digunakan',
                                    'valid_email'=>'Alamat Surel Tidak Valid',
									]
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
		
		// $this->userModel->save([
		// 	'username' 		=> $this->request->getVar('username'),
		// 	'nama_user'  	=> $this->request->getVar('nama_user'),
		// 	'email'     	=> $this->request->getVar('email'),
        //     'password' 		=>  password_hash($this->request->getVar('password2'),PASSWORD_DEFAULT),
        //     'is_admin'     	=> 'N'
				
		// ]);
		$recepient = $this->request->getVar('email');
		// $email = \Config\Services::email();
		$message = "<p>Anda Berhasil melakukan pendaftaran akun</p>";
		$message .= "<a href='".base_url('login')."'>klik untuk login</a>";
		// $email->setFrom('scrum.tool55@gmail.com');
		// $email->setTo($recepient);
		// $email->setSubject("Anda berhasil mendaftarkan akun");
		// $email->setMessage($message);
		
		// $email->send();
		// 	if ($email->send()) {
		// 		# code...
		// 		session()->setFlashdata('pesan', 'User Berhasil Ditambahkan');
		// 	}
		// 	else {
		// 		# code...
		// 		session()->setFlashdata('pesan', 'Email gagal dikirim');
		// 	}
		// return redirect()->to(base_url('/login'));
		

        try {
            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $this->mail->isSMTP();
            $this->mail->Host       = 'smtp.googlemail.com';
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = 'scrum.tool55@gmail.com'; // ubah dengan alamat email Anda
            $this->mail->Password   = 'ScrumTool2021'; // ubah dengan password email Anda
            $this->mail->SMTPSecure = 'tls';
            $this->mail->Port       = 587;

            $this->mail->setFrom('scrum.tool55@gmail.com', 'Scrum Tool'); // ubah dengan alamat email Anda
            $this->mail->addAddress($recepient);
            $this->mail->addReplyTo('scrum.tool55@gmail.com', 'Scrum Tool'); // ubah dengan alamat email Anda

            // Isi Email
            $this->mail->isHTML(true);
            $this->mail->Subject = "Anda berhasil mendaftarkan akun";
            $this->mail->Body    = $message;

            $this->mail->send();


   // Pesan Berhasil Kirim Email/Pesan Error
			$this->userModel->save([
				'username' 		=> $this->request->getVar('username'),
				'nama_user'  	=> $this->request->getVar('nama_user'),
				'email'     	=> $this->request->getVar('email'),
				'password' 		=>  password_hash($this->request->getVar('password2'),PASSWORD_DEFAULT),
				'is_admin'     	=> 'N'
					
			]);
            session()->setFlashdata('pesan', 'User Berhasil Ditambahkan');
            return redirect()->to('/login');
        } catch (Exception $e) {
            session()->setFlashdata('pesan', "User gagal ditambahkan. Error: " . $this->mail->ErrorInfo);
            return redirect()->to('/login');
        }
    
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
		$data = esc($this->userModel->where('id_user',$this->request->getVar('id_user'))->first());
		if ($data['is_admin']=='N') {
			if(!$this->validate([
				'username' => ['rules'=>'required|is_unique[user.username,id_user,{id_user}]|max_length[32]',
							'errors'=>[ 'required'=>  'Nama User Harus diisi',
										'is_unique'=> 'Nama User telah digunakan',
										'max_length'=> 'Maksimal 32 karakter']
									],
				'nama_user' => ['rules'=>'required|max_length[50]',
							'errors'=>[ 'required'=>  'Nama Lengkap Harus diisi',
							'max_length'=> 'Maksimal 50 karakter']
						   ],
				'email' => ['rules'=>'required|is_unique[user.email,id_user,{id_user}]|ipbemail|valid_email',
							'errors'=>[ 'required'=> 'Alamat Surel Harus diisi',
										'is_unique'=>'Alamat Surel Pernah digunakan',
										'ipbemail'=>'Alamat Surel Bukan alamat email ipb',
										'valid_email'=>'Alamat Surel Tidak Valid',]
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
		}
		else {
			if(!$this->validate([
				'username' => ['rules'=>'required|is_unique[user.username,id_user,{id_user}]|max_length[32]',
							'errors'=>[ 'required'=>  'Nama User Harus diisi',
										'is_unique'=> 'Nama User telah digunakan',
										'max_length'=> 'Maksimal 32 karakter']
									],
				'nama_user' => ['rules'=>'required|max_length[50]',
							'errors'=>[ 'required'=>  'Nama Lengkap Harus diisi',
							'max_length'=> 'Maksimal 50 karakter']
						   ],
				'email' => ['rules'=>'required|is_unique[user.email,id_user,{id_user}]|valid_email',
							'errors'=>[ 'required'=> 'Alamat Surel Harus diisi',
										'is_unique'=>'Alamat Surel Pernah digunakan',
										'valid_email'=>'Alamat Surel Tidak Valid',]
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
		}
		
	// dd($this->request->getFile('foto_profile'));
	
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
			'link' => 	$this->request->uri->getSegment(2)
		];
		echo view('header1_v',$title);
		echo view('sidebar_admin',$data);
		echo view('registeradmin_v',$data);
		echo view('footer1_v');
		
	}

	public function addAdmin()
	{
		if(!$this->validate([
			'username' => ['rules'=>'required|is_unique[user.username]|max_length[32]',
						'errors'=>[ 'required'=>  'Nama User Harus diisi',
									'is_unique'=> 'Nama User telah digunakan',
									'max_length'=> 'Maksimal 32 karakter' ]
					],
			'nama_user' => ['rules'=>'required|max_length[50]',
						'errors'=>[ 'required'=>  'Nama Lengkap Harus diisi',
						'max_length'=> 'Maksimal 50 karakter']
					],
			'email' => ['rules'=>'required|is_unique[user.email]|ipbemail|valid_email',
						'errors'=>[ 'required'=> 'Alamat Surel Harus diisi',
									'is_unique'=>'Alamat Surel Pernah digunakan',
                                    'ipbemail'=>'Alamat Surel Bukan alamat email ipb',
                                    'valid_email'=>'Alamat Surel Tidak Valid'
									]
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
		session()->setFlashdata('pesan', 'User Berhasil Ditambahkan');
		return redirect()->to(base_url('/login'));
	}
	public function lupa_password()
	{
		$title = [
			'title' => 'Lupa Password | Scrum Tool',
			'link' => 	$this->request->uri->getSegment(1)
		];
		$data = [
			'validation' =>  \Config\Services::validation()
		];
		echo view('header1_v',$title);
        echo view('forgot_v',$data);
		echo view('footer1_v');
	}
	public function proses_lupa()
	{
		if ($this->request->getVar('csrf_test_name')) {
		// d($_POST);
		$username = $this->request->getVar('useremail');
		$password = $this->request->getVar('password');
		$data = esc($this->userModel->where('username',$username)->first());
		if ($data == null) {
			$data = esc($this->userModel->where('email',$username)->first());
		}
		if ($data == null) {
			session()->setFlashdata('pesan', 'Username/Email tidak terdaftar');
			return redirect()->to(base_url('/forgot_password'));
		}
		$this->resetModel->save([
			'id_user' => $data['id_user'],
			'token'=> random_string('alnum',50)
		]);
		$token = ($this->resetModel->getResetbyEmailUser($data['email'])['token']);
		$message = "<p>Anda melakukan permintaan atur ulang password</p>";
		$message .= "<a href='".base_url('resetpassword/'.$token)."'>klik untuk atur ulang password</a>";

		try {
            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $this->mail->isSMTP();
            $this->mail->Host       = 'smtp.googlemail.com';
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = 'scrum.tool55@gmail.com'; // ubah dengan alamat email Anda
            $this->mail->Password   = 'ScrumTool2021'; // ubah dengan password email Anda
            $this->mail->SMTPSecure = 'tls';
            $this->mail->Port       = 587;

            $this->mail->setFrom('scrum.tool55@gmail.com', 'Scrum Tool'); // ubah dengan alamat email Anda
            $this->mail->addAddress($data['email']);
            $this->mail->addReplyTo('scrum.tool55@gmail.com', 'Scrum Tool'); // ubah dengan alamat email Anda

            // Isi Email
            $this->mail->isHTML(true);
            $this->mail->Subject = "Permintaan Atur Ulang Kata Sandi";
            $this->mail->Body    = $message;

            $this->mail->send();


   // Pesan Berhasil Kirim Email/Pesan Error
			
			session()->setFlashdata('pesan', "Silahkan cek email anda");
			return redirect()->to(base_url('/login'));
        } catch (Exception $e) {
            session()->setFlashdata('pesan', "Gagal atur ulang password. Error: " . $this->mail->ErrorInfo);
            return redirect()->to('/forgot_password');
        }
		// $email = \Config\Services::email();

		// $email->setFrom('scrum.tool55@gmail.com');
		// $email->setTo($data['email']);
		// $email->setSubject("Atur Ulang Password");
		// $email->setMessage($message);
		
		// $email->send();
		// if($email->send())
		// {
		// 	session()->setFlashdata('pesan', "Silahkan cek email anda");
		// 	return redirect()->to(base_url('/login'));
		// }
		// else {
		// 	session()->setFlashdata('pesan', 'Gagal atur ulang password, masukan email yang benar');
		// 	return redirect()->to(base_url('/forgot_password'));
		// }
		// 
		// $token = ($this->resetModel->getResetbyEmailUser($data['email'])['token']);
		// // dd($token);
		// return redirect()->to(base_url('/resetpassword/'.$token));
		// return

		// dd($data['email']);

//langsung config email		
		}
	
	}

	public function resetpassword($token)
	{
		$title = [
			'title' => 'Lupa Password | Scrum Tool',
			'link' => 	$this->request->uri->getSegment(1)
		];
		$data = [
			'reset' => esc($this->resetModel->getResetbyToken($token)),
			'validation' =>  \Config\Services::validation()
		];
		if($this->resetModel->getResetbyToken($token) == null ) {
			session()->setFlashdata('pesan', 'Token tidak valid, ulangi kembali');
			return redirect()->to(base_url('/forgot_password'));
		}
		echo view('header1_v',$title);
        echo view('reset_v',$data);
		echo view('footer1_v');
	}
	public function prosesresetpassword($id_user)
	{
		if ($this->request->getVar('csrf_test_name')) {
			if(!$this->validate([
				
				'password1' => ['rules'=>'required|min_length[8]',
								 'errors'=>[ 'required'=>  'Kata Sandi wajib diisi',
											 'min_length'=> 'Kata Sandi minimal 8 karakter']
	
								  ],
				'password2' => ['rules'=> 'required|matches[password1]',
								 'errors'=>[ 'required'=>  'Kata Sandi wajib diisi',
											 'matches'=> 'Kata Sandi Harus sama']
								  ],

			])) {
				// $validation = \Config\Services::validation();
				// return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
				return redirect()->to(base_url('/register/'))->withInput();
			}
			
			$this->userModel->save([
				'id_user'		=> $id_user,
				'password' 		=>  password_hash($this->request->getVar('password2'),PASSWORD_DEFAULT)
			]);	
			$token = $this->resetModel->getResetbyToken($this->request->getVar('token'));
			// dd($token['id_reset']);
			$this->resetModel->delete($token['id_reset']);



		}
		session()->setFlashdata('pesan', "Password Berhasil di reset");
		return redirect()->to(base_url('/login'));
	}

}