<?php

namespace App\Controllers;

use \App\Models\StudentModel;
use \App\Models\RegistrarModel;
use \App\Models\AdminModel;
use \App\Models\TokenRequestModel;
use \App\Models\ClassModel;

class StudentRequest extends BaseController
{
  public function index() {
    helper(['form', 'url']);

		$student_model = new StudentModel();
		$registrar_model = new RegistrarModel();
    $request_model = new TokenRequestModel();
		$a = new AdminModel();
    $c = new ClassModel();
    $data['class'] = $c->findAll();
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

		$data['students'] = $request_model->select('*')
                                        ->join('students', 'students.student_id = token_requests.student_id')
                                        ->join('students_class', 'students.student_id = students_class.student_id')
                                        ->join('class', 'class.class_id = students_class.class_id')
                                        ->where('status', '0')
																			  ->get()->getResult();
    
		echo view('admin/templates/header');
		echo view('admin/templates/sidebar', $data);
		echo view('admin/templates/topbar');
		echo view('admin/request');
		echo view('admin/templates/footer');
  }

	public function search() {
		helper(['form', 'url']);
    
    if (!$this->validate(['searchstudent' => 'required'])) {
      return redirect()->to('a/request');
    } else {
      $student_model = new StudentModel();
      $registrar_model = new RegistrarModel();
      $request_model = new TokenRequestModel();
      $a = new AdminModel();
      $c = new ClassModel();
      $data['class'] = $c->findAll();

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

      $search = [
        'middlename' => esc($this->request->getPost('searchstudent')),
        'lastname'   => esc($this->request->getPost('searchstudent')),
        'suffix'     => esc($this->request->getPost('searchstudent')),
      ];

      $data['notif_s'] = $request_model->selectCount('students.student_id', 'total')
																		 ->join('students', 'students.student_id = token_requests.student_id')
																		 ->where('status', '0')
																		 ->get()->getRowArray();    
      $data['notif_r'] = $registrar_model->selectCount('registrar_id', 'total')
                                         ->where('isapproved', '0')
                                         ->get()->getRowArray();

      $data['students'] = $request_model->select('*')
                                        ->join('students', 'students.student_id = token_requests.student_id')
                                        ->join('students_class', 'students.student_id = students_class.student_id')
                                        ->join('class', 'class.class_id = students_class.class_id')
                                        ->where(['status' => '0'])
                                        ->like(['firstname' => esc($this->request->getPost('searchstudent')),])
                                        ->orlike($search)
                                        ->get()->getResult();

      echo view('admin/templates/header');
      echo view('admin/templates/sidebar', $data);
      echo view('admin/templates/topbar');
      echo view('admin/request');
      echo view('admin/templates/footer');
    }
	}

  public function searchdate() {
		helper(['form', 'url']);
    
    if (!$this->validate(['searchdate' => 'required'])) {
      return redirect()->to('a/request');
    } else {
      $student_model = new StudentModel();
      $registrar_model = new RegistrarModel();
      $request_model = new TokenRequestModel();
      $a = new AdminModel();
      $c = new ClassModel();
      $data['class'] = $c->findAll();  

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

      $search = [
        'requested_at' => esc($this->request->getPost('searchdate')),
      ];

      $data['notif_s'] = $request_model->selectCount('students.student_id', 'total')
																		 ->join('students', 'students.student_id = token_requests.student_id')
																		 ->where('status', '0')
																		 ->get()->getRowArray();    
      $data['notif_r'] = $registrar_model->selectCount('registrar_id', 'total')
                                         ->where('isapproved', '0')
                                         ->get()->getRowArray();

      $data['students'] = $request_model->select('*')
                                        ->join('students', 'students.student_id = token_requests.student_id')
                                        ->join('students_class', 'students.student_id = students_class.student_id')
                                        ->join('class', 'class.class_id = students_class.class_id')
                                        ->orlike($search)
                                        ->where('status', '0')
                                        ->get()->getResult();

      echo view('admin/templates/header');
      echo view('admin/templates/sidebar', $data);
      echo view('admin/templates/topbar');
      echo view('admin/request');
      echo view('admin/templates/footer');
    }
	}

  public function searchclass() {
		helper(['form', 'url']);
    
    if (!$this->validate(['searchclass' => 'required'])) {
      return redirect()->to('a/request');
    } else {
      $student_model = new StudentModel();
      $registrar_model = new RegistrarModel();
      $request_model = new TokenRequestModel();
      $a = new AdminModel(); 
      $c = new ClassModel();
      $data['class'] = $c->findAll();

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

      $search = [
        'students_class.class_id' => esc($this->request->getPost('searchclass')),
      ];

      $data['notif_s'] = $request_model->selectCount('students.student_id', 'total')
																		 ->join('students', 'students.student_id = token_requests.student_id')
																		 ->where('status', '0')
																		 ->get()->getRowArray();    
      $data['notif_r'] = $registrar_model->selectCount('registrar_id', 'total')
                                         ->where('isapproved', '0')
                                         ->get()->getRowArray();

      $data['students'] = $request_model->select('*')
                                        ->join('students', 'students.student_id = token_requests.student_id')
                                        ->join('students_class', 'students.student_id = students_class.student_id')
                                        ->join('class', 'class.class_id = students_class.class_id')
                                        ->orlike($search)
                                        ->where('status', '0')
                                        ->get()->getResult();

      echo view('admin/templates/header');
      echo view('admin/templates/sidebar', $data);
      echo view('admin/templates/topbar');
      echo view('admin/request');
      echo view('admin/templates/footer');
    }
	}
}