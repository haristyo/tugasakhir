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
		echo view('header1',$title);
		echo ("ini tampilan home");
		echo view('footer1');
	}
	public function aboutus()
	{
		$title = [
			'title' => 'About Us | Scrum Tool',
			'link' => 	$this->request->uri->getSegment(1)
		];
	// dd($this->request->uri->getSegment(1));
		echo view('header1',$title);
		echo ("ini tampilan About US");
		echo view('footer1');
	}
}
