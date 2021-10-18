<?php

namespace App\Controllers;

use App\Models\TrackModel;
use App\Models\StrandModel;
use App\Models\SubjectModel;
use App\Models\CoursesModel;
use App\Models\CourseSubjectModel;
use App\Models\ScheduleModel;
use App\Models\StudentScheduleModel;
use \App\Models\EnrollmentModel;
use \App\Models\EscGrantModel;

class CourseManagement extends BaseController{
	public function index() {
    helper(['form', 'url']);

    $track_model         = new TrackModel();
    $course_model        = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();
    
    $data = [
      'track'         => $track_model->findAll(),
      'track_strands' => $course_model->select('courses.course_id, strands.strand_id, tracks.track_name, strands.strand_name, courses.added_at')
                                      ->orderBy('courses.track_id', 'ASC')
                                      ->groupBy('courses.course_id')
                                      ->join('tracks', 'tracks.track_id = courses.track_id')
                                      ->join('strands', 'strands.strand_id = courses.strand_id')
                                      ->get()
                                      ->getResult(),
      'course'        => $course_model->select('*')
                                      ->join('courses_subjects', 'courses_subjects.course_id = courses.course_id')
                                      ->groupBy(['strands.strand_id', 'semester'])
                                      ->join('tracks', 'tracks.track_id = courses.track_id')
                                      ->join('strands', 'strands.strand_id = courses.strand_id')
                                      ->get()
                                      ->getResult(),				
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
		echo view('registrar/course/crs_mgt');
    echo view('registrar/templates/footer');
	}

  public function deleteSubject($subject, $course_subject) {
    $subject_model       = new SubjectModel();
    $coursesubject_model = new CourseSubjectModel();
    $schedule_model      = new ScheduleModel();

    $schedule_id = $schedule_model->select('schedule_id')
                                  ->where('course_subject_id', $course_subject)
                                  ->get()
                                  ->getResult();
                                 
    if (count($schedule_id) != 0) {
      $schedule_model->delete($schedule_id[0]->schedule_id);
    }
    $coursesubject_model->delete($course_subject);
    $subject_model->delete($subject);

    session()->setTempData('info', 'The subject has been deleted successfully!', 3);
    return redirect()->to('r/crs_mgt');
  }

  public function updateCourse() {
    helper(['form', 'url']);

    // instantiate database model
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();
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
        session()->setTempData('error', 'Oops! Something went wrong. Please don\'t leave an empty field.', 3);
        session()->setFlashData('row_count', $row_count);

        $course_id = $this->request->getPost('course');
        $sem       = $this->request->getPost('semester');
        $g         = $this->request->getPost('grade');

        $data = [
          'track'         => $track_model->findAll(),
          'track_strands' => $course_model->select('courses.course_id, strands.strand_id, tracks.track_name, strands.strand_name, courses.added_at')
                                          ->orderBy('courses.track_id', 'ASC')
                                          ->groupBy('courses.course_id')
                                          ->join('tracks', 'tracks.track_id = courses.track_id')
                                          ->join('strands', 'strands.strand_id = courses.strand_id')
                                          ->get()
                                          ->getResult(),
          'course'        => $course_model->select('*')
                                          ->join('courses_subjects', 'courses_subjects.course_id = courses.course_id')
                                          ->groupBy(['strands.strand_id', 'semester'])
                                          ->join('tracks', 'tracks.track_id = courses.track_id')
                                          ->join('strands', 'strands.strand_id = courses.strand_id')
                                          ->get()
                                          ->getResult(),
          'subjects'      => $coursesubject_model->getSubjects($course_id, $sem, $g),
          'sel_courseid'  => $course_id,
          'sel_sem'       => $sem,
          'validation'    => $this->validator,				
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
        echo view('registrar/course/crs_mgt');
        echo view('registrar/course/crs_edit_course');
        echo view('registrar/templates/footer');
      } else {
        // get subjects data
        $row_count = $this->request->getPost('row_count');
        $a = 1;
        $subjects = array();
        $crs_subj = array();
        while ($a <= $row_count) {
          $temp = [
            'subject_id'       => esc($this->request->getPost('subjectid_'.$a)),
            'subject_category' => esc($this->request->getPost('category_'.$a)),
            'subject_code'     => esc($this->request->getPost('code_'.$a)),
            'subject_name'     => esc($this->request->getPost('name_'.$a)),
          ];
          $temp2 = [
            'course_subject_id' => esc($this->request->getPost('crs_subjectid_'.$a)),
            'course_id'         => esc($this->request->getPost('course')),
            'subject_id'        => esc($this->request->getPost('subjectid_'.$a)),
            'grade_level'       => esc($this->request->getPost('grade')),
            'semester'          => esc($this->request->getPost('semester')),
          ];
          array_push($crs_subj, $temp2);
          array_push($subjects, $temp);
          $a++;
        }

        $subject_model->updateBatch($subjects, 'subject_id');
        $coursesubject_model->updateBatch($crs_subj, 'course_subject_id');
        session()->setTempData('success', 'The Course has been successfully saved!', 3);

        return redirect()->to('r/crs_mgt');
      }
    }
  }

  public function editCourse() {
    helper(['form', 'url']);

    $track_model         = new TrackModel();
    $course_model        = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();
    
    $course_id = $this->request->getPost('course');
    $sem = $this->request->getPost('semester');
    $g = $this->request->getPost('grade');

    if ($course_id === NULL && $sem === NULL) {
      $course_id = $this->request->getPost('crs');
      $sem = $this->request->getPost('sem');
    }

    $data = [
      'track'         => $track_model->findAll(),
      'track_strands' => $course_model->select('courses.course_id, strands.strand_id, tracks.track_name, strands.strand_name, courses.added_at')
                                      ->orderBy('courses.track_id', 'ASC')
                                      ->groupBy('courses.course_id')
                                      ->join('tracks', 'tracks.track_id = courses.track_id')
                                      ->join('strands', 'strands.strand_id = courses.strand_id')
                                      ->get()
                                      ->getResult(),
      'course'        => $course_model->select('*')
                                      ->join('courses_subjects', 'courses_subjects.course_id = courses.course_id')
                                      ->groupBy(['strands.strand_id', 'semester'])
                                      ->join('tracks', 'tracks.track_id = courses.track_id')
                                      ->join('strands', 'strands.strand_id = courses.strand_id')
                                      ->get()
                                      ->getResult(),
      'subjects'      => $coursesubject_model->getSubjects($course_id, $sem, $g),
      'sel_courseid'  => $course_id,
      'sel_sem'       => $sem,				
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
		echo view('registrar/course/crs_mgt');
		echo view('registrar/course/crs_edit_course');
    echo view('registrar/templates/footer');
	}

  public function setCourse() {
    helper(['form', 'url']);

    // instantiate database model
    $track_model = new TrackModel();
    $strand_model = new StrandModel();
    $subject_model = new SubjectModel();
    $course_model = new CoursesModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();
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
        'semester' => 'required',
        'grade'    => 'required'
      ];

      for ($i = 0; $i < $row_count; $i++) {
        $rules[$category[$i]] = 'required';
        $rules[$code[$i]]     = 'required';
        $rules[$name[$i]]     = 'required';
      }

      if (!$this->validate($rules)) {
        session()->setTempData('error', 'Oops! Something went wrong. Please don\'t leave an empty field.', 3);
        session()->setFlashData('row_count', $row_count);

        $data = [
          'track'         => $track_model->findAll(),
          'track_strands' => $course_model->getCourses(),
          'course'        => $coursesubject_model->getCoursesPerSemester(),
          'validation'    => $this->validator,				
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
        echo view('registrar/course/crs_mgt');
        echo view('registrar/templates/footer');
      } else {
        // get subjects data
        $row_count = $this->request->getPost('row_count');
        $subject_id = array();
        $a = 1;
        
        while ($a <= $row_count) {
          $subjects = [
            'subject_category' => esc(trim($this->request->getPost('category_'.$a))),
            'subject_code'     => esc(trim($this->request->getPost('code_'.$a))),
            'subject_name'     => esc(trim($this->request->getPost('name_'.$a))),
          ];

          $s = [
            'subject_code'     => esc(trim($this->request->getPost('code_'.$a)))
          ];

          $subject = $subject_model->isDuplicate($s);

          if(count($subject) > 0) {
            $subjects['subject_id'] = esc($subject[0]->subject_id);
          }

          $subject_model->save($subjects);

          if(count($subject) > 0) {
            array_push($subject_id, $subject[0]->subject_id);
          } else {
            array_push($subject_id, $subject_model->insertID());
          }
          $a++;
        }
        
        for ($j=0; $j < count($subject_id); $j++) { 
          $courses_subjects = [
            'course_id'   => esc($this->request->getPost('course')),
            'subject_id'  => esc($subject_id[$j]),
            'grade_level' => esc($this->request->getPost('grade')),
            'semester'    => esc($this->request->getPost('semester'))
          ];
          $coursesubject_model->save($courses_subjects);
        }

        session()->setTempData('success', 'New Course has been successfully saved!', 3);

        return redirect()->to('r/crs_mgt');
      }
    }
  }

  public function createCourse() {
    helper(['form', 'url']);

    $track_model = new TrackModel();
    $strand_model = new StrandModel();
    $course_model = new CoursesModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();
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
      session()->setTempData('error', 'Oops! Something went wrong. ', 3);

      $data = [
        'track' => $track_model->findAll(),
        'strand' => $strand_model->findAll(),
        'track_strands' => $course_model->getCourses(),
        'course' => $coursesubject_model->getCoursesPerSemester(),
        'validation' => $this->validator,		
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
      echo view('registrar/templates/sidebar');
      echo view('registrar/templates/topbar');
      echo view('registrar/course/crs_mgt', $data);
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
  
        session()->setTempData('success', 'New Course has been successfully added!', 3);

        return redirect()->to('r/crs_mgt');
    }    
  }

  public function search() {    
    helper(['form', 'url']);

    if (!$this->validate(['searchstrand' => 'required'])) {
      return redirect()->to('r/crs_mgt');
    } else {
      $track_model         = new TrackModel();
      $course_model        = new CoursesModel();
      $en = new EnrollmentModel();
      $esc = new EscGrantModel();
      $coursesubject_model = new CourseSubjectModel();
      
      $data = [
        'track'         => $track_model->findAll(),
        'track_strands' => $course_model->select('courses.course_id, strands.strand_id, tracks.track_name, strands.strand_name, courses.added_at')
                                        ->orderBy('courses.track_id', 'ASC')
                                        ->groupBy('courses.course_id')
                                        ->join('tracks', 'tracks.track_id = courses.track_id')
                                        ->join('strands', 'strands.strand_id = courses.strand_id')
                                        ->get()
                                        ->getResult(),
        'course'        => $course_model->select('*')
                                        ->join('courses_subjects', 'courses_subjects.course_id = courses.course_id')
                                        ->groupBy(['strands.strand_id', 'semester'])
                                        ->join('tracks', 'tracks.track_id = courses.track_id')
                                        ->join('strands', 'strands.strand_id = courses.strand_id')
                                        ->like(['strands.strand_id' => esc($this->request->getPost('searchstrand'))])
                                        ->get()
                                        ->getResult(),		
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
      echo view('registrar/templates/sidebar');
      echo view('registrar/templates/topbar');
      echo view('registrar/course/crs_mgt', $data);
      echo view('registrar/templates/footer');
    }    
  }
}