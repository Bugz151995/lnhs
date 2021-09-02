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

class VoucherManagement extends BaseController {
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
		echo view('student/esc_registration', $data);
		echo view('student/templates/footer');
  }
}