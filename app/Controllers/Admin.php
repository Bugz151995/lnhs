<?php

namespace App\Controllers;

use \App\Models\StudentModel;
use \App\Models\RegistrarModel;
use \App\Models\AdminModel;
use \App\Models\TokenRequestModel;

class Admin extends BaseController {
	public function index() {
		helper(['form', 'url']);
		return view('admin/signin');
	}

	public function auth() {
		helper(['form', 'url']);
		$admin_model = new AdminModel();

		$password = $this->request->getPost('ps');

		$query = $admin_model->select('*')
								         ->where('username', esc($this->request->getPost('un')))
								         ->get()
								         ->getResult();

		if(password_verify($password, $query[0]->password)) {
			session()->set('admin', $query[0]->admin_id);
			session()->set('islogged_in', true);
			session()->setFlashData('info', 'Welcome back '.$query[0]->firstname.'!');
			return redirect()->to('a/dashboard');
		} else return redirect()->to('a');
	}

	public function signout() {
		session()->destroy();
		return redirect()->to('a');
	}

	public function view($page = NULL) {
		helper(['form', 'url']);

		$student_model = new StudentModel();
		$registrar_model = new RegistrarModel();
    $request_model = new TokenRequestModel();


		switch ($page) {
			case 'request':
				$data['students'] = $request_model->select('*')
																				  ->join('students', 'students.student_id = token_requests.student_id')
																				  ->where('status', '0')
																				  ->get()->getResult();
				echo view('admin/templates/header');
				echo view('admin/templates/sidebar');
				echo view('admin/templates/topbar');
				echo view('admin/'.$page, $data);
				echo view('admin/templates/footer');
				break;
			case 'r_request':
				$data['registrar'] = $registrar_model->select('*')
																					   ->where('isapproved', '0')
																					   ->get()->getResult();
				echo view('admin/templates/header');
				echo view('admin/templates/sidebar');
				echo view('admin/templates/topbar');
				echo view('admin/'.$page, $data);
				echo view('admin/templates/footer');
				break;
			default:
				echo view('admin/templates/header');
				echo view('admin/templates/sidebar');
				echo view('admin/templates/topbar');
				echo view('admin/'.$page);
				echo view('admin/templates/footer');
				break;
		}
	}

	public function approveRequest() {
		helper(['form', 'url']);
		$request_id = $this->request->getPost('request_id');
		if(isset($request_id)) {
			$email = \Config\Services::email();
			$request_model = new TokenRequestModel();

			$token = $this->generateToken();
	
			$data = [
				'token_request_id' => esc($this->request->getPost('request_id')),
				'status'           => '1',
				'token'            => $token
			];

			$useremail = $this->request->getPost('email');
	
			session()->setFlashData('email', $useremail);

			$email->setTo($useremail);
			$email->setSubject('Enrollment Form Access Token');
			$email->setMessage(site_url().'auth/enrollment/'.$token);//your message here
			if($email->send()) {
				session()->setFlashData('success', 'Student Token request has been successfully approved! Email was sent');
				$request_model->save($data);
			}
			return redirect()->to('a/request');
		} else {
			$registrar_model = new RegistrarModel();
			
			$r_id = $this->request->getPost('registrar_id');

			$data = [
				'registrar_id' => esc($this->request->getPost('registrar_id')),
				'isapproved'   => '1'
			];
	
			session()->setFlashData('success', 'Registrar Account has been successfully approved!');
			$registrar_model->save($data);
			return redirect()->to('a/r_request');
		}    
	}

	public function denyRequest() {
		$student_model = new StudentModel();
    $request_model = new TokenRequestModel();
		$registrar_model = new RegistrarModel();

		$request   = esc($this->request->getPost('request_id'));
		$student   = esc($this->request->getPost('student_id'));
		$registrar = esc($this->request->getPost('registrar_id'));

		if (isset($request, $student)) {
			session()->setFlashData('info', 'Student data and request has been denied!');
			$request_model->delete($request);
			$student_model->delete($student);

			return redirect()->to('a/request');
		} else {
			session()->setFlashData('info', 'Registrar data and request has been denied!');
			$registrar_model->delete($registrar);

			return redirect()->to('a/request');
		}
	}

	public function generateToken() {
    $request_model = new TokenRequestModel();
    
    $token = bin2hex(random_bytes(20));

    $duplicate = $request_model->selectCount('token')
															 ->where('token', $token)
															 ->get()->getResult();

    while(count($duplicate) == 0) {
      $token = bin2hex(random_bytes(20));
    }

    return $token;
  }
}
