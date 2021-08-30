<?php

namespace App\Controllers;

use App\Models\TrackModel;
use App\Models\StrandModel;
use App\Models\SubjectModel;
use App\Models\CoursesModel;
use App\Models\CourseSubjectModel;

class CourseManagement extends BaseController{
	public function index() {
    helper(['form', 'url']);

    $track_model         = new TrackModel();
    $course_model        = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();
    
    $data = [
      'track' => $track_model->findAll(),
      'track_strands' => $course_model->getTrackStrands(),
      'course' => $coursesubject_model->getCourses(),
    ];

		echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar');
		echo view('registrar/templates/topbar');
		echo view('registrar/crs_mgt', $data);
    echo view('registrar/templates/footer');
	}

  public function deleteSubject() {
    
  }

  public function updateCourse() {
    helper(['form', 'url']);

    // instantiate database model
    $track_model = new TrackModel();
    $strand_model = new StrandModel();
    $subject_model = new SubjectModel();
    $course_model = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();

    if($this->request->getMethod('post')) {
      $row_count = $this->request->getPost('row_count');

      $category = array();
      $code = array();
      $name = array();

      for ($i=1; $i <= $row_count; $i++) { 
        array_push($category, 'category_'.$i);
        array_push($code, 'code_'.$i);
        array_push($name, 'name_'.$i);
      }

      $rules = [
        'course'   => 'required',
        'semester' => 'required'
      ];

      for ($i = 0; $i < $row_count; $i++) {
        $rules[$category[$i]] = 'required';
        $rules[$code[$i]]     = 'required';
        $rules[$name[$i]]     = 'required';
      }

      if (!$this->validate($rules)) {
        session()->setFlashData('error', 'Oops! Something went wrong. Please don\'t leave an empty field.');
        session()->setFlashData('row_count', $row_count);

        $course_id = $this->request->getPost('course');
        $sem       = $this->request->getPost('semester');

        $data = [
          'track'         => $track_model->findAll(),
          'track_strands' => $course_model->getTrackStrands(),
          'course'        => $coursesubject_model->getCourses(),
          'subjects'      => $coursesubject_model->getSubjects($course_id, $sem),
          'sel_courseid'  => $course_id,
          'sel_sem'       => $sem,
          'validation' => $this->validator
        ];
    
        echo view('registrar/templates/header');
        echo view('registrar/templates/sidebar');
        echo view('registrar/templates/topbar');
        echo view('registrar/crs_mgt', $data);
        echo view('registrar/crs_edit');
        echo view('registrar/templates/footer');
      } else {
        // get subjects data
        $row_count = $this->request->getPost('row_count');
        $subject_id = array();
        $a = 1;
        while ($a <= $row_count) {
          $subjects = [
            'subject_category' => esc($this->request->getPost('category_'.$a)),
            'subject_code'     => esc($this->request->getPost('code_'.$a)),
            'subject_name'     => esc($this->request->getPost('name_'.$a)),
          ];
          $subject_model->replace($subjects);
          array_push($subject_id, $subject_model->insertID());
          $a++;
        }
        
        for ($j=0; $j < count($subject_id); $j++) { 
          $courses_subjects = [
            'course_id'  => esc($this->request->getPost('course')),
            'subject_id' => esc($subject_id[$j]),
            'semester'   => esc($this->request->getPost('semester'))
          ];
          $coursesubject_model->replace($courses_subjects);
        }

        session()->setFlashData('success', 'The Course has been successfully saved!');

        return redirect()->to('r/crs_mgt');
      }
    }
  }

  public function editCourse() {
    helper(['form', 'url']);

    $track_model         = new TrackModel();
    $course_model        = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();
    

    $course_id = $this->request->getPost('crs');
    $sem = $this->request->getPost('sem');

    $data = [
      'track'         => $track_model->findAll(),
      'track_strands' => $course_model->getTrackStrands(),
      'course'        => $coursesubject_model->getCourses(),
      'subjects'      => $coursesubject_model->getSubjects($course_id, $sem),
      'sel_courseid'  => $course_id,
      'sel_sem'       => $sem,
    ];

		echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar');
		echo view('registrar/templates/topbar');
		echo view('registrar/crs_mgt', $data);
		echo view('registrar/crs_edit');
    echo view('registrar/templates/footer');
	}

  public function setCourse() {
    helper(['form', 'url']);

    // instantiate database model
    $track_model = new TrackModel();
    $strand_model = new StrandModel();
    $subject_model = new SubjectModel();
    $course_model = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();

    if($this->request->getMethod('post')) {
      $row_count = $this->request->getPost('row_count');

      $category = array();
      $code = array();
      $name = array();

      for ($i=1; $i <= $row_count; $i++) { 
        array_push($category, 'category_'.$i);
        array_push($code, 'code_'.$i);
        array_push($name, 'name_'.$i);
      }

      $rules = [
        'course'   => 'required',
        'semester' => 'required'
      ];

      for ($i = 0; $i < $row_count; $i++) {
        $rules[$category[$i]] = 'required';
        $rules[$code[$i]]     = 'required';
        $rules[$name[$i]]     = 'required';
      }

      if (!$this->validate($rules)) {
        session()->setFlashData('error', 'Oops! Something went wrong. Please don\'t leave an empty field.');
        session()->setFlashData('row_count', $row_count);

        $data = [
          'track' => $track_model->findAll(),
          'track_strands' => $course_model->getTrackStrands(),
          'course' => $coursesubject_model->getCourses(),
          'validation' => $this->validator
        ];
    
        echo view('registrar/templates/header');
        echo view('registrar/templates/sidebar');
        echo view('registrar/templates/topbar');
        echo view('registrar/crs_mgt', $data);
        echo view('registrar/templates/footer');
      } else {
        // get subjects data
        $row_count = $this->request->getPost('row_count');
        $subject_id = array();
        $a = 1;
        while ($a <= $row_count) {
          $subjects = [
            'subject_category' => esc($this->request->getPost('category_'.$a)),
            'subject_code'     => esc($this->request->getPost('code_'.$a)),
            'subject_name'     => esc($this->request->getPost('name_'.$a)),
          ];
          $subject_model->save($subjects);
          array_push($subject_id, $subject_model->insertID());
          $a++;
        }
        
        for ($j=0; $j < count($subject_id); $j++) { 
          $courses_subjects = [
            'course_id'  => esc($this->request->getPost('course')),
            'subject_id' => esc($subject_id[$j]),
            'semester'   => esc($this->request->getPost('semester'))
          ];
          $coursesubject_model->save($courses_subjects);
        }

        session()->setFlashData('success', 'New Course has been successfully saved!');

        return redirect()->to('r/crs_mgt');
      }
    }
  }

  public function createCourse() {
    helper(['form', 'url']);

    $track_model = new TrackModel();
    $strand_model = new StrandModel();
    $course_model = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();
    
    $rules = [
      'track'  => 'required',
      'strand' => [
        'rules'  => 'required|is_unique[strands.strand_name]',
        'errors' => [
          'is_unique' => 'The strand already exists.'
        ]
      ]
    ];

    if(!$this->validate($rules)) {
      session()->setFlashData('error', 'Oops! Something went wrong. ');

      $data = [
        'track' => $track_model->findAll(),
        'strand' => $strand_model->findAll(),
        'track_strands' => $course_model->getTrackStrands(),
        'course' => $coursesubject_model->getCourses(),
        'validation' => $this->validator
      ];
  
      echo view('registrar/templates/header');
      echo view('registrar/templates/sidebar');
      echo view('registrar/templates/topbar');
      echo view('registrar/crs_mgt', $data);
      echo view('registrar/templates/footer');
    } else {
        // get strand data
        $strand_data = [
          'strand_name' => esc($this->request->getPost('strand'))
        ];
        // save strand data
        $strand_model->save($strand_data);
  
        // get course data
        $course_data = [
          'track_id' => esc($this->request->getPost('track')),
          'strand_id' => esc($strand_model->insertID()),
        ];
        // save course data
        $course_model->save($course_data);
  
        session()->setFlashData('success', 'New Course has been successfully added!');

        return redirect()->to('r/crs_mgt');
    }    
  }
}