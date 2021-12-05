<?php

namespace App\Controllers;

use \App\Models\StudentModel;
use \App\Models\RegistrarModel;
use \App\Models\AdminModel;
use \App\Models\TokenRequestModel;
use CodeIgniter\I18n\Time;

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

		if(count($query) > 0) {
			if(password_verify($password, $query[0]->password)) {
				session()->set('admin', $query[0]->admin_id);
				session()->set('islogged_in', true);
				session()->setTempData('info', 'Welcome back '.$query[0]->firstname.'!', 3);
				return redirect()->to('a/dashboard');
			} else {
				session()->setTempData('error', 'Invalid username or password!', 3);
				return redirect()->to('a');
			}
		} else {
			session()->setTempData('error', 'Invalid username or password!', 3);
			return redirect()->to('a');
		}
	}

	public function signout() {
		session()->destroy();
		return redirect()->to('a');
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

			$email->setTo($useremail);
			$email->setSubject('Enrollment Form Access Token');
			$email->setMessage(site_url().'auth/enrollment/'.$token);//your message here	
				$sent = $email->send();
				if($sent) {
					session()->setTempData('success', 'Student Token request has been successfully approved! Email was sent', 3);
					$request_model->save($data);
				} else {
					session()->setTempData('error', 'Oops! The Student was not approved and the Email was not sent.', 3);
				}
			return redirect()->to('a/request');
		} else {
			$registrar_model = new RegistrarModel();
			
			$r_id = $this->request->getPost('registrar_id');

			$data = [
				'registrar_id' => esc($this->request->getPost('registrar_id')),
				'isapproved'   => '1'
			];
	
			session()->setTempData('success', 'Registrar Account has been successfully approved!', 3);
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
			session()->setTempData('info', 'Student data and request has been denied!', 3);
			$request_model->delete($request);

			return redirect()->to('a/request');
		} else {
			session()->setTempData('info', 'Registrar data and request has been denied!', 3);
			$registrar_model->delete($registrar);

			return redirect()->to('a/r_request');
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

	public function home() {
		helper(['form', 'url']);

		$student_model = new StudentModel();
		$registrar_model = new RegistrarModel();
    $request_model = new TokenRequestModel();
		$myTime = new Time('now', 'Asia/Manila', 'en_US');
		$a = new AdminModel();

		$data['ns_content'] = $request_model->select('*')
																			->orderBy('requested_at', 'DESC')
																			->join('students', 'students.student_id = token_requests.student_id')
																			->where('token_requests.status', '0')
																			->limit(3)
																			->get()->getResult();

		$data['nr_content'] = $registrar_model->select('*')
																				 ->orderBy('requested_at', 'DESC')
																				 ->where('isapproved', '0')
																				 ->limit(2)
																				 ->get()->getResult();

		$data['admin'] = $a->find(session()->get('admin'));
		$data['notif_s'] = $request_model->selectCount('students.student_id', 'total')
																		 ->join('students', 'students.student_id = token_requests.student_id')
																		 ->where('status', '0')
																		 ->get()->getRowArray();    
		$data['notif_r'] = $registrar_model->selectCount('registrar_id', 'total')
																			 ->where('isapproved', '0')
																			 ->get()->getRowArray();

		$pen_s = $request_model->selectCount('students.student_id', 'total')
												  ->join('students', 'students.student_id = token_requests.student_id')
													->like(['requested_at' => $myTime->getYear()])
												  ->where('status', '0')
												  ->get()->getRowArray();    

		$pen_r = $registrar_model->selectCount('registrar_id', 'total')
														->like(['requested_at' => $myTime->getYear()])
													  ->where('isapproved', '0')
													  ->get()->getRowArray();

		$app_s = $request_model->selectCount('students.student_id', 'total')
												  ->join('students', 'students.student_id = token_requests.student_id')
													->like(['requested_at' => $myTime->getYear()])
												  ->where('status', '1')
												  ->get()->getRowArray();    

		$app_r = $registrar_model->selectCount('registrar_id', 'total')
														->like(['requested_at' => $myTime->getYear()])
													  ->where('isapproved', '1')
													  ->get()->getRowArray();

		$data['approved_s'] = $app_s['total'];
		$data['approved_r'] = $app_r['total'];
		$data['pending_s'] = $pen_s['total'];
		$data['pending_r'] = $pen_r['total'];

		echo view('admin/templates/header');
		echo view('admin/templates/sidebar', $data);
		echo view('admin/templates/topbar');
		echo view('admin/dashboard');
		echo view('admin/templates/footer');
	}

	public function changepass() {
		helper(['form', 'url']);

		$student_model = new StudentModel();
		$registrar_model = new RegistrarModel();
    $request_model = new TokenRequestModel();
		$myTime = new Time('now', 'Asia/Manila', 'en_US');
		$a = new AdminModel();

		$data['ns_content'] = $request_model->select('*')
																			->orderBy('requested_at', 'DESC')
																			->join('students', 'students.student_id = token_requests.student_id')
																			->where('token_requests.status', '0')
																			->limit(3)
																			->get()->getResult();

		$data['nr_content'] = $registrar_model->select('*')
																				 ->orderBy('requested_at', 'DESC')
																				 ->where('isapproved', '0')
																				 ->limit(2)
																				 ->get()->getResult();

		$data['admin'] = $a->find(session()->get('admin'));
		$data['notif_s'] = $request_model->selectCount('students.student_id', 'total')
																		 ->join('students', 'students.student_id = token_requests.student_id')
																		 ->where('status', '0')
																		 ->get()->getRowArray();    
		$data['notif_r'] = $registrar_model->selectCount('registrar_id', 'total')
																			 ->where('isapproved', '0')
																			 ->get()->getRowArray();

		$pen_s = $request_model->selectCount('students.student_id', 'total')
												  ->join('students', 'students.student_id = token_requests.student_id')
													->like(['requested_at' => $myTime->getYear()])
												  ->where('status', '0')
												  ->get()->getRowArray();    

		$pen_r = $registrar_model->selectCount('registrar_id', 'total')
														->like(['requested_at' => $myTime->getYear()])
													  ->where('isapproved', '0')
													  ->get()->getRowArray();

		$app_s = $request_model->selectCount('students.student_id', 'total')
												  ->join('students', 'students.student_id = token_requests.student_id')
													->like(['requested_at' => $myTime->getYear()])
												  ->where('status', '1')
												  ->get()->getRowArray();    

		$app_r = $registrar_model->selectCount('registrar_id', 'total')
														->like(['requested_at' => $myTime->getYear()])
													  ->where('isapproved', '1')
													  ->get()->getRowArray();

		$data['approved_s'] = $app_s['total'];
		$data['approved_r'] = $app_r['total'];
		$data['pending_s'] = $pen_s['total'];
		$data['pending_r'] = $pen_r['total'];

		echo view('admin/templates/header');
		echo view('admin/templates/sidebar', $data);
		echo view('admin/templates/topbar');
		echo view('admin/change_pass');
		echo view('admin/templates/footer');
	}

	public function savepass() {		
		$rules = [
			'password' => [
				'label' => 'Password',
				'rules' => 'required|verify_admin[password]',
				'errors' => [
					'verify_admin' => 'Invalid Password! please enter your correct password.'
				]
			],
			'newpass' => [
				'label' => 'New Password',
				'rules' => 'required'
			],
			'passconf' => [
				'label' => 'Password Confirmation',
				'rules' => 'required|matches[newpass]'
			],
		];
		$a = new AdminModel();

		if (!$this->validate($rules)) {
			helper(['form', 'url']);
	
			$student_model = new StudentModel();
			$registrar_model = new RegistrarModel();
			$request_model = new TokenRequestModel();
			$myTime = new Time('now', 'Asia/Manila', 'en_US');
	
			$data['ns_content'] = $request_model->select('*')
																				->orderBy('requested_at', 'DESC')
																				->join('students', 'students.student_id = token_requests.student_id')
																				->where('token_requests.status', '0')
																				->limit(3)
																				->get()->getResult();
	
			$data['nr_content'] = $registrar_model->select('*')
																					 ->orderBy('requested_at', 'DESC')
																					 ->where('isapproved', '0')
																					 ->limit(2)
																					 ->get()->getResult();
	
			$data['admin'] = $a->find(session()->get('admin'));
			$data['notif_s'] = $request_model->selectCount('students.student_id', 'total')
																			 ->join('students', 'students.student_id = token_requests.student_id')
																			 ->where('status', '0')
																			 ->get()->getRowArray();    
			$data['notif_r'] = $registrar_model->selectCount('registrar_id', 'total')
																				 ->where('isapproved', '0')
																				 ->get()->getRowArray();
	
			$pen_s = $request_model->selectCount('students.student_id', 'total')
														->join('students', 'students.student_id = token_requests.student_id')
														->like(['requested_at' => $myTime->getYear()])
														->where('status', '0')
														->get()->getRowArray();    
	
			$pen_r = $registrar_model->selectCount('registrar_id', 'total')
															->like(['requested_at' => $myTime->getYear()])
															->where('isapproved', '0')
															->get()->getRowArray();
	
			$app_s = $request_model->selectCount('students.student_id', 'total')
														->join('students', 'students.student_id = token_requests.student_id')
														->like(['requested_at' => $myTime->getYear()])
														->where('status', '1')
														->get()->getRowArray();    
	
			$app_r = $registrar_model->selectCount('registrar_id', 'total')
															->like(['requested_at' => $myTime->getYear()])
															->where('isapproved', '1')
															->get()->getRowArray();
	
			$data['approved_s'] = $app_s['total'];
			$data['approved_r'] = $app_r['total'];
			$data['pending_s'] = $pen_s['total'];
			$data['pending_r'] = $pen_r['total'];
			$data['validation'] = $this->validator;
	
			echo view('admin/templates/header');
			echo view('admin/templates/sidebar', $data);
			echo view('admin/templates/topbar');
			echo view('admin/change_pass');
			echo view('admin/templates/footer');
		} else {
			$data['password'] = password_hash($this->request->getPost('newpass'), PASSWORD_DEFAULT);
			$data['admin_id'] = esc(session()->get('admin'));
			$a->save($data);
			session()->setTempData('success', 'New password was successfully saved!', 3);
			return redirect()->to('a/dashboard');
		}
	}

	public function update() {
		helper(['form', 'url']);

		$student_model = new StudentModel();
		$registrar_model = new RegistrarModel();
    $request_model = new TokenRequestModel();
		$myTime = new Time('now', 'Asia/Manila', 'en_US');
		$a = new AdminModel();

		$data['ns_content'] = $request_model->select('*')
																			->orderBy('requested_at', 'DESC')
																			->join('students', 'students.student_id = token_requests.student_id')
																			->where('token_requests.status', '0')
																			->limit(3)
																			->get()->getResult();

		$data['nr_content'] = $registrar_model->select('*')
																				 ->orderBy('requested_at', 'DESC')
																				 ->where('isapproved', '0')
																				 ->limit(2)
																				 ->get()->getResult();

		$data['admin'] = $a->find(session()->get('admin'));
		$data['notif_s'] = $request_model->selectCount('students.student_id', 'total')
																		 ->join('students', 'students.student_id = token_requests.student_id')
																		 ->where('status', '0')
																		 ->get()->getRowArray();    
		$data['notif_r'] = $registrar_model->selectCount('registrar_id', 'total')
																			 ->where('isapproved', '0')
																			 ->get()->getRowArray();

		$pen_s = $request_model->selectCount('students.student_id', 'total')
												  ->join('students', 'students.student_id = token_requests.student_id')
													->like(['requested_at' => $myTime->getYear()])
												  ->where('status', '0')
												  ->get()->getRowArray();    

		$pen_r = $registrar_model->selectCount('registrar_id', 'total')
														->like(['requested_at' => $myTime->getYear()])
													  ->where('isapproved', '0')
													  ->get()->getRowArray();

		$app_s = $request_model->selectCount('students.student_id', 'total')
												  ->join('students', 'students.student_id = token_requests.student_id')
													->like(['requested_at' => $myTime->getYear()])
												  ->where('status', '1')
												  ->get()->getRowArray();    

		$app_r = $registrar_model->selectCount('registrar_id', 'total')
														->like(['requested_at' => $myTime->getYear()])
													  ->where('isapproved', '1')
													  ->get()->getRowArray();

		$data['approved_s'] = $app_s['total'];
		$data['approved_r'] = $app_r['total'];
		$data['pending_s'] = $pen_s['total'];
		$data['pending_r'] = $pen_r['total'];

		echo view('admin/templates/header');
		echo view('admin/templates/sidebar', $data);
		echo view('admin/templates/topbar');
		echo view('admin/update_account');
		echo view('admin/templates/footer');
	}

	public function saveuser() {		
		$rules = [
			'fname' => [
				'label' => 'Firstname',
				'rules' => 'required',
			],
			'lname' => [
				'label' => 'Lastname',
				'rules' => 'required'
			],
			'uname' => [
				'label' => 'Username',
				'rules' => 'required'
			],
		];
		$a = new AdminModel();

		if (!$this->validate($rules)) {
			helper(['form', 'url']);
	
			$student_model = new StudentModel();
			$registrar_model = new RegistrarModel();
			$request_model = new TokenRequestModel();
			$myTime = new Time('now', 'Asia/Manila', 'en_US');
	
			$data['ns_content'] = $request_model->select('*')
																				->orderBy('requested_at', 'DESC')
																				->join('students', 'students.student_id = token_requests.student_id')
																				->where('token_requests.status', '0')
																				->limit(3)
																				->get()->getResult();
	
			$data['nr_content'] = $registrar_model->select('*')
																					 ->orderBy('requested_at', 'DESC')
																					 ->where('isapproved', '0')
																					 ->limit(2)
																					 ->get()->getResult();
	
			$data['admin'] = $a->find(session()->get('admin'));
			$data['notif_s'] = $request_model->selectCount('students.student_id', 'total')
																			 ->join('students', 'students.student_id = token_requests.student_id')
																			 ->where('status', '0')
																			 ->get()->getRowArray();    
			$data['notif_r'] = $registrar_model->selectCount('registrar_id', 'total')
																				 ->where('isapproved', '0')
																				 ->get()->getRowArray();
	
			$pen_s = $request_model->selectCount('students.student_id', 'total')
														->join('students', 'students.student_id = token_requests.student_id')
														->like(['requested_at' => $myTime->getYear()])
														->where('status', '0')
														->get()->getRowArray();    
	
			$pen_r = $registrar_model->selectCount('registrar_id', 'total')
															->like(['requested_at' => $myTime->getYear()])
															->where('isapproved', '0')
															->get()->getRowArray();
	
			$app_s = $request_model->selectCount('students.student_id', 'total')
														->join('students', 'students.student_id = token_requests.student_id')
														->like(['requested_at' => $myTime->getYear()])
														->where('status', '1')
														->get()->getRowArray();    
	
			$app_r = $registrar_model->selectCount('registrar_id', 'total')
															->like(['requested_at' => $myTime->getYear()])
															->where('isapproved', '1')
															->get()->getRowArray();
	
			$data['approved_s'] = $app_s['total'];
			$data['approved_r'] = $app_r['total'];
			$data['pending_s'] = $pen_s['total'];
			$data['pending_r'] = $pen_r['total'];
			$data['validation'] = $this->validator;
	
			echo view('admin/templates/header');
			echo view('admin/templates/sidebar', $data);
			echo view('admin/templates/topbar');
			echo view('admin/update_account');
			echo view('admin/templates/footer');
		} else {
			$data = [
				'firstname'  => esc($this->request->getPost('fname')),
				'lastname'   => esc($this->request->getPost('lname')),
				'middlename' => esc($this->request->getPost('mname')),
				'username'   => esc($this->request->getPost('uname')),
				'admin_id'   => esc(session()->get('admin')),
			];

			$a->save($data);
			session()->setTempData('success', 'The New user credentials was successfully saved!', 3);
			return redirect()->to('a/dashboard');
		}
	}
}
