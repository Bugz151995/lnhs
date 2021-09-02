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

class Assessment extends BaseController {
  public function index() {
    helper(['form', 'url']);
    $section_model = new SectionModel();
    $course_model = new CoursesModel();

    $data = [
      'sections' => $section_model->findAll(),
      'courses'  => $course_model->getCourses()
    ];

		echo view('student/templates/header');
		echo view('student/templates/topbar');
		echo view('student/enrollment', $data);
		echo view('student/templates/footer');
  }

  public function success() {
    echo view('student/success');
  }

  public function viewEnrollment($student_id) {
    helper(['form', 'url']);
    $section_model = new SectionModel();
    $course_model = new CoursesModel();
    $enrollment_model = new EnrollmentModel();
    $person_model     = new PersonModel();

    $data = [
      'sections'    => $section_model->findAll(),
      'courses'     => $course_model->getCourses(),
      'enrollments' => $enrollment_model->getStudentEnrollment($student_id),
      'relatives'   => $person_model->select('*')
                                    ->join('relations', 'relations.person_id = persons.person_id')
                                    ->where('relations.student_id', $student_id)
                                    ->get()->getResult()
    ];

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar');
		echo view('registrar/templates/topbar');
		echo view('registrar/assessment', $data);
    echo view('registrar/templates/footer');
  }

  public function updateEnrollment() {
    helper(['form', 'url']);

    $student_model         = new StudentModel();
    $person_model          = new PersonModel();
    $relation_model        = new RelationModel();
    $enrollment_model      = new EnrollmentModel();
    $address_model         = new AddressModel();
    $student_add_model     = new StudentAddressModel();
    $student_section_model = new StudentSectionModel();
    $section_model         = new SectionModel();
    $course_model          = new CoursesModel();
    
    $rules = [
      'user_img'   => 'uploaded[user_img]|is_image[user_img]',
      'firstname'  => 'required',
      'middlename' => 'required',
      'lastname'   => 'required',
      'suffix'     => 'required',
      'bday'       => 'required',
      'age'        => 'required',
      'sex'        => 'required',
      'religion'   => 'required',
      'modality'   => 'required',
      'street'     => 'required',
      'barangay'   => 'required',
      'mun_city'   => 'required',
      'province'   => 'required',
      'modality'   => 'required',
      'semester'   => 'required',
      'gradelevel' => 'required',
      'section'    => 'required',
      'course'     => 'required',
    ];

    for ($i=0; $i < 2; $i++) { 
      $rules['firstname_'.$i]      = 'required';
      $rules['lastname_'.$i]       = 'required';
      $rules['middlename_'.$i]     = 'required';
      $rules['contact_number_'.$i] = 'required';
    }

    if(!$this->validate($rules)) {
      $data = [
        'validation' => $this->validator,
        'sections' => $section_model->findAll(),
        'courses'  => $course_model->getCourses()
      ];

      echo view('student/templates/header');
      echo view('student/templates/topbar');
      echo view('student/enrollment', $data);
      echo view('student/templates/footer');
    } else {
      // GET STUDENT DATA AND SAVE
      $file = $this->request->getFile('user_img');
      $rand_name = $file->getRandomName();
      $path = 'assets/students/'.$rand_name;
      $file->move('assets/students/', $rand_name);

      $student = [
        'user_img'   => esc($path),
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
      $student_id = $student_model->insertID();

      // GET ENROLLMENT AND SAVE
      $enrollment = [
        'learning_modality' => esc($this->request->getPost('modality')),
        'grade_level'       => esc($this->request->getPost('gradelevel')),
        'student_id'        => esc($student_id),
        'course_id'         => esc($this->request->getPost('course')),
        'semester'          => esc($this->request->getPost('semester')),
        'status'            => esc('pending'),
      ];

      $enrollment_model->save($enrollment);

      // GET ADDRESS, CHECK IF IT EXIST, IF YES THEN GET ID AND SAVE, IF NO THEN SAVE.
      $address = [
        'street'            => esc($this->request->getPost('street')),
        'barangay'          => esc($this->request->getPost('barangay')),
        'city_municipality' => esc($this->request->getPost('mun_city')),
        'province'          => esc($this->request->getPost('province')),
      ];
      
      // check if the address exist
      $address_record = $address_model->isDuplicate($address);
      if(count($address_record) != 0) {
        $address_id = $address_record[0]->address_id;
      } else {
        $address_model->save($address);
        $address_id = $address_model->insertID();
      }

      $student_address = [
        'address_id' => esc($address_id),
        'student_id' => esc($student_id)
      ];

      $student_add_model->save($student_address);    
      
      // get parent/guardian and save
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
          
          $person_name = [
            'lastname'       => esc($this->request->getPost('lastname_'.$i)),
            'firstname'      => esc($this->request->getPost('firstname_'.$i)),
            'middlename'     => esc($this->request->getPost('middlename_'.$i)),
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
            'person_id'  => esc($person_id)
          ];

          $relation_model->save($relationship);
        }
      }

      // get section and save
      $section = [
        'section_id' => esc($this->request->getPost('section')),
        'student_id' => esc($student_id)
      ];

      $student_section_model->save($section);

      // display success message
      return redirect()->to('enrollment/success');
    }
  }
}