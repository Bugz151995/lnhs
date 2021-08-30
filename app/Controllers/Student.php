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

	public function view($page = NULL) {
		helper('form');
		if($page === NULL) {
			echo view('home');
		}

		echo view('student/templates/header');
		echo view('student/templates/topbar');
		echo view('student/'.$page);
		echo view('student/templates/footer');
	}
}