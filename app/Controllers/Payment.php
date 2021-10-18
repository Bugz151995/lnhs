<?php

namespace App\Controllers;

use \App\Models\EnrollmentModel;
use \App\Models\RegistrarModel;
use \App\Models\EscGrantModel;
use \App\Models\ClassModel;
use \App\Models\PaymentModel;
use \App\Models\StudentModel;
use \App\Models\FeesModel;
use \App\Models\StudentSchedulesModel;
use CodeIgniter\I18n\Time;

class Payment extends BaseController {
	public function index() {
    helper(['form', 'url']);
    $enrollment_model = new EnrollmentModel();
		$r = new RegistrarModel();
    $c = new ClassModel();
    $p = new PaymentModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();

    $enrollments = $enrollment_model->select('*')
                                    ->join('students', 'students.student_id = enrollments.student_id')
                                    ->join('students_class', 'students_class.student_id = students.student_id')
                                    ->join('class', 'class.class_id = students_class.class_id')
                                    ->join('students_address', 'students_address.student_id = students.student_id')
                                    ->join('address', 'address.address_id = students_address.address_id')
                                    ->groupBy('students.student_id')
                                    ->get()
                                    ->getResult();

    $payment = array();
    $total = array();
    foreach ($enrollments as $key => $e) {
      $search = [
        'acad_year'  => $e->acad_year,
        'student_id' => $e->student_id,
      ];
      $ispaid = $p->where($search)
                  ->findAll();
      $amount = $p->where($search)
                  ->orderBy('recorded_at', 'DESC')
                  ->first();

      if(isset($ispaid, $amount) && count($ispaid) > 0 && count($amount) > 0) {
        array_push($payment, 1);
        array_push($total, $amount);
      } else {
        array_push($payment, 0);
        array_push($total, ['balance' => 0]);
      }
    }

    $data = [
			'user'    => $r->find(session()->get('registrar')),
      'enrollments' => $enrollments,
      'class'       => $c->findAll(),
      'payment'     => $payment,
      'total_paid'  => $total,			
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

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar', $data);
		echo view('registrar/templates/topbar');
		echo view('registrar/payment/index');
    echo view('registrar/templates/footer');
	}

  public function recordPayment($sid) {
    helper(['form', 'url']);
    $student_model = new StudentModel();
    $payment_model = new PaymentModel();
    $fees_model    = new FeesModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();
		$r = new RegistrarModel();
    $myTime = new Time('now', 'Asia/Manila', 'en_US');

    $student_data = $student_model->join('students_class', 'students_class.student_id = students.student_id')
                                  ->join('class', 'class.class_id = students_class.class_id')
                                  ->join('courses', 'courses.course_id = class.course_id')
                                  ->join('tracks', 'tracks.track_id = courses.track_id')
                                  ->join('strands', 'strands.strand_id = courses.strand_id')
                                  ->join('enrollments', 'enrollments.student_id = students.student_id')
                                  ->find(esc($sid));

    $data = [
			'user'      => $r->find(session()->get('registrar')),
      'student'   => $student_data,
      'payment'   => $payment_model->where([
                                  'student_id' => $student_data['student_id'],
                                  'acad_year'  => $student_data['acad_year'],
                                  ])
                                  ->orderBy('recorded_at', 'ASC')
                                  ->findAll(),
      'c_payment' => $payment_model->where([
                                   'student_id' => $student_data['student_id'],
                                   'acad_year'  => $student_data['acad_year'],
                                   ])
                                   ->orderBy('recorded_at', 'DESC')
                                   ->first(),
      'fees'      => $fees_model->select('*')
                              ->where(['grade_level' => $student_data['grade_level']])
                              ->get()->getRowArray(),
      'now'       => $myTime,		
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

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar', $data);
		echo view('registrar/templates/topbar');
		echo view('registrar/payment/record_payment');
    echo view('registrar/templates/footer');
  }

  public function save() {
    helper(['form', 'url']);
    $p = new PaymentModel();

    $rules = [
      'ay' => [
        'label' => 'Academic Year',
        'rules' => 'required'
      ],
      'payee' => [
        'label' => 'Payer\'s Name',
        'rules' => 'required'
      ],
      'amt' => [
        'label' => 'Amount Paid',
        'rules' => 'required'
      ],
      'type' => [
        'label' => 'Payment Type',
        'rules' => 'required'
      ],
    ];

    if (!$this->validate($rules)) {      
      session()->setTempData('error', 'Please Don\'t leave an unanswered field with a red asterisk(*)!', 3);
      return redirect()->to('r/payment/'.esc($this->request->getPost('s')));
    } else {   
      $bal = $this->request->getPost('bal') - $this->request->getPost('amt');
      
      $data = [
        'acad_year'    => esc($this->request->getPost('ay')),
        'payee'        => esc($this->request->getPost('payee')),
        'amount'       => esc($this->request->getPost('amt')),
        'balance'      => $bal,
        'payment_type' => esc($this->request->getPost('type')),
        'remarks'      => esc($this->request->getPost('remarks')),
        'fee_id'       => esc($this->request->getPost('f')),
        'student_id'   => esc($this->request->getPost('s')),
      ];

      $p->save($data);
      session()->setTempData('success', 'The Payment was successfully saved!', 3);
      return redirect()->to('r/payment/'.esc($this->request->getPost('s')));
    }
  }

  public function searchdate() {
    helper(['form', 'url']);
    $enrollment_model = new EnrollmentModel();
    $c = new ClassModel();
    $p = new PaymentModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();
		$r = new RegistrarModel();

    if($this->validate(['searchdate' => 'required'])){
      $search = [
        'submitted_at' => esc($this->request->getPost('searchdate'))
      ];

      $enrollments = $enrollment_model->select('*')
                                      ->join('students', 'students.student_id = enrollments.student_id')
                                      ->join('students_class', 'students_class.student_id = students.student_id')
                                      ->join('class', 'class.class_id = students_class.class_id')
                                      ->join('students_address', 'students_address.student_id = students.student_id')
                                      ->join('address', 'address.address_id = students_address.address_id')
                                      ->like($search)
                                      ->groupBy('students.student_id')
                                      ->get()
                                      ->getResult();

      $payment = array();
      $total = array();
      foreach ($enrollments as $key => $e) {
        $search = [
          'acad_year'  => $e->acad_year,
          'student_id' => $e->student_id,
        ];
        $ispaid = $p->where($search)
                    ->findAll();
        $amount = $p->where($search)
                    ->orderBy('recorded_at', 'DESC')
                    ->first();
        if(isset($ispaid, $amount) && count($ispaid) > 0 && count($amount) > 0) {
          array_push($payment, 1);
          array_push($total, $amount);
        } else {
          array_push($payment, 0);
          array_push($total, ['balance' => 0]);
        }
      }

      $data = [
        'user'        => $r->find(session()->get('registrar')),
        'enrollments' => $enrollments,
        'class'       => $c->findAll(),
        'payment'     => $payment,
        'total_paid'  => $total,		
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

      echo view('registrar/templates/header');
      echo view('registrar/templates/sidebar', $data);
      echo view('registrar/templates/topbar');
      echo view('registrar/payment/index');
      echo view('registrar/templates/footer');
    } else {
      return redirect()->to('r/payment');
    }
  }

  public function searchclass() {    
    helper(['form', 'url']);
    $enrollment_model = new EnrollmentModel();
    $c = new ClassModel();
    $p = new PaymentModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();
		$r = new RegistrarModel();

    if($this->validate(['searchclass' => 'required'])){
      $search = [
        'students_class.class_id' => esc($this->request->getPost('searchclass'))
      ];

      $enrollments = $enrollment_model->select('*')
                                      ->join('students', 'students.student_id = enrollments.student_id')
                                      ->join('students_class', 'students_class.student_id = students.student_id')
                                      ->join('class', 'class.class_id = students_class.class_id')
                                      ->join('students_address', 'students_address.student_id = students.student_id')
                                      ->join('address', 'address.address_id = students_address.address_id')
                                      ->like($search)
                                      ->groupBy('students.student_id')
                                      ->get()
                                      ->getResult();

      $payment = array();
      $total = array();
      foreach ($enrollments as $key => $e) {
        $search = [
          'acad_year'  => $e->acad_year,
          'student_id' => $e->student_id,
        ];
        $ispaid = $p->where($search)
                    ->findAll();
        $amount = $p->where($search)
                    ->orderBy('recorded_at', 'DESC')
                    ->first();
        if(isset($ispaid, $amount) && count($ispaid) > 0 && count($amount) > 0) {
          array_push($payment, 1);
          array_push($total, $amount);
        } else {
          array_push($payment, 0);
          array_push($total, ['balance' => 0]);
        }
      }

      $data = [
        'user'        => $r->find(session()->get('registrar')),
        'enrollments' => $enrollments,
        'class'       => $c->findAll(),
        'payment'     => $payment,
        'total_paid'  => $total,		
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

      echo view('registrar/templates/header');
      echo view('registrar/templates/sidebar', $data);
      echo view('registrar/templates/topbar');
      echo view('registrar/payment/index');
      echo view('registrar/templates/footer');
    } else {
      return redirect()->to('r/payment');
    }
  }

  public function search() {  
    helper(['form', 'url']);
    $enrollment_model = new EnrollmentModel();
    $c = new ClassModel();
    $p = new PaymentModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();
		$r = new RegistrarModel();

    if($this->validate(['search' => 'required'])){
      $search = [
        'middlename' => esc($this->request->getPost('search')),
        'lastname'   => esc($this->request->getPost('search')),
        'suffix'     => esc($this->request->getPost('search')),
      ];

      $enrollments = $enrollment_model->select('*')
                                      ->join('students', 'students.student_id = enrollments.student_id')
                                      ->join('students_class', 'students_class.student_id = students.student_id')
                                      ->join('class', 'class.class_id = students_class.class_id')
                                      ->join('students_address', 'students_address.student_id = students.student_id')
                                      ->join('address', 'address.address_id = students_address.address_id')
                                      ->like(['firstname' => esc($this->request->getPost('search'))])
                                      ->orlike($search)
                                      ->groupBy('students.student_id')
                                      ->get()
                                      ->getResult();

      $payment = array();
      $total = array();
      foreach ($enrollments as $key => $e) {
        $search = [
          'acad_year'  => $e->acad_year,
          'student_id' => $e->student_id,
        ];
        $ispaid = $p->where($search)
                    ->findAll();
        $amount = $p->where($search)
                    ->orderBy('recorded_at', 'DESC')
                    ->first();
        if(isset($ispaid, $amount) && count($ispaid) > 0 && count($amount) > 0) {
          array_push($payment, 1);
          array_push($total, $amount);
        } else {
          array_push($payment, 0);
          array_push($total, ['balance' => 0]);
        }
      }

      $data = [
        'user'        => $r->find(session()->get('registrar')),
        'enrollments' => $enrollments,
        'class'       => $c->findAll(),
        'payment'     => $payment,
        'total_paid'  => $total,		
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

      echo view('registrar/templates/header');
      echo view('registrar/templates/sidebar', $data);
      echo view('registrar/templates/topbar');
      echo view('registrar/payment/index');
      echo view('registrar/templates/footer');
    } else {
      return redirect()->to('r/payment');
    }
  }  
}