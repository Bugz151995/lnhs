<?php

namespace App\Controllers;

class Student extends BaseController
{
	public function index() {
		echo view('templates/header');
		echo view('templates/topbar');
		echo view('home');
		echo view('templates/footer');
	}

	public function view($page = NULL) {
		helper('form');
		if($page === NULL) {
			echo view('home');
		}

		echo view('templates/header');
		echo view('templates/topbar');
		echo view(''.$page);
		echo view('templates/footer');
	}
}