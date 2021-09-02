<?php

namespace App\Controllers;

class Student extends BaseController
{
	public function index() {
		echo view('student/templates/header');
		echo view('student/templates/topbar');
		echo view('student/home');
		echo view('student/templates/footer');
	}

	public function home() {		
		echo view('student/templates/header');
		echo view('student/templates/topbar');
		echo view('student/home');
		echo view('student/templates/footer');
	}

	public function about() {		
		echo view('student/templates/header');
		echo view('student/templates/topbar');
		echo view('student/about');
		echo view('student/templates/footer');
	}
}