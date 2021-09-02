<?php

namespace App\Controllers;

class Registrar extends BaseController
{
	public function index() {
		return view('registrar/signin');
	}

	public function home() {
		echo view('registrar/templates/header');
		echo view('registrar/templates/sidebar');
		echo view('registrar/templates/topbar');
		echo view('registrar/dashboard');
		echo view('registrar/templates/footer');
	}

	public function auth($page = NULL) {
		helper('form');
		if($page === NULL) {
			echo view('registrar/dashboard');
		}

		echo view('registrar/'.$page);
	}

	public function view($page = NULL) {
		helper('form');
		if($page === NULL) {
			echo view('registrar/templates/header');
			echo view('registrar/templates/sidebar');
			echo view('registrar/templates/topbar');
			echo view('registrar/dashboard');
			echo view('registrar/templates/footer');
		}
		

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar');
		echo view('registrar/templates/topbar');
		echo view('registrar/'.$page);
    echo view('registrar/templates/footer');
	}
}
