<?php

namespace App\Controllers;

class User extends BaseController
{
	public function login()
	{
        $title = [
			'title' => 'Login | Scrum Tool',
			'link' => 	$this->request->uri->getSegment(1)
		];
		echo view('header1',$title);
		echo ("ini tampilan Login");
		echo view('footer1');
        
    }

    public function register()
	{
        $title = [
			'title' => 'Register | Scrum Tool',
			'link' => 	$this->request->uri->getSegment(1)
		];
		echo view('header1',$title);
		echo ("ini tampilan Register");
		echo view('footer1');
        
	}

}
