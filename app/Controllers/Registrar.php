<?php

namespace App\Controllers;

use \App\Models\RegistrarModel;
use \App\Models\EnrollmentModel;
use \App\Models\EscGrantModel;
use CodeIgniter\I18n\Time;

class Registrar extends BaseController {
	public function index() {
		helper(['form', 'url']);
		return view('registrar/signin');
	}

	public function home() {
		$r = new RegistrarModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();
		$myTime = new Time('now', 'Asia/Manila', 'en_US');
		
		$data = [	
			'user'    => $r->find(session()->get('registrar')),				
			'notif_e' => $en->select('*')
									    ->where(['status' => 'pending'])
											->orderBy('submitted_at', 'DESC')
											->limit(5)
									    ->get()->getResultArray(),					 
			'notif_g' => $esc->select('*')
											 ->orderBy('assessed_at', 'DESC')
											 ->limit(5)
											 ->where(['status' => 'pending'])
											 ->get()->getResultArray(),	
			'e_n'     => $en->selectCount('enrollment_id', 'e')
									    ->where(['status' => 'pending'])
									    ->orderBy('submitted_at', 'DESC')
									    ->get()->getRowArray(),											 
			'g_n'     => $esc->selectCount('esc_grant_id', 'g')
									     ->where(['status' => 'pending'])
									     ->orderBy('assessed_at', 'DESC')
									     ->get()->getRowArray(),		

			'enrolled' => $en->selectCount('enrollment_id')
											 ->where(['status' => 'approved'])
											 ->like(['submitted_at' => $myTime->getYear()])
											 ->get()->getRowArray(),
			'approved' => $en->selectCount('enrollment_id', 'approved')
											 ->select('acad_year')
											 ->groupBy(['acad_year', 'status'])
											 ->where(['status' => 'approved'])
											 ->get()->getResultArray(),											 
			'esc_grant' => $esc->selectCount('esc_grant_id', 'approved')
											   ->select('acad_year')
											   ->groupBy(['acad_year', 'status'])
											   ->where(['status' => 'approved'])
											   ->get()->getResultArray(),												 
			'e_strand' => $en->selectCount('enrollment_id', 'approved')
											 ->select('acad_year')
											 ->select('strand_name')
											 ->join('courses', 'courses.course_id = enrollments.course_id')
											 ->join('strands', 'courses.strand_id = strands.strand_id')
											 ->groupBy(['acad_year', 'status', 'enrollments.course_id'])
											 ->where(['status' => 'approved'])
											 ->get()->getResultArray(),		
			'grants'   => $esc->selectCount('esc_grant_id')
												->where(['status' => 'approved'])
											  ->like(['assessed_at' => $myTime->getYear()])
											  ->get()->getRowArray(),
		];
		echo view('registrar/templates/header');
		echo view('registrar/templates/sidebar', $data);
		echo view('registrar/templates/topbar');
		echo view('registrar/dashboard');
		echo view('registrar/templates/footer');
	}

	public function signup() {
		helper(['form', 'url']);
		return view('registrar/signup');
	}

	public function signout() {
		session()->destroy();
		return redirect()->to('r');
	}

	public function auth() {
		helper(['form', 'url']);
		$r_model = new RegistrarModel();

		$password = $this->request->getPost('ps');

		$query = $r_model->select('*')
										 ->where('username', esc($this->request->getPost('un')))
										 ->where('isapproved', '1')
										 ->get()
										 ->getResult();

		if(count($query) > 0) {
			if(password_verify($password, $query[0]->password)) {
				session()->set('registrar', $query[0]->registrar_id);
				session()->set('islogged_in', true);
				session()->setFlashData('info', 'Welcome back '.$query[0]->firstname.'!');
				return redirect()->to('r/dashboard');
			} else {
				session()->setFlashData('error', 'Wrong Username or Password');
				return redirect()->to('r');
			}
		} else {
			session()->setFlashData('error', 'Access denied!');
			return redirect()->to('r');
		}
	}

	public function request() {
		helper(['form', 'url']);
		$registrar_model = new RegistrarModel();

		$data = [
			'firstname'      => esc($this->request->getPost('fname')),
			'lastname'       => esc($this->request->getPost('lname')),
			'middlename'     => esc($this->request->getPost('mname')),
			'email'          => esc($this->request->getPost('em')),
			'contact_number' => esc($this->request->getPost('cn')),
			'username'       => esc($this->request->getPost('uname')),
			'password'       => password_hash($this->request->getPost('ps'), PASSWORD_DEFAULT),
		];

		$rules = [
			'fname' => [
				'label' => 'First Name',
				'rules' => 'required'
			],
			'lname' => [
				'label' => 'Last Name',
				'rules' => 'required'
			],
			'mname' => [
				'label' => 'Middle Name',
				'rules' => 'required'
			],
			'em' => [
				'label' => 'Email',
				'rules' => 'required|valid_email'
			],
			'cn' => [
				'label' => 'Contact Number',
				'rules' => 'required|min_length[11]|max_length[13]|integer'
			],
			'uname' => [
				'label' => 'Username',
				'rules' => 'required|is_unique[registrar.username]'
			],
			'ps' => [
				'label' => 'Password',
				'rules' => 'required'
			],
			'psc' => [
				'label' => 'Password Confirmation',
				'rules' => 'required|matches[ps]'
			]
		];

		if(!$this->validate($rules)) {			
			echo view('registrar/signup', ['validation' => $this->validator]);
		} else {
			session()->setFlashData('success', 'Your account request in now being processed. Please wait for the confirmation from the admin.');
			$registrar_model->save($data);
			return redirect()->to('r/auth/signup');
		}
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