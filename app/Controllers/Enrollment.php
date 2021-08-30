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
  }
}