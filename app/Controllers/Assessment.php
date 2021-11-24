<?php

namespace App\Controllers;

use \App\Models\StudentModel;
use \App\Models\AddressModel;
use \App\Models\StudentAddressModel;
use \App\Models\PersonModel;
use \App\Models\RelationModel;
use \App\Models\ScheduleModel;
use \App\Models\EnrollmentModel;
use \App\Models\ClassModel;
use \App\Models\StudentClassModel;
use \App\Models\StudentSchedulesModel;
use \App\Models\EscGrantModel;
use App\Models\TeacherModel;
use \App\Models\CoursesModel;
use \App\Models\RegistrarModel;
use \App\Models\TransfereeReturneeModel;
use CodeIgniter\I18n\Time;

class Assessment extends BaseController {
  public function index() {
    helper(['form', 'url']);
    $class_model = new ClassModel();
    $course_model = new CoursesModel();

    $data = [
      'class' => $class_model->findAll(),
      'courses'  => $course_model->getCourses()
    ];

		echo view('registrar/templates/header');
		echo view('registrar/templates/topbar');
		echo view('registrar/enrollments', $data);
		echo view('registrar/templates/footer');
  }

  public function success() {
    echo view('student/success');
  }

  public function viewEnrollment($student_id) {
    helper(['form', 'url']);
    $myTime = new Time('now', 'Asia/Manila', 'en_US');
		$r                        = new RegistrarModel();
    $class_model              = new ClassModel();
    $course_model             = new CoursesModel();
    $enrollment_model         = new EnrollmentModel();
    $person_model             = new PersonModel();
    $transfereereturnee_model = new TransfereeReturneeModel();
    $en                       = new EnrollmentModel();
    $esc                      = new EscGrantModel();

    $data = [
			'user'                => $r->find(session()->get('registrar')),	
      'class'               => $class_model->findAll(),
      'courses'             => $course_model->getCourses(),
      'enrollments'         => $enrollment_model->getStudentEnrollment($student_id),
      'relatives'           => $person_model->select('*')
                                            ->join('relations', 'relations.person_id = persons.person_id')
                                            ->where('relations.student_id', $student_id)
                                            ->get()->getResult(),
      'returnee_transferee' => $transfereereturnee_model->select('*')
                                                        ->where('student_id', $student_id)
                                                        ->get()->getResult(),
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
      'now'     => $myTime
    ];

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar', $data);
		echo view('registrar/templates/topbar');
		echo view('registrar/assessment/assessment');
    echo view('registrar/templates/footer');
  }

  public function updateEnrollment() {
    helper(['form', 'url']);    
    
    $rules = [
      'user_img'           => 'permit_empty|is_image[user_img]',
      'firstname'          => 'required',
      'middlename'         => 'required',
      'lastname'           => 'required',
      'bday'               => 'required',
      'age'                => 'required',
      'sex'                => 'required',
      'religion'           => 'required',
      'modality'           => 'required',
      'street'             => 'required',
      'barangay'           => 'required',
      'mun_city'           => 'required',
      'province'           => 'required',
      'modality'           => 'required',
      'semester'           => 'required',
      'sy'                 => 'required',
      'gradelevel'         => 'required',
      'class'              => 'required',
      'course'             => 'required',
      'isdocumentcomplete' => 'required',
      'status'             => 'required',
    ];

    for ($i=0; $i < 2; $i++) { 
      $rules['firstname_'.$i]      = 'required';
      $rules['lastname_'.$i]       = 'required';
      $rules['middlename_'.$i]     = 'required';
      $rules['contact_number_'.$i] = 'required';
    }

    if(!$this->validate($rules)) {
      session()->setTempData('validation', $this->validator, 3);
      return redirect()->to('r/assessment/'.esc($this->request->getPost('s')));
    } else {
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

      $file = $this->request->getFile('user_img');

      // GET STUDENT DATA AND UPDATE
      $student = [
        'student_id' => esc($this->request->getPost('s')),
        'lrn'        => esc($this->request->getPost('lrn')),
        'firstname'  => esc($this->request->getPost('firstname')),
        'middlename' => esc($this->request->getPost('middlename')),
        'lastname'   => esc($this->request->getPost('lastname')),
        'sex'        => esc($this->request->getPost('sex')),
        'suffix'     => esc($this->request->getPost('suffix')),
        'birthdate'  => esc($this->request->getPost('bday')),
        'age'        => esc($this->request->getPost('age')),
        'religion'   => esc($this->request->getPost('religion')),
      ];

      if ($file->isValid()) {
        $rand_name = $file->getRandomName();
        $path = site_url().'assets/students/'.$rand_name;
        $file->move('assets/students/', $rand_name);
        $student['user_img'] = $path;
      }      

      $student_model->save($student);

      // GET RETURNEE OR TRANSFEREE DATA AND UPDATE
      $last_gradelevel        = $this->request->getPost('hea');
      $year_completed         = $this->request->getPost('hea_ay');
      $school_name            = $this->request->getPost('prev_school');
      $school_address         = $this->request->getPost('prev_school_address');
      $returnee_transferee_id = $this->request->getPost('rt');
      
      $returnee_transferee = [
        'transferee_returnee_id' => esc($returnee_transferee_id),
        'student_id'             => esc($this->request->getPost('s')),
        'last_gradelevel'        => esc($last_gradelevel),
        'year_completed'         => esc($year_completed),
        'school_name'            => esc($school_name),
        'school_address'         => esc($school_address),
      ];

      if(isset($last_gradelevel, $year_completed, $school_name, $school_address, $returnee_transferee_id)){
        $transfereereturnee_model->save($returnee_transferee);
      }

      // GET ENROLLMENT AND UPDATE
      $enrollment = [
        'enrollment_id'      => esc($this->request->getPost('e')),
        'learning_modality'  => esc($this->request->getPost('modality')),
        'acad_year'          => esc($this->request->getPost('sy')),
        'student_id'         => esc($this->request->getPost('s')),
        'course_id'          => esc($this->request->getPost('course')),
        'semester'           => esc($this->request->getPost('semester')),
        'status'             => esc($this->request->getPost('status')),
        'isdocumentcomplete' => esc($this->request->getPost('isdocumentcomplete')),
      ];

      $enrollment_model->save($enrollment);

      // GET ADDRESS, CHECK IF IT EXIST, IF YES THEN GET ID AND SAVE, IF NO THEN SAVE.
      $address = [
        'address_id'        => esc($this->request->getPost('a')),
        'street'            => esc($this->request->getPost('street')),
        'barangay'          => esc($this->request->getPost('barangay')),
        'city_municipality' => esc($this->request->getPost('mun_city')),
        'province'          => esc($this->request->getPost('province')),
      ];
      
      // check if the address exist
      $address_model->save($address);

      $student_address = [
        'student_address_id' => esc($this->request->getPost('sa')),
        'address_id'         => esc($this->request->getPost('a')),
        'student_id'         => esc($this->request->getPost('s'))
      ];

      $student_add_model->save($student_address);    
      
      // get parent/guardian and save
      $father_id = $this->request->getPost('father_id');
      $mother_id = $this->request->getPost('mother_id');
      $guardian_id = $this->request->getPost('guardian_id');

      $f_relation_id = $this->request->getPost('father_r_id');
      $m_relation_id = $this->request->getPost('mother_r_id');
      $g_relation_id = $this->request->getPost('guardian_r_id');

      for ($i=0; $i < 3; $i++) { 
        $firstname      = $this->request->getPost('firstname_'.$i);
        $middlename     = $this->request->getPost('middlename_'.$i);
        $lastname       = $this->request->getPost('lastname_'.$i);
        $contact_number = $this->request->getPost('contact_number_'.$i);

        if(isset($firstname, $middlename, $lastname, $contact_number)) {

          $persons = [
            'lastname'       => esc($this->request->getPost('lastname_'.$i)),
            'firstname'      => esc($this->request->getPost('firstname_'.$i)),
            'middlename'     => esc($this->request->getPost('middlename_'.$i)),
            'contact_number' => esc($this->request->getPost('contact_number_'.$i)),
          ];

          $relationship = [
            'student_id' => esc($this->request->getPost('s')),
            'relationship' => esc($this->request->getPost('relationship_'.$i))
          ];
          
          switch ($i) {
            case 0:
              if(isset($father_id)) { 
                $persons['person_id'] = esc($father_id);
              }
              $person_model->save($persons);
              
              if(isset($f_relation_id)) {
                $relationship['relation_id'] = esc($f_relation_id);
                $relationship['person_id'] = esc($father_id);
              } else $relationship['person_id'] = $person_model->insertID();
              $relation_model->save($relationship);
              break;
            case 1:
              if(isset($mother_id)) { 
                $persons['person_id'] = esc($mother_id);
              }
              $person_model->save($persons);
              
              if(isset($m_relation_id)) {
                $relationship['relation_id'] = esc($m_relation_id);
                $relationship['person_id'] = esc($mother_id);
              } else $relationship['person_id'] = $person_model->insertID();
              $relation_model->save($relationship);
              break;
            case 2:
              if(isset($guardian_id)) { 
                $persons['person_id'] = esc($guardian_id); 
              }
              $person_model->save($persons);

              if(isset($g_relation_id)) {
                $relationship['relation_id'] = esc($g_relation_id);
                $relationship['person_id'] = esc($guardian_id);
              } else $relationship['person_id'] = $person_model->insertID();
              $relation_model->save($relationship);
              break;
            default:
              # code...
              break;
          }
        }
      }

      session()->setTempData('success', 'Update Successful!', 3);
      // display success message
      return redirect()->to('r/assessment/'.esc($this->request->getPost('s')));
    }
  }

  public function evaluation($student_id) {
    helper(['form', 'url']);
		$r                   = new RegistrarModel();
    $c                   = new ClassModel();
    $course_model        = new CoursesModel();
    $student_model       = new StudentModel();
    $schedule_model      = new ScheduleModel();
    $teacher_model       = new TeacherModel();

    $en = new EnrollmentModel();
    $esc = new EscGrantModel();

    $student_data = $student_model->join('students_class', 'students_class.student_id = students.student_id')
                                  ->join('class', 'class.class_id = students_class.class_id')
                                  ->join('courses', 'courses.course_id = class.course_id')
                                  ->join('tracks', 'tracks.track_id = courses.track_id')
                                  ->join('strands', 'strands.strand_id = courses.strand_id')
                                  ->join('enrollments', 'enrollments.student_id = students.student_id')
                                  ->find(esc($student_id));
    $data = [
			'user'           => $r->find(session()->get('registrar')),	
      'class'          => $c->findAll(),
      'courses'        => $course_model->getCourses(),
      'student_id'     => esc($student_id),
      'student'        => $student_data,
      'teachers'       => $teacher_model->findAll(),
      'section_scheds' => $schedule_model->getSectionSched($student_data['class_id'], $student_data['semester']),
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
		echo view('registrar/assessment/evaluation');
    echo view('registrar/templates/footer');
  }

  public function saveEvaluation() {
    $sc = new StudentSchedulesModel();

    $schedules = $this->request->getPost('e_schedule');
    $search = [
      'semester'   => esc($this->request->getPost('sem')),
      'acad_year'  => esc($this->request->getPost('ay')),
      'student_id' => esc($this->request->getPost('s')),
    ];
    $res = $sc->where($search)
              ->findAll();
              
    if(isset($res) && count($res) > 0) {
      session()->setTempData('error', 'The Schedule of the Student has already been set!', 3);
      return redirect()->to('r/enrollments');
    } else {
      foreach ($schedules as $key => $sched) {
        $data = [
          'schedule_id' => esc($sched),
          'student_id'  => esc($this->request->getPost('s')),
          'semester'   => esc($this->request->getPost('sem')),
          'acad_year'  => esc($this->request->getPost('ay')),
        ];
        $sc->save($data);
      }

      session()->setTempData('success', 'The Schedule of the Student has been successfully saved!', 3);
      return redirect()->to('r/enrollments');
    }
  }
}