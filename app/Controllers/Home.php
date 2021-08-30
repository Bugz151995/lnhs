<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		echo view('student/templates/header');
		echo view('student/templates/topbar');
		echo view('student/home');
		echo view('student/templates/footer');
	}
}
