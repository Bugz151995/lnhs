<?php

namespace App\Controllers;

use \App\Models\StudentModel;
use \App\Models\AddressModel;
use \App\Models\StudentAddressModel;
use \App\Models\PersonModel;
use \App\Models\RelationModel;
use \App\Models\EnrollmentModel;
use \App\Models\SectionModel;
use \App\Models\StudentSectionModel;
use \App\Models\CoursesModel;
use \App\Models\TransfereeReturneeModel;

class Assessment extends BaseController {
  public function index() {
    helper(['form', 'url']);
    $section_model = new SectionModel();
    $course_model = new CoursesModel();

    $data = [
      'sections' => $section_model->findAll(),
      'courses'  => $course_model->getCourses()
    ];

		echo view('registrar/templates/header');
		echo view('registrar/templates/topbar');
		echo view('registrar/enrollment', $data);
		echo view('registrar/templates/footer');
  }

  public function success() {
    echo view('student/success');
  }

  public function viewEnrollment($student_id) {
    helper(['form', 'url']);
    $section_model            = new SectionModel();
    $course_model             = new CoursesModel();
    $enrollment_model         = new EnrollmentModel();
    $person_model             = new PersonModel();
    $transfereereturnee_model = new TransfereeReturneeModel();

    $data = [
      'sections'              => $section_model->findAll(),
      'courses'               => $course_model->getCourses(),
      'enrollments'           => $enrollment_model->getStudentEnrollment($student_id),
      'relatives'             => $person_model->select('*')
                                              ->join('relations', 'relations.person_id = persons.person_id')
                                              ->where('relations.student_id', $student_id)
                                              ->get()->getResult(),
      'returnee_transferee'   => $transfereereturnee_model->select('*')
                                                          ->where('student_id', $student_id)
                                                          ->get()->getResult(),
      
    ];

    session()->setFlashData('student_id', $student_id);

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar');
		echo view('registrar/templates/topbar');
		echo view('registrar/assessment', $data);
    echo view('registrar/templates/footer');
  }

  public function updateEnrollment() {
    helper(['form', 'url']);

    $student_model            = new StudentModel();
    $person_model             = new PersonModel();
    $relation_model           = new RelationModel();
    $enrollment_model         = new EnrollmentModel();
    $address_model            = new AddressModel();
    $student_add_model        = new StudentAddressModel();
    $student_section_model    = new StudentSectionModel();
    $section_model            = new SectionModel();
    $course_model             = new CoursesModel();
    $transfereereturnee_model = new TransfereeReturneeModel();
    
    
    $rules = [
      'firstname'          => 'required',
      'middlename'         => 'required',
      'lastname'           => 'required',
      'suffix'             => 'required',
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
      'gradelevel'         => 'required',
      'section'            => 'required',
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
      session()->setFlashData('error', 'Update failed! Session has been reset. Please don\'t leave an unanswered field.');
      return redirect()->to('r/enrollments');
    } else {
      // GET STUDENT DATA AND UPDATE
      $student = [
        'student_id' => esc($this->request->getPost('student_id')),
        'firstname'  => esc($this->request->getPost('firstname')),
        'middlename' => esc($this->request->getPost('middlename')),
        'lastname'   => esc($this->request->getPost('lastname')),
        'sex'        => esc($this->request->getPost('sex')),
        'suffix'     => esc($this->request->getPost('suffix')),
        'birthdate'  => esc($this->request->getPost('bday')),
        'age'        => esc($this->request->getPost('age')),
        'religion'   => esc($this->request->getPost('religion')),
      ];

      $student_model->save($student);

      // GET RETURNEE OR TRANSFEREE DATA AND UPDATE
      $last_gradelevel = $this->request->getPost('hea');
      $year_completed  = $this->request->getPost('hea_ay');
      $school_name     = $this->request->getPost('prev_school');
      $school_address  = $this->request->getPost('prev_school_address');
      $returnee_transferee_id = $this->request->getPost('returnee_transferee_id');
      
      $returnee_transferee = [
        'transferee_returnee_id' => esc($returnee_transferee_id),
        'student_id'             => esc($this->request->getPost('student_id')),
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
        'enrollment_id'     => esc($this->request->getPost('enrollment_id')),
        'learning_modality' => esc($this->request->getPost('modality')),
        'grade_level'       => esc($this->request->getPost('gradelevel')),
        'student_id'        => esc($this->request->getPost('student_id')),
        'course_id'         => esc($this->request->getPost('course')),
        'semester'          => esc($this->request->getPost('semester')),
        'status'            => esc($this->request->getPost('status'))
      ];

      $enrollment_model->save($enrollment);

      // GET ADDRESS, CHECK IF IT EXIST, IF YES THEN GET ID AND SAVE, IF NO THEN SAVE.
      $address = [
        'address_id'        => esc($this->request->getPost('address_id')),
        'street'            => esc($this->request->getPost('street')),
        'barangay'          => esc($this->request->getPost('barangay')),
        'city_municipality' => esc($this->request->getPost('mun_city')),
        'province'          => esc($this->request->getPost('province')),
      ];
      
      // check if the address exist
      $address_model->save($address);

      $student_address = [
        'student_address_id' => esc($this->request->getPost('student_address_id')),
        'address_id'         => esc($this->request->getPost('address_id')),
        'student_id'         => esc($this->request->getPost('student_id'))
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
            'student_id' => esc($this->request->getPost('student_id')),
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

      // get section and save
      $section = [
        'student_section_id' => esc($this->request->getPost('student_section_id')),
        'section_id'         => esc($this->request->getPost('section')),
        'student_id'         => esc($this->request->getPost('student_id'))
      ];

      $student_section_model->save($section);

      session()->setFlashData('success', 'Update Successful!');
      // display success message
      return redirect()->to('r/enrollments');
    }
  }

  public function evaluation() {
    helper(['form', 'url']);
    $section_model = new SectionModel();
    $course_model = new CoursesModel();

    $data = [
      'sections' => $section_model->findAll(),
      'courses'  => $course_model->getCourses()
    ];

		echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar');
		echo view('registrar/templates/topbar');
		echo view('registrar/evaluation');
    echo view('registrar/templates/footer');
  }
}