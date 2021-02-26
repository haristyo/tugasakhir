<?php

namespace App\Controllers;
use App\Models\UserModel;
class User extends BaseController
{
    protected $userModel;
	public function __construct()
	{
		$this->userModel = new UserModel();
		// if (!isset($_SESSION['last'])) {
		// 	$_SESSION['last'] = "";
		// };
	}
	public function login()
	{
        $title = [
			'title' => 'Login | Scrum Tool',
			'link' => 	$this->request->uri->getSegment(1)
		];
		echo view('header1_v',$title);
        echo view('login_v');
		echo view('footer1_v');
        
    }

    public function register()
	{
        $title = [
			'title' => 'Register | Scrum Tool',
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
            'is_admin'     	=> $this->request->getVar('is_admin')
				
		]);
		session()->setFlashdata('pesan', 'User Berhasil Ditambahkan.');
		return redirect()->to(base_url('/login'));
	}
	public function logout()
    {
		session()->destroy();
		session()->setFlashdata('pesan', 'Anda telah logout.');
		return redirect()->to(base_url('/login'));
        
    }

}
