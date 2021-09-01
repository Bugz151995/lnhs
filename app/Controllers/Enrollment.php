<?php

namespace App\Controllers;

use \App\Models\StudentModel;
use \App\Models\AddressModel;
use \App\Models\StudentAddressModel;
use \App\Models\PersonModel;
use \App\Models\RelationModel;

class Enrollment extends BaseController {
  public function index() {
		echo view('registrar/templates/header');
		echo view('registrar/templates/topbar');
		echo view('registrar/enroll_request');
		echo view('registrar/templates/footer');
  }

  public function create() {
    // get student data and save
    $student = [
      'user_img'   => '',
      'firstname'  => $this->request->getPost(),
      'middlename' => $this->request->getPost(),
      'lastname'   => $this->request->getPost(),
      'sex'        => $this->request->getPost(),
      'suffix'     => $this->request->getPost(),
      'birthdate'  => $this->request->getPost(),
      'age'        => $this->request->getPost(),
      'religion'   => $this->request->getPost(),
    ];

    // get address, check if it exist, if yes then get id and save, if no then save.
    $address = [
      'street'            => $this->request->getPost(),
      'barangay'          => $this->request->getPost(),
      'city_municipality' => $this->request->getPost(),
      'province'          => $this->request->getPost(),
    ];

    // get parent/guardian and save
    $persons = [
      'lastname'       => $this->request->getPost(),
      'firstname'      => $this->request->getPost(),
      'middlename'     => $this->request->getPost(),
      'contact_number' => $this->request->getPost(),
    ];

    // get enrollment and save
    $enrollment = [
      'learning_modality' => $this->request->getPost(),
      'grade_level'       => $this->request->getPost(),
      'student_id'        => '',
      'course_id'         => $this->request->getPost(),
      'status'            => 'pending',
    ];

    // get section and save
    $section = [
      'section_id' => $this->request->getPost(),
    ];
  }
}