<?php

namespace App\Controllers;

use \App\Models\RegistrarModel;
use \App\Models\TeacherModel;
use \App\Models\EnrollmentModel;
use \App\Models\EscGrantModel;

class Teacher extends BaseController {
	public function index() {
		helper('form');		
		$r = new RegistrarModel();
    $t = new TeacherModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();

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
      'teachers' => $t->findAll(),
    ];

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar', $data);
		echo view('registrar/templates/topbar');
		echo view('registrar/teacher/teacher_list');
    echo view('registrar/templates/footer');
	}

  public function viewnewteacher() {
		helper('form');		
		$r = new RegistrarModel();
    $t = new TeacherModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();

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
      'teachers' => $t->findAll(),
    ];

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar', $data);
		echo view('registrar/templates/topbar');
		echo view('registrar/teacher/teacher_list');
    echo view('registrar/templates/footer');
  }

  public function vieweditteacher() {
		helper('form');	
		$r = new RegistrarModel();	
    $t = new TeacherModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();

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
      'teachers' => $t->findAll(),
      'teacher' => $t->find($this->request->getPost('teacher_id')),
    ];

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar', $data);
		echo view('registrar/templates/topbar');
		echo view('registrar/teacher/edit_teacher');
    echo view('registrar/templates/footer');
  }

  public function viewdeleteteacher() {    
		helper('form');		
    $t = new TeacherModel();
		$r = new RegistrarModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();

    $data = [
      'user'       => $r->find(session()->get('registrar')),
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
      'teacher_id' => esc($this->request->getPost('teacher_id')),
      'teachers'   => $t->findAll()
    ];
    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar', $data);
		echo view('registrar/templates/topbar');
		echo view('registrar/teacher/delete_teacher');
    echo view('registrar/templates/footer');
  }

  public function create() {
    helper('form');		
    $t = new TeacherModel();

    $rules = [
      'fname' => [
        'label' => 'Firstname',
        'rules' => 'required'
      ],
      'lname' => [
        'label' => 'Lastname',
        'rules' => 'required'
      ],
      'email' => [
        'label' => 'Email',
        'rules' => 'required'
      ],
      'cn' => [
        'label' => 'Contact Number',
        'rules' => 'required'
      ],
    ];

    if (!$this->validate($rules)) {
      $data['teachers'] = $t->findAll();
      $data['validation'] = $this->validator;

      echo view('registrar/templates/header');
      echo view('registrar/templates/sidebar');
      echo view('registrar/templates/topbar');
      echo view('registrar/teacher/add_teacher', $data);
      echo view('registrar/templates/footer');
    } else {
      $data = [
        'lastname'       => esc($this->request->getPost('lname')),
        'firstname'      => esc($this->request->getPost('fname')),
        'middlename'     => esc($this->request->getPost('mname')),
        'suffix'         => esc($this->request->getPost('suf')),
        'email'          => esc($this->request->getPost('email')),
        'contact_number' => esc($this->request->getPost('cn')),
      ];

      $file = $this->request->getFile('img');
    
      $path = '';
      if($file != ''){
        $rand_name = $file->getRandomName();
        $path = site_url().'assets/teachers/'.$rand_name;
        $file->move('assets/teachers/', $rand_name);
        $data['teacher_img'] = esc($path);
      }
      
      $t->save($data);

      session()->setTempData('success', 'New Teacher has been successfully added!', 7);
      return redirect()->to('r/teacher_list');
    }
    
  }

  public function delete() {
    $t = new TeacherModel();
    $data['teacher_id'] = esc($this->request->getPost('teacher_id'));
    $t->delete($data);
    session()->setTempData('success', 'The Teacher has been successfully deleted!', 7);
    return redirect()->to('r/teacher_list');
  }

  public function edit() {
    helper('form');		
    $t = new TeacherModel();

    $rules = [
      'fname' => [
        'label' => 'Firstname',
        'rules' => 'required'
      ],
      'lname' => [
        'label' => 'Lastname',
        'rules' => 'required'
      ],
      'email' => [
        'label' => 'Email',
        'rules' => 'required'
      ],
      'cn' => [
        'label' => 'Contact Number',
        'rules' => 'required'
      ],
    ];

    if (!$this->validate($rules)) {
      $en = new EnrollmentModel();
      $esc = new EscGrantModel();
      $r = new RegistrarModel();
  
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
        'teachers' => $t->findAll(),
        'validation' => $this->validator
      ];
  
      echo view('registrar/templates/header');
      echo view('registrar/templates/sidebar', $data);
      echo view('registrar/templates/topbar');
      echo view('registrar/teacher/teacher_list');
      echo view('registrar/templates/footer');
    } else {
      $data = [
        'teacher_id'     => esc($this->request->getPost('teacher_id')),
        'lastname'       => esc($this->request->getPost('lname')),
        'firstname'      => esc($this->request->getPost('fname')),
        'middlename'     => esc($this->request->getPost('mname')),
        'suffix'         => esc($this->request->getPost('suf')),
        'email'          => esc($this->request->getPost('email')),
        'contact_number' => esc($this->request->getPost('cn')),
      ];

      $file = $this->request->getFile('img');
    
      $path = '';
      if($file != ''){
        $rand_name = $file->getRandomName();
        $path = site_url().'assets/teachers/'.$rand_name;
        $file->move('assets/teachers/', $rand_name);
        $data['teacher_img'] = esc($path);
      }
      
      $t->save($data);

      session()->setTempData('success', 'The Teacher\'s profile has been successfully edited!', 7);
      return redirect()->to('r/teacher_list');
    }
    
  }

  public function search() {
		helper('form');	
    if (!$this->validate(['searchteacher' => 'required'])) {
      return redirect()->to('r/teacher_list');
    } else {	
      $t = new TeacherModel();
      $en = new EnrollmentModel();
      $esc = new EscGrantModel();

      $search = [
        'firstname'  => esc($this->request->getPost('searchteacher')),
        'middlename' => esc($this->request->getPost('searchteacher')),
        'lastname'   => esc($this->request->getPost('searchteacher')),
      ];

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
        'teachers' => $t->select('*')
                        ->orlike($search)
                        ->get()
                        ->getResultArray(),
      ];    

      echo view('registrar/templates/header');
      echo view('registrar/templates/sidebar', $data);
      echo view('registrar/templates/topbar');
      echo view('registrar/teacher/teacher_list');
      echo view('registrar/templates/footer');
    }    
  }
}
