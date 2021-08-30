<?php

namespace App\Controllers;

use App\Models\TrackModel;
use App\Models\StrandModel;
use App\Models\SubjectModel;
use App\Models\CoursesModel;
use App\Models\CourseSubjectModel;

class ScheduleManagement extends BaseController{
	public function index() {
    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar');
		echo view('registrar/templates/topbar');
		echo view('registrar/crs_schedule');
    echo view('registrar/templates/footer');
  }

  public function updateCourse() {
  }

  public function editCourse() {
	}

  public function setCourse() {
  }

  public function createCourse() {
  }
}