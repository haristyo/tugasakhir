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

}
