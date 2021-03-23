<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function indexold()
	{
		return view('welcome_message');
	}
	public function index()
	{
		$title = [
			'title' => 'Home | Scrum Tool',
			'link' => 	$this->request->uri->getSegment(1)

		];
		echo view('header1_v',$title);
		echo view('index_v');
		echo view('footer1_v');
	}
	public function howto()
	{
		$title = [
			'title' => 'About Us | Scrum Tool',
			'link' => 	$this->request->uri->getSegment(1)
		];
	// dd($this->request->uri->getSegment(1));
		echo view('header1_v',$title);
		echo view('howto');
		echo view('footer1_v');
	}
}
