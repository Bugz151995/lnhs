<?php

namespace App\Controllers;

use \App\Models\RegistrarModel;
use \App\Models\StudentModel;
use \App\Models\AddressModel;
use \App\Models\StudentAddressModel;
use \App\Models\PersonModel;
use \App\Models\EscApplicationModel;
use \App\Models\RelationModel;
use \App\Models\EnrollmentModel;
use \App\Models\ClassModel;
use \App\Models\StudentClassModel;
use \App\Models\EscGrantModel;
use \App\Models\CoursesModel;

class VoucherManagement extends BaseController {
  public function index() {
    helper(['form', 'url']);

		echo view('student/templates/header');
		echo view('student/templates/topbar');
		echo view('student/esc_auth');
		echo view('student/templates/footer');
  }

  public function auth() {
    $rules = [
      'fname' => [
        'label' => 'Firstname',
        'rules' => 'required'
      ],
      'lname' => [
        'label' => 'Middlename',
        'rules' => 'required'
      ],
      'email' => [
        'label' => 'Email Address',
        'rules' => 'required'
      ],
    ];
    helper(['form', 'url']);

    if($this->validate($rules)) {  
      $data = [
        'firstname'  => esc($this->request->getPost('fname')),
        'middlename' => esc($this->request->getPost('mname')),
        'lastname'   => esc($this->request->getPost('lname')),
        'email'      => esc($this->request->getPost('email')),
      ]; 
      
      $s = new StudentModel();
      $r = new RelationModel();
      $esc = new EscApplicationModel();

      $student = $s->select('*')
                   ->getWhere($data)
                   ->getRowArray();      

      if(isset($student) && count($student) > 0) {
        $relatives = $r->select('*')
                     ->join('persons', 'persons.person_id = relations.person_id')
                     ->getWhere(['student_id' => $student["student_id"]])
                     ->getResult();
        $data = [
          'student'   => $student,
          'relatives' => $relatives
        ];

        $res = $esc->select('*')
                   ->getWhere(['student_id' => $student["student_id"]])
                   ->getResult();
        $is_esc_applied = (count($res) > 0) ? TRUE : FALSE;

        if($is_esc_applied) {
          session()->setTempData('error', 'You have already applied for ESC!', 2);
          return redirect()->to('esc');
        } else {
          echo view('student/templates/header');
          echo view('student/templates/topbar');
          echo view('student/esc_form', $data);
          echo view('student/templates/footer');
        } 
      } else {
        session()->setTempData('error', 'Student Data Not Found!', 2);
        return redirect()->to('esc');
      }    
    } else {   
      echo view('student/templates/header');
      echo view('student/templates/topbar');
      echo view('student/esc_auth', ['validation' => $this->validator]);
      echo view('student/templates/footer');   
    }
  }

  public function register() {
    helper('form');
    $rules = [
      'motorcycle_pedicab' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'This field is required.'
        ]
      ],
      'four_wheels' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'This field is required.'
        ]
      ],
      'land_farm' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'This field is required.'
        ]
      ],
      'home_detail' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'This field is required.'
        ]
      ],
      'beds' => [
        'label' => 'Number of Bedroom',
        'rules' => 'required'
      ],
      'income_src' => [
        'label' => 'Source Income of your Father\'s',
        'rules' => 'required'
      ],
      'gross_income' => [
        'label' => 'Gross Monthly Income of your Father\'s',
        'rules' => 'required'
      ],
      'school_name' => [
        'label' => 'Name of School',
        'rules' => 'required'
      ],
      'school_type' => [
        'label' => 'School Type',
        'rules' => 'required'
      ],
      'school_address' => [
        'label' => 'School Address',
        'rules' => 'required'
      ],
      's' => [
        'label' => 'Student',
        'rules' => 'is_unique[esc_applications.student_id]'
      ],
    ];

    if (!$this->validate($rules)) {
      $s = new StudentModel();
      $r = new RelationModel();

      $student = $s->find(esc($this->request->getPost('s')));

      $relatives = $r->select('*')
                     ->join('persons', 'persons.person_id = relations.person_id')
                     ->getWhere(['student_id' => esc($this->request->getPost('s'))])
                     ->getResult();
      $data = [
        'student'   => $student,
        'relatives' => $relatives,
        'validation'=> $this->validator
      ];
      
      echo view('student/templates/header');
      echo view('student/templates/topbar');
      echo view('student/esc_form', $data);
      echo view('student/templates/footer');
    } else {
      $esc = new EscApplicationModel();
      $p = new PersonModel();

      $esc_data = [
        'is2or3wheelsowned' => esc($this->request->getPost('motorcycle_pedicab')),
        'is4wheelsowned' => esc($this->request->getPost('four_wheels')),
        'islandorfarmowned' => esc($this->request->getPost('land_farm')),
        'home_details' => esc($this->request->getPost('home_detail')),
        'beds' => esc($this->request->getPost('beds')),
        'school_name' => esc($this->request->getPost('school_name')),
        'school_type' => esc($this->request->getPost('school_type')),
        'school_address' => esc($this->request->getPost('school_address')),
        'tuition' => esc($this->request->getPost('')),
        'other_fee' => esc($this->request->getPost('')),
        'misc_fee' => esc($this->request->getPost('')),
        'student_id' => esc($this->request->getPost('s')),
      ];

      $esc->save($esc_data);

      $persons = $this->request->getPost('p');
      $isrc = $this->request->getPost('income_src');
      $ginc = $this->request->getPost('gross_income');
      foreach ($persons as $key => $person) {
        $person_data = [
          'person_id' => esc($person),
          'income_source' => esc($isrc[$key]), 
          'gross_income' => esc($ginc[$key])
        ];
  
        $p->save($person_data);
      }
      

      session()->setTempData('success','Your ESC application is now being processed.',3);
      return redirect()->to('');
    }    
  }

  public function requests() {
    helper(['form', 'url']);
		$r = new RegistrarModel();
    $esca = new EscApplicationModel();
    $c = new ClassModel();
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
    ];
    $data['class'] = $c->findAll();
    $data['applications'] = $esca->select('students.student_id, submitted_at, esc_applications.esc_application_id, user_img, firstname, lastname, middlename, suffix, class_name, email, status')
                                ->join('students', 'students.student_id = esc_applications.student_id')
                                ->join('students_class', 'students_class.student_id = students.student_id')
                                ->join('class', 'class.class_id = students_class.class_id')
                                ->join('esc_grants', 'esc_grants.esc_application_id = esc_applications.esc_application_id', 'left')
                                ->where(['esc_grants.status' => null])
                                ->orderBy('submitted_at', 'DESC')
                                ->get()->getResultArray();
    
    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar', $data);
		echo view('registrar/templates/topbar');
		echo view('registrar/esc/esc_request');
    echo view('registrar/templates/footer');
  }

  public function verify() {
    helper(['form', 'url']);
		$r = new RegistrarModel();
    $esca = new EscApplicationModel();
    $re = new RelationModel();
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
    ];

    $data['application'] = $esca->join('students', 'students.student_id = esc_applications.student_id')
                                ->join('students_class', 'students_class.student_id = students.student_id')
                                ->join('students_address', 'students_address.student_id = students.student_id')
                                ->join('address', 'address.address_id = students_address.address_id')
                                ->join('class', 'class.class_id = students_class.class_id')
                                ->orderBy('submitted_at', 'DESC')
                                ->find(esc($this->request->getPost('e')));
    $data['relatives'] = $re->join('persons', 'persons.person_id = relations.person_id')
                           ->getWhere(['student_id' => esc($this->request->getPost('s'))])
                           ->getResultArray();

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar', $data);
		echo view('registrar/templates/topbar');
		echo view('registrar/esc/esc_verify');
    echo view('registrar/templates/footer');
  }

  public function grantesc() {
    $esc = new EscGrantModel();
    $res = $esc->select('esc_grant_id')
               ->getWhere(['esc_application_id' => esc($this->request->getPost('e'))])
               ->getRowArray();
    $data = [
      'esc_application_id' => esc($this->request->getPost('e')),
      'registrar_id'       => esc(session()->get('registrar')),
      'status'             => esc('approved')
    ];

    if(count($res) > 0) {
      $data['esc_grant_id'] = $res['esc_grant_id'];
    }

    $esc->save($data);
    session()->setTempData('success','The ESC Application of the student was successfully approved!',3);
    return redirect()->to('r/esc_approved');
  }

  public function denyesc() {
    $esc = new EscGrantModel();
    $res = $esc->select('esc_grant_id')
               ->getWhere(['esc_application_id' => esc($this->request->getPost('e'))])
               ->getRowArray();
    $data = [
      'esc_application_id' => esc($this->request->getPost('e')),
      'registrar_id'       => esc(session()->get('registrar')),
      'status'             => esc('denied')
    ];

    if(count($res) > 0) {
      $data['esc_grant_id'] = $res['esc_grant_id'];
    }

    $esc->save($data);
    session()->setTempData('warning','The ESC Application of the student was denied!',3);
    return redirect()->to('r/esc_denied');
  }

  public function approved() {
    helper(['form', 'url']);
    $esca = new EscApplicationModel();
    $c = new ClassModel();
		$r = new RegistrarModel();
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
    ];

    $data['class'] = $c->findAll();
    $data['applications'] = $esca->select('students.student_id, submitted_at, esc_applications.esc_application_id, user_img, firstname, lastname, middlename, suffix, class_name, email, status')
                                ->join('students', 'students.student_id = esc_applications.student_id')
                                ->join('students_class', 'students_class.student_id = students.student_id')
                                ->join('class', 'class.class_id = students_class.class_id')
                                ->join('esc_grants', 'esc_grants.esc_application_id = esc_applications.esc_application_id', 'left')
                                ->where(['esc_grants.status' => 'approved'])
                                ->orderBy('submitted_at', 'DESC')
                                ->get()->getResultArray();

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar', $data);
		echo view('registrar/templates/topbar');
		echo view('registrar/esc/esc_approved');
    echo view('registrar/templates/footer');
  }

  public function searchdate($page) {
    helper(['form', 'url']);

    $status = null;
    $p = null;
    if($page == 'a') {
      $status = 'approved';
      $p = 'esc_approved';
    } else if($page == 'd') {
      $status = 'denied';
      $p = 'esc_denied';
    } else {
      $status = null;
      $p = 'esc_request';
    }

    if(!$this->validate(['searchdate' => 'required'])){
      return redirect()->to('r/'.$p);
    } else {
      $r = new RegistrarModel();
      $esca = new EscApplicationModel();
      $c = new ClassModel();
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
      ];

      $data['class'] = $c->findAll();
      $search = [
        'submitted_at' => esc($this->request->getPost('searchdate'))
      ];
      $status = null;

      $data['applications'] = $esca->select('students.student_id, submitted_at, esc_applications.esc_application_id, user_img, firstname, lastname, middlename, suffix, class_name, email, status')
                                  ->join('students', 'students.student_id = esc_applications.student_id')
                                  ->join('students_class', 'students_class.student_id = students.student_id')
                                  ->join('class', 'class.class_id = students_class.class_id')
                                  ->join('esc_grants', 'esc_grants.esc_application_id = esc_applications.esc_application_id', 'left')
                                  ->where(['esc_grants.status' => $status])
                                  ->like($search)
                                  ->orderBy('submitted_at', 'DESC')
                                  ->get()->getResultArray();

      echo view('registrar/templates/header');
      echo view('registrar/templates/sidebar', $data);
      echo view('registrar/templates/topbar');
      echo view('registrar/esc/'.$p);
      echo view('registrar/templates/footer');
    }
  }

  public function searchclass($page) {
    helper(['form', 'url']);

    $status = null;
    $p = null;
    if($page == 'a') {
      $status = 'approved';
      $p = 'esc_approved';
    } else if($page == 'd') {
      $status = 'denied';
      $p = 'esc_denied';
    } else {
      $status = null;
      $p = 'esc_request';
    }

    if(!$this->validate(['searchclass' => 'required'])){
      return redirect()->to('r/'.$p);
    } else {
      $r = new RegistrarModel();
      $esca = new EscApplicationModel();
      $c = new ClassModel();
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
      ];

      $data['class'] = $c->findAll();
      $search = [
        'class.class_id' => esc($this->request->getPost('searchclass'))
      ];

      $data['applications'] = $esca->select('students.student_id, submitted_at, esc_applications.esc_application_id, user_img, firstname, lastname, middlename, suffix, class_name, email, status')
                                  ->join('students', 'students.student_id = esc_applications.student_id')
                                  ->join('students_class', 'students_class.student_id = students.student_id')
                                  ->join('class', 'class.class_id = students_class.class_id')
                                  ->join('esc_grants', 'esc_grants.esc_application_id = esc_applications.esc_application_id', 'left')
                                  ->where(['esc_grants.status' => $status])
                                  ->like($search)
                                  ->orderBy('submitted_at', 'DESC')
                                  ->get()->getResultArray();

      echo view('registrar/templates/header');
      echo view('registrar/templates/sidebar', $data);
      echo view('registrar/templates/topbar');
      echo view('registrar/esc/'.$p);
      echo view('registrar/templates/footer');
    }
  }

  public function search($page) {
    helper(['form', 'url']);

    $status = null;
    $p = null;
    if($page == 'a') {
      $status = 'approved';
      $p = 'esc_approved';
    } else if($page == 'd') {
      $status = 'denied';
      $p = 'esc_denied';
    } else {
      $p = 'esc_request';
    }

    if(!$this->validate(['search' => 'required'])){
      return redirect()->to('r/'.$p);
    } else {
      $r = new RegistrarModel();
      $esca = new EscApplicationModel();
      $c = new ClassModel();
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
      ];

      $data['class'] = $c->findAll();
      $search = [
        'middlename' => esc($this->request->getPost('search')),
        'lastname'   => esc($this->request->getPost('search')),
        'suffix'     => esc($this->request->getPost('search')),
      ];

      $data['applications'] = $esca->select('students.student_id, submitted_at, esc_applications.esc_application_id, user_img, firstname, lastname, middlename, suffix, class_name, email, status')
                                  ->join('students', 'students.student_id = esc_applications.student_id')
                                  ->join('students_class', 'students_class.student_id = students.student_id')
                                  ->join('class', 'class.class_id = students_class.class_id')
                                  ->join('esc_grants', 'esc_grants.esc_application_id = esc_applications.esc_application_id', 'left')
                                  ->where(['esc_grants.status' => $status])
                                  ->like(['firstname'  => esc($this->request->getPost('search'))])
                                  ->orlike($search)
                                  ->orderBy('submitted_at', 'DESC')
                                  ->get()->getResultArray();

      echo view('registrar/templates/header');
      echo view('registrar/templates/sidebar', $data);
      echo view('registrar/templates/topbar');
      echo view('registrar/esc/'.$p);
      echo view('registrar/templates/footer');
    }
  }

  public function denied() {
    helper(['form', 'url']);
    $esca = new EscApplicationModel();
    $c = new ClassModel();
		$r = new RegistrarModel();
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
    ];

    $data['class'] = $c->findAll();

    $data['applications'] = $esca->select('students.student_id, submitted_at, esc_applications.esc_application_id, user_img, firstname, lastname, middlename, suffix, class_name, email, status')
                                ->join('students', 'students.student_id = esc_applications.student_id')
                                ->join('students_class', 'students_class.student_id = students.student_id')
                                ->join('class', 'class.class_id = students_class.class_id')
                                ->join('esc_grants', 'esc_grants.esc_application_id = esc_applications.esc_application_id', 'left')
                                ->where(['esc_grants.status' => 'denied'])
                                ->orderBy('submitted_at', 'DESC')
                                ->get()->getResultArray();

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar', $data);
		echo view('registrar/templates/topbar');
		echo view('registrar/esc/esc_denied');
    echo view('registrar/templates/footer');
  }

  public function view() {
    helper(['form', 'url']);
    $esca = new EscApplicationModel();
    $re = new RelationModel();
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
      'application' => $esca->join('students', 'students.student_id = esc_applications.student_id')
                           ->join('students_class', 'students_class.student_id = students.student_id')
                           ->join('students_address', 'students_address.student_id = students.student_id')
                           ->join('address', 'address.address_id = students_address.address_id')
                           ->join('class', 'class.class_id = students_class.class_id')
                           ->orderBy('submitted_at', 'DESC')
                           ->find(esc($this->request->getPost('e'))),
      'relatives' => $re->join('persons', 'persons.person_id = relations.person_id')
                            ->getWhere(['student_id' => esc($this->request->getPost('s'))])
                            ->getResultArray()
    ];

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar', $data);
		echo view('registrar/templates/topbar');
		echo view('registrar/esc/esc_form');
    echo view('registrar/templates/footer');
  }
}