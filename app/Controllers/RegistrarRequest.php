<?php

namespace App\Controllers;

use \App\Models\StudentModel;
use \App\Models\RegistrarModel;
use \App\Models\AdminModel;
use \App\Models\TokenRequestModel;

class RegistrarRequest extends BaseController
{
  public function index() {
    helper(['form', 'url']);

		$student_model = new StudentModel();
		$registrar_model = new RegistrarModel();
    $request_model = new TokenRequestModel();
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

		$data['registrar'] = $registrar_model->select('*')
																				 ->where('isapproved', '0')
																				 ->get()->getResult();

		echo view('admin/templates/header');
		echo view('admin/templates/sidebar', $data);
		echo view('admin/templates/topbar');
		echo view('admin/r_request');
		echo view('admin/templates/footer');
  }
	public function search() {
		helper(['form', 'url']);
    
    if (!$this->validate(['searchuser' => 'required'])) {
      return redirect()->to('a/r_request');
    } else {
      $student_model = new StudentModel();
      $registrar_model = new RegistrarModel();
      $request_model = new TokenRequestModel();
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

      $search = [
        'middlename' => esc($this->request->getPost('searchuser')),
        'lastname'   => esc($this->request->getPost('searchuser'))
      ];

      $data['notif_s'] = $request_model->selectCount('students.student_id', 'total')
																		 ->join('students', 'students.student_id = token_requests.student_id')
																		 ->where('status', '0')
																		 ->get()->getRowArray();    
      $data['notif_r'] = $registrar_model->selectCount('registrar_id', 'total')
                                         ->where('isapproved', '0')
                                         ->get()->getRowArray();

		  $data['registrar'] = $registrar_model->select('*')
                                           ->where('isapproved', '0')
                                           ->like(['firstname' => esc($this->request->getPost('searchuser')),])
                                           ->orlike($search)
																				   ->get()->getResult();

      echo view('admin/templates/header');
      echo view('admin/templates/sidebar', $data);
      echo view('admin/templates/topbar');
      echo view('admin/r_request');
      echo view('admin/templates/footer');
    }
	}

  public function searchdate() {
		helper(['form', 'url']);
    
    if (!$this->validate(['searchdate' => 'required'])) {
      return redirect()->to('a/r_request');
    } else {
      $student_model = new StudentModel();
      $registrar_model = new RegistrarModel();
      $request_model = new TokenRequestModel();

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

      $search = [
        'requested_at'  => esc($this->request->getPost('searchdate')),
      ];

      $data['notif_s'] = $request_model->selectCount('students.student_id', 'total')
																		 ->join('students', 'students.student_id = token_requests.student_id')
																		 ->where('status', '0')
																		 ->get()->getRowArray();    
      $data['notif_r'] = $registrar_model->selectCount('registrar_id', 'total')
                                         ->where('isapproved', '0')
                                         ->get()->getRowArray();

		  $data['registrar'] = $registrar_model->select('*')
                                           ->like($search)
																				   ->where('isapproved', '0')
																				   ->get()->getResult();

      echo view('admin/templates/header');
      echo view('admin/templates/sidebar', $data);
      echo view('admin/templates/topbar');
      echo view('admin/r_request');
      echo view('admin/templates/footer');
    }
	}
}