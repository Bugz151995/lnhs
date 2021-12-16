<?php

namespace App\Controllers;

use \App\Models\StudentModel;
use \App\Models\AddressModel;
use \App\Models\StudentAddressModel;
use \App\Models\PersonModel;
use \App\Models\RelationModel;
use \App\Models\EnrollmentModel;
use \App\Models\ClassModel;
use \App\Models\StudentClassModel;
use \App\Models\CoursesModel;
use \App\Models\TransfereeReturneeModel;
use \App\Models\TokenRequestModel;
use \App\Models\StudentSchedulesModel;
use \App\Models\EscGrantModel;
use \App\Models\RegistrarModel;
use CodeIgniter\I18n\Time;

class Enrollment extends BaseController
{
  public function index()
  {
    helper('form');
    echo view('student/templates/header');
    echo view('student/templates/topbar');
    echo view('student/enrollment_type');
    echo view('student/templates/footer');
  }

  public function typeNewEnrollment()
  {
    helper(['form', 'url']);
    $class_model = new ClassModel();
    $course_model = new CoursesModel();
    $myTime = new Time('now', 'Asia/Manila', 'en_US');

    $data = [
      'class' => $class_model->findAll(),
      'courses'  => $course_model->getCourses(),
      'now'      => $myTime
    ];

    echo view('student/templates/header');
    echo view('student/templates/topbar');
    echo view('student/new_request_token', $data);
    echo view('student/templates/footer');
  }

  public function typeOldEnrollment()
  {
    helper(['form', 'url']);
    $class_model = new ClassModel();
    $course_model = new CoursesModel();
    $myTime = new Time('now', 'Asia/Manila', 'en_US');

    $data = [
      'class' => $class_model->findAll(),
      'courses'  => $course_model->getCourses(),
      'now'      => $myTime
    ];

    echo view('student/templates/header');
    echo view('student/templates/topbar');
    echo view('student/old_request_token', $data);
    echo view('student/templates/footer');
  }

  public function typeNewRequest()
  {
    helper(['form', 'url']);
    $student_model       = new StudentModel();
    $request_model       = new TokenRequestModel();
    $student_class_model = new StudentClassModel();

    $rules = [
      'user_img'   => 'uploaded[user_img]|is_image[user_img]',
      'firstname'  => 'required',
      'middlename' => 'required',
      'lastname'   => 'required',
      'class'      => 'required',
      'email'      => 'required',
      'sy'         => 'required',
      'sem'        => 'required',
    ];

    if ($this->validate($rules)) {
      $isEmailUsed = $student_model->select('student_id')
        ->getWhere(['email' => esc($this->request->getPost('email'))])
        ->getRowArray();

      $student = [
        'firstname'  => esc($this->request->getPost('firstname')),
        'middlename' => esc($this->request->getPost('middlename')),
        'lastname'   => esc($this->request->getPost('lastname')),
        'suffix'     => esc($this->request->getPost('suffix'))
      ];

      $isStudentOld = $student_model->select('student_id')
        ->getWhere($student)
        ->getRowArray();

      if ((isset($isEmailUsed) && count($isEmailUsed) > 0) && (isset($isStudentOld) && count($isStudentOld) > 0)) {
        session()->setTempData('error', 'Student Data Found! You have selected the wrong type of enrollment, Please select Old Student', 3);
        return redirect()->to('enrollment');
      } else {
        $file = $this->request->getFile('user_img');
        $rand_name = $file->getRandomName();
        $path = site_url() . 'assets/students/' . $rand_name;
        $file->move('assets/students/', $rand_name);

        $student = [
          'user_img'    => esc($path),
          'firstname'   => esc($this->request->getPost('firstname')),
          'middlename'  => esc($this->request->getPost('middlename')),
          'lastname'    => esc($this->request->getPost('lastname')),
          'contact_num' => esc($this->request->getPost('contact_num')),
          'email'       => esc($this->request->getPost('email'))
        ];

        $student_name = [
          'firstname'   => esc($this->request->getPost('firstname')),
          'middlename'  => esc($this->request->getPost('middlename')),
          'lastname'    => esc($this->request->getPost('lastname')),
          'suffix'      => esc($this->request->getPost('suffix'))
        ];

        $student_record = $student_model->select('student_id')
          ->getWhere($student_name)
          ->getRowArray();

        if (isset($student_record) && count($student_record) > 0) {
          $student['student_id'] = $student_record['student_id'];
        }

        $student_model->save($student);

        $sid = (isset($student_record) && count($student_record) > 0) ? esc($student_record['student_id']) : $student_model->insertID();

        $sy = $request_model->select('student_id')
          ->getWhere([
            'acad_year'  => esc($this->request->getPost('sy')),
            'student_id' => esc($sid),
            'semester'   => esc($this->request->getPost('sem'))
          ])
          ->getRowArray();

        if (isset($sy) && count($sy) > 0) {
          session()->setTempData('error', 'You can only request a Token once in a Semester!', 3);
          return redirect()->to('enrollment');
        } else {
          $request = [
            'valid_id'   => esc($path),
            'student_id' => esc($sid),
            'token'      => esc(''),
            'acad_year'  => esc($this->request->getPost('sy')),
            'semester'   => esc($this->request->getPost('sem')),
            'status'     => esc('pending')
          ];

          $req = $request_model->select('token_request_id')
            ->getWhere(['student_id' => esc($sid)])
            ->getRowArray();

          if (isset($req) && count($req) > 0) {
            $request['token_request_id'] = $req['token_request_id'];
          }

          $request_model->save($request);

          $sc = [
            'student_id' => esc($sid),
            'class_id'   => esc($this->request->getPost('class'))
          ];

          $screq = $student_class_model->select('student_class_id')
            ->getWhere(['student_id' => esc($sid)])
            ->getRowArray();

          if (isset($screq) && count($screq) > 0) {
            $sc['student_class_id'] = esc($screq['student_class_id']);
          }

          $student_class_model->save($sc);
          session()->setTempData('success', 'Token Request Successful! The token has been sent to your Email address.', 3);
          return redirect()->to('/');
        }
      }
    } else {
      helper(['form', 'url']);
      $class_model = new ClassModel();
      $course_model = new CoursesModel();
      $myTime = new Time('now', 'Asia/Manila', 'en_US');

      $data = [
        'class' => $class_model->findAll(),
        'courses'  => $course_model->getCourses(),
        'now'      => $myTime
      ];

      session()->setTempData('error', 'Please Don\'t leave a field with a red asterisk unanswered.', 3);
      echo view('student/templates/header');
      echo view('student/templates/topbar');
      echo view('student/new_request_token', $data);
      echo view('student/templates/footer');
    }
  }

  public function typeOldRequest()
  {
    helper(['form', 'url']);
    $student_model       = new StudentModel();
    $request_model       = new TokenRequestModel();
    $student_class_model = new StudentClassModel();

    $rules = [
      'user_img'   => 'uploaded[user_img]|is_image[user_img]',
      'firstname'  => 'required',
      'middlename' => 'required',
      'lastname'   => 'required',
      'class'      => 'required',
      'sy'         => 'required',
      'sem'        => 'required',
    ];

    if ($this->validate($rules)) {
      $student_name = [
        'firstname'   => esc($this->request->getPost('firstname')),
        'middlename'  => esc($this->request->getPost('middlename')),
        'lastname'    => esc($this->request->getPost('lastname')),
        'suffix'      => esc($this->request->getPost('suffix'))
      ];

      $student_record = $student_model->select('student_id')
        ->getWhere($student_name)
        ->getRowArray();

      if (!isset($student_record)) {
        session()->setTempData('error', 'Student Not Found! You have selected the wrong type of enrollment, Please select New Student', 3);
        return redirect()->to('enrollment');
      } else {
        $sid = esc($student_record['student_id']);

        $sy = $request_model->select('student_id')
          ->getWhere([
            'acad_year'  => esc($this->request->getPost('sy')),
            'student_id' => esc($sid),
            'semester'   => esc($this->request->getPost('sem'))
          ])
          ->getRowArray();

        if (isset($sy) && count($sy) > 0) {
          session()->setTempData('error', 'You have already sent a request for the token this Semester!', 3);
          return redirect()->to('enrollment');;
        } else {
          $file = $this->request->getFile('user_img');
          $rand_name = $file->getRandomName();
          $path = site_url() . 'assets/students/' . $rand_name;
          $file->move('assets/students/', $rand_name);

          $request = [
            'valid_id'   => esc($path),
            'student_id' => esc($sid),
            'token'      => esc(''),
            'acad_year'  => esc($this->request->getPost('sy')),
            'semester'   => esc($this->request->getPost('sem')),
            'status'     => esc('pending')
          ];

          $request_model->save($request);

          $sc = [
            'student_id' => esc($sid),
            'class_id'   => esc($this->request->getPost('class'))
          ];

          $screq = $student_class_model->select('student_class_id')
            ->getWhere(['student_id' => esc($sid)])
            ->getRowArray();

          if (isset($screq) && count($screq) > 0) {
            $sc['student_class_id'] = esc($screq['student_class_id']);
          }

          $student_class_model->save($sc);
          session()->setTempData('success', 'Token Request Successful! The token has been sent to your Email address.', 3);
          return redirect()->to('/');
        }
      }
    } else {
      helper(['form', 'url']);
      $class_model = new ClassModel();
      $course_model = new CoursesModel();
      $myTime = new Time('now', 'Asia/Manila', 'en_US');

      $data = [
        'class' => $class_model->findAll(),
        'courses'  => $course_model->getCourses(),
        'now'      => $myTime
      ];

      session()->setTempData('error', 'Please Don\'t leave a field with a red asterisk unanswered.', 3);
      echo view('student/templates/header');
      echo view('student/templates/topbar');
      echo view('student/old_request_token', $data);
      echo view('student/templates/footer');
    }
  }

  public function success()
  {
    echo view('student/success');
  }

  public function viewEnrollments()
  {
    helper(['form', 'url']);
    $enrollment_model = new EnrollmentModel();
    $r = new RegistrarModel();
    $c = new ClassModel();
    $sc = new StudentSchedulesModel();
    $en = new EnrollmentModel();
    $esc = new EscGrantModel();

    $enrollments = $enrollment_model->select('*')
      ->join('students', 'students.student_id = enrollments.student_id')
      ->join('students_class', 'students_class.student_id = students.student_id')
      ->join('class', 'class.class_id = students_class.class_id')
      ->join('students_address', 'students_address.student_id = students.student_id')
      ->join('address', 'address.address_id = students_address.address_id')
      ->groupBy('enrollments.student_id, enrollments.acad_year, enrollments.semester')
      ->get()
      ->getResult();

    $sched_status = array();
    foreach ($enrollments as $key => $e) {
      $search = [
        'semester'   => $e->semester,
        'acad_year'  => $e->acad_year,
        'student_id' => $e->student_id,
      ];
      $res = $sc->where($search)
        ->findAll();

      if (isset($res) && count($res) > 0) {
        array_push($sched_status, 1);
      } else array_push($sched_status, 0);
    }

    $data = [
      'user'        => $r->find(session()->get('registrar')),
      'enrollments' => $enrollments,
      'class'       => $c->findAll(),
      'schedule'    => $sched_status,
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
    echo view('registrar/assessment/index');
    echo view('registrar/templates/footer');
  }

  public function searchdate()
  {
    helper(['form', 'url']);
    $r = new RegistrarModel();
    $enrollment_model = new EnrollmentModel();
    $c = new ClassModel();
    $en = new EnrollmentModel();
    $esc = new EscGrantModel();

    if (!$this->validate(['searchdate' => 'required'])) {
      return redirect()->to('r/enrollments');
    } else {
      $search = [
        'submitted_at' => esc($this->request->getPost('searchdate'))
      ];
      $data = [
        'user'        => $r->find(session()->get('registrar')),
        'enrollments' => $enrollment_model->select('*')
          ->join('students', 'students.student_id = enrollments.student_id')
          ->join('students_class', 'students_class.student_id = students.student_id')
          ->join('class', 'class.class_id = students_class.class_id')
          ->join('students_address', 'students_address.student_id = students.student_id')
          ->join('address', 'address.address_id = students_address.address_id')
          ->groupBy('students.student_id')
          ->like($search)
          ->get()
          ->getResult(),
        'class'       => $c->findAll(),
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
      echo view('registrar/assessment/index');
      echo view('registrar/templates/footer');
    }
  }

  public function searchclass()
  {
    helper(['form', 'url']);

    if (!$this->validate(['searchclass' => 'required'])) {
      return redirect()->to('r/enrollments');
    } else {
      $en = new EnrollmentModel();
      $esc = new EscGrantModel();
      $enrollment_model = new EnrollmentModel();
      $c = new ClassModel();

      $search = [
        'class.class_id' => esc($this->request->getPost('searchclass'))
      ];
      $data = [
        'enrollments' => $enrollment_model->select('*')
          ->join('students', 'students.student_id = enrollments.student_id')
          ->join('students_class', 'students_class.student_id = students.student_id')
          ->join('class', 'class.class_id = students_class.class_id')
          ->join('students_address', 'students_address.student_id = students.student_id')
          ->join('address', 'address.address_id = students_address.address_id')
          ->groupBy('students.student_id')
          ->like($search)
          ->get()
          ->getResult(),
        'class'       => $c->findAll(),
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
      echo view('registrar/assessment/index');
      echo view('registrar/templates/footer');
    }
  }

  public function search()
  {
    helper(['form', 'url']);

    if (!$this->validate(['search' => 'required'])) {
      return redirect()->to('r/enrollments');
    } else {
      $en = new EnrollmentModel();
      $esc = new EscGrantModel();
      $enrollment_model = new EnrollmentModel();
      $c = new ClassModel();

      $search = [
        'middlename' => esc($this->request->getPost('search')),
        'lastname'   => esc($this->request->getPost('search')),
        'suffix'     => esc($this->request->getPost('search')),
      ];
      $data = [
        'enrollments' => $enrollment_model->select('*')
          ->join('students', 'students.student_id = enrollments.student_id')
          ->join('students_class', 'students_class.student_id = students.student_id')
          ->join('class', 'class.class_id = students_class.class_id')
          ->join('students_address', 'students_address.student_id = students.student_id')
          ->join('address', 'address.address_id = students_address.address_id')
          ->groupBy('students.student_id')
          ->like(['firstname'  => esc($this->request->getPost('search'))])
          ->orlike($search)
          ->get()
          ->getResult(),
        'class'       => $c->findAll(),
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
      echo view('registrar/assessment/index');
      echo view('registrar/templates/footer');
    }
  }

  public function create()
  {
    helper(['form', 'url']);

    $student_model            = new StudentModel();
    $person_model             = new PersonModel();
    $relation_model           = new RelationModel();
    $enrollment_model         = new EnrollmentModel();
    $address_model            = new AddressModel();
    $student_add_model        = new StudentAddressModel();
    $student_class_model      = new StudentClassModel();
    $class_model              = new ClassModel();
    $course_model             = new CoursesModel();
    $transfereereturnee_model = new TransfereeReturneeModel();

    $new_student_rules = [
      'user_img'   => 'uploaded[user_img]|is_image[user_img]',
      'firstname'  => 'required',
      'middlename' => 'required',
      'lastname'   => 'required',
      'bday'       => 'required',
      'age'        => 'required',
      'sex'        => 'required',
      'religion'   => 'required',
      'modality'   => 'required',
      'street'     => 'required',
      'barangay'   => 'required',
      'mun_city'   => 'required',
      'province'   => 'required',
      'zip'        => 'required',
      'modality'   => 'required',
      'semester'   => 'required',
      'gradelevel' => 'required',
      'course'     => 'required',
      'sy'         => 'required',
      'class'      => 'required',
    ];

    $old_student_rules = [
      'modality'   => 'required',
      'semester'   => 'required',
      'gradelevel' => 'required',
      'course'     => 'required',
      'sy'         => 'required',
      'class'      => 'required',
    ];

    $isEnrolled = $enrollment_model->select('student_id')->getWhere(['student_id' => $this->request->getPost('s')])->getResult();

    $rules = NULL;
    if (isset($isEnrolled) && count($isEnrolled) > 0) {
      $rules = $old_student_rules;
    } else {
      $rules = $new_student_rules;
      for ($i = 0; $i < 2; $i++) {
        $rules['firstname_' . $i]      = 'required';
        $rules['lastname_' . $i]       = 'required';
        $rules['middlename_' . $i]     = 'required';
      }
    }

    if (!$this->validate($rules)) {
      $student_model = new StudentModel();
      $myTime = new Time('now', 'Asia/Manila', 'en_US');

      $query = $student_model->select('*')
        ->join('token_requests', 'token_requests.student_id = students.student_id')
        ->join('students_class', 'students_class.student_id = students.student_id')
        ->join('class', 'class.class_id = students_class.class_id')
        ->getWhere(['token' => session()->get('token')])
        ->getResult();
      $data = [
        'validation' => $this->validator,
        'student'    => $query,
        'class'      => $class_model->findAll(),
        'courses'    => $course_model->getCourses(),
        'now'        => $myTime
      ];

      session()->setTempData('error', 'Oops Something went wrong. Please don\'t leave an unanswered required field.', 3);
      echo view('student/templates/header');
      echo view('student/templates/topbar');

      if (isset($isEnrolled) && count($isEnrolled) > 0) {
        echo view('student/old_enrollment_form', $data);
      } else {
        echo view('student/new_enrollment_form', $data);
      }

      echo view('student/templates/footer');
    } else {
      $student_id = $this->request->getPost('s');

      if (isset($isEnrolled) && count($isEnrolled) > 0) {
        // GET ENROLLMENT AND SAVE
        $enrollment = [
          'learning_modality' => esc($this->request->getPost('modality')),
          'grade_level'       => esc($this->request->getPost('gradelevel')),
          'acad_year'         => esc($this->request->getPost('sy')),
          'student_id'        => esc($student_id),
          'course_id'         => esc($this->request->getPost('course')),
          'semester'          => esc($this->request->getPost('semester')),
          'status'            => esc('pending'),
        ];

        $enrollment_model->save($enrollment);

        session()->destroy();
        // display success message
        return redirect()->to('enrollment/success');
      } else {
        // GET STUDENT DATA AND SAVE
        $file = $this->request->getFile('user_img');
        $rand_name = $file->getRandomName();
        $path = site_url() . 'assets/students/' . $rand_name;
        $file->move('assets/students/', $rand_name);
        $student = [
          'student_id'  => esc($student_id),
          'user_img'    => esc($path),
          'firstname'   => esc($this->request->getPost('firstname')),
          'middlename'  => esc($this->request->getPost('middlename')),
          'lastname'    => esc($this->request->getPost('lastname')),
          'sex'         => esc($this->request->getPost('sex')),
          'suffix'      => esc($this->request->getPost('suffix')),
          'birthdate'   => esc($this->request->getPost('bday')),
          'birthplace'  => esc($this->request->getPost('bplace')),
          'age'         => esc($this->request->getPost('age')),
          'religion'    => esc($this->request->getPost('religion')),
          'nationality' => esc($this->request->getPost('natl')),
        ];

        $student_model->save($student);

        // GET RETURNEE OR TRANSFEREE DATA AND SAVE
        $last_gradelevel = $this->request->getPost('hea');
        $year_completed  = $this->request->getPost('hea_ay');
        $school_name     = $this->request->getPost('prev_school');
        $school_address  = $this->request->getPost('prev_school_address');

        if (isset($last_gradelevel, $year_completed, $school_name, $school_address)) {
          $returnee_transferee = [
            'student_id'      => esc($student_id),
            'last_gradelevel' => esc($this->request->getPost('hea')),
            'year_completed'  => esc($this->request->getPost('hea_ay')),
            'school_name'     => esc($this->request->getPost('prev_school')),
            'school_address'  => esc($this->request->getPost('prev_school_address')),
          ];

          $transfereereturnee_model->save($returnee_transferee);
        }

        // GET ADDRESS, CHECK IF IT EXIST, IF YES THEN GET ID AND SAVE, IF NO THEN SAVE.
        $address = [
          'street'            => esc($this->request->getPost('street')),
          'barangay'          => esc($this->request->getPost('barangay')),
          'city_municipality' => esc($this->request->getPost('mun_city')),
          'province'          => esc($this->request->getPost('province')),
          'zip_code'          => esc($this->request->getPost('zip')),
        ];

        // check if the address exist
        $address_record = $address_model->isDuplicate($address);
        if (count($address_record) != 0) {
          $address_id = $address_record[0]->address_id;
        } else {
          $address_model->save($address);
          $address_id = $address_model->insertID();
        }

        $said = null;
        // check if the student address exist
        $student_add_record = $student_add_model->isDuplicate(['student_id' => esc($student_id)]);
        if (count($student_add_record) != 0) {
          $said = $student_add_record[0]->student_address_id;
        }

        $student_address = [
          'student_address_id' => $said,
          'address_id' => esc($address_id),
          'student_id' => esc($student_id)
        ];

        $student_add_model->save($student_address);

        // get parent/guardian and save
        for ($i = 0; $i < 3; $i++) {
          $firstname      = $this->request->getPost('firstname_' . $i);
          $middlename     = $this->request->getPost('middlename_' . $i);
          $lastname       = $this->request->getPost('lastname_' . $i);
          $contact_number = $this->request->getPost('contact_number_' . $i);

          if (isset($firstname, $middlename, $lastname, $contact_number)) {
            $persons = [
              'lastname'       => esc($this->request->getPost('lastname_' . $i)),
              'firstname'      => esc($this->request->getPost('firstname_' . $i)),
              'middlename'     => esc($this->request->getPost('middlename_' . $i)),
              'contact_number' => esc($this->request->getPost('contact_number_' . $i)),
            ];

            $person_name = [
              'lastname'       => esc($this->request->getPost('lastname_' . $i)),
              'firstname'      => esc($this->request->getPost('firstname_' . $i)),
              'middlename'     => esc($this->request->getPost('middlename_' . $i)),
            ];

            $person_record = $person_model->isDuplicate($person_name);
            if (count($person_record) != 0) {
              $person_id = $person_record[0]->person_id;
            } else {
              $person_model->save($persons);
              $person_id = $person_model->insertID();
            }

            $relationship = [
              'student_id' => esc($student_id),
              'person_id'  => esc($person_id),
              'relationship' => esc($this->request->getPost('relationship_' . $i))
            ];

            $relation_model->save($relationship);
          }
        }

        // GET ENROLLMENT AND SAVE
        $enrollment = [
          'learning_modality' => esc($this->request->getPost('modality')),
          'grade_level'       => esc($this->request->getPost('gradelevel')),
          'acad_year'         => esc($this->request->getPost('sy')),
          'student_id'        => esc($student_id),
          'course_id'         => esc($this->request->getPost('course')),
          'semester'          => esc($this->request->getPost('semester')),
          'status'            => esc('pending'),
        ];

        $enrollment_model->save($enrollment);

        session()->destroy();
        // display success message
        return redirect()->to('enrollment/success');
      }
    }
  }

  public function auth($token = NULL)
  {
    if ($token === NULL) {
      return redirect()->to('/');
    }

    $student_model    = new StudentModel();
    $enrollment_model = new EnrollmentModel();

    $query = $student_model->select('*')
      ->join('token_requests', 'token_requests.student_id = students.student_id')
      ->join('students_class', 'students_class.student_id = students.student_id')
      ->join('class', 'class.class_id = students_class.class_id')
      ->getWhere(['token' => $token])
      ->getResult();

    session()->set('token', $token);

    if (count($query) > 0) {
      helper(['form', 'url']);
      $class_model = new ClassModel();
      $course_model = new CoursesModel();
      $myTime = new Time('now', 'Asia/Manila', 'en_US');

      $data = [
        'class'    => $class_model->findAll(),
        'courses'  => $course_model->getCourses(),
        'student'  => $query,
        'now'      => $myTime
      ];

      $isEnrolled = $enrollment_model->select('student_id')->getWhere(['student_id' => $query[0]->student_id])->getResult();

      echo view('student/templates/header');
      echo view('student/templates/topbar');

      if (isset($isEnrolled) && count($isEnrolled) > 0) {
        echo view('student/old_enrollment_form', $data);
      } else {
        echo view('student/new_enrollment_form', $data);
      }

      echo view('student/templates/footer');
    } else {
      session()->setTempData('error', 'You are forbidden to access the form.');
      return redirect()->to('enrollment');
    }
  }
}
