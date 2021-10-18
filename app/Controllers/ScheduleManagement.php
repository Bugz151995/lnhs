<?php

namespace App\Controllers;

use App\Models\TrackModel;
use App\Models\StrandModel;
use App\Models\SubjectModel;
use App\Models\CoursesModel;
use App\Models\CourseSubjectModel;
use App\Models\TeacherModel;
use App\Models\ClassModel;
use App\Models\ScheduleModel;
use \App\Models\EnrollmentModel;
use \App\Models\EscGrantModel;

class ScheduleManagement extends BaseController{
	public function index() {
    helper(['form', 'url']);

    $track_model         = new TrackModel();
    $course_model        = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();
    $teacher_model       = new TeacherModel();
    $section_model       = new ClassModel();
    $schedule_model      = new ScheduleModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();

    $data = [
      'track'         => $track_model->findAll(),
      'track_strands' => $course_model->getCourses(),
      'courses'       => $course_model->select('*')
                                      ->join('tracks', 'tracks.track_id = courses.track_id')
                                      ->join('strands', 'strands.strand_id = courses.strand_id')
                                      ->get()->getResult(),
      'teachers'      => $teacher_model->findAll(),
      'sections'      => $section_model->findAll(),
      'schedules'     => $schedule_model->getSchedules(),		
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
		echo view('registrar/schedule/crs_schedule');
    echo view('registrar/templates/footer');
  }

  public function updateSched() {
    helper(['form', 'url']);
    $schedule_model      = new ScheduleModel();
    $track_model         = new TrackModel();
    $course_model        = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();
    $teacher_model       = new TeacherModel();
    $section_model       = new ClassModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();

    $rows = $this->request->getPost('e_row_count');

    $rules = [
      'e_s_acadyear' => 'required|min_length[4]|max_length[4]',
      'e_e_acadyear' => 'required|min_length[4]|max_length[4]',
      'class'        => 'required'
    ];
    
    for ($j=0; $j < $rows; $j++) { 
      $rules['e_st_'.$j]      = 'required';
      $rules['e_et_'.$j]      = 'required';
      $rules['e_d_'.$j]       = 'required';
      $rules['e_teacher_'.$j] = 'required';
      $rules['e_rm_'.$j]      = 'required';
    }
    
    if (!$this->validate($rules)) {
      session()->setTempData('error', 'Oops! Something went wrong! Please don\'t leave an empty field.', 3);
      
      $section = $this->request->getPost('section');
      $sem = $this->request->getPost('semester');
      
      $data = [
        'track'          => $track_model->findAll(),
        'track_strands'  => $course_model->getCourses(),
        'courses'        => $coursesubject_model->getCoursesPerSemester(),
        'teachers'       => $teacher_model->findAll(),
        'sections'       => $section_model->findAll(),
        'schedules'      => $schedule_model->getSchedules(),
        'section_scheds' => $schedule_model->getSectionSched($section, $sem),
        'validation'     => $this->validator,		
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
      echo view('registrar/schedule/crs_edit_sched');
      echo view('registrar/templates/footer');

    } else {
      for ($i=0; $i < $rows; $i++) { 
        $schedule = [
          'schedule_id'       => esc($this->request->getPost('e_schedule_'.$i)),
          'acad_year'         => esc($this->request->getPost('e_s_acadyear').'-'.$this->request->getPost('e_e_acadyear')),
          'section_id'        => esc($this->request->getPost('e_section')),
          'course_subject_id' => esc($this->request->getPost('e_subject_'.$i)),
          'start_time'        => esc($this->request->getPost('e_st_'.$i)),
          'dismiss_time'      => esc($this->request->getPost('e_et_'.$i)),
          'days'              => esc($this->request->getPost('e_d_'.$i)),
          'teacher_id'        => esc($this->request->getPost('e_teacher_'.$i)),
          'room'              => esc($this->request->getPost('e_rm_'.$i)),
          'class_id'          => esc($this->request->getPost('class')),
        ];

        $schedule_model->save($schedule);

        $coursesubject = [
          'course_subject_id' => esc($this->request->getPost('e_subject_'.$i)),
          'semester'          => esc($this->request->getPost('e_semester'))
        ];

        $coursesubject_model->save($coursesubject);
      }

      session()->setTempData('success', 'Schedule has been successfully edited!', 3);
      return redirect()->to('r/crs_schedule');
    }   
  }

  public function editSched() {
    helper(['form', 'url']);

    $track_model         = new TrackModel();
    $course_model        = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();
    $teacher_model       = new TeacherModel();
    $section_model       = new ClassModel();
    $schedule_model      = new ScheduleModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();
    
    $class = $this->request->getPost('class');
    $sem = $this->request->getPost('sem');

    $data = [
      'track'          => $track_model->findAll(),
      'track_strands'  => $course_model->getCourses(),
      'courses'        => $course_model->getCoursesPerSemester(),
      'teachers'       => $teacher_model->findAll(),
      'sections'       => $section_model->findAll(),
      'schedules'      => $schedule_model->getSchedules(),
      'section_scheds' => $schedule_model->getSectionSched($class, $sem),		
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

    $schedule_id = $this->request->getPost('schedule_id');

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar', $data);
		echo view('registrar/templates/topbar');
		echo view('registrar/schedule/crs_schedule');
    echo view('registrar/schedule/crs_edit_sched');
    echo view('registrar/templates/footer');
	}

  public function setSched() {
    $schedule_model = new ScheduleModel();

    $rows = $this->request->getPost('row_count');

    $rules = [
      's_acadyear' => 'required|max_length[4]',
      'e_acadyear' => 'required|max_length[4]',
      'class'      => 'required'
    ];
    
    for ($j=0; $j < $rows; $j++) { 
      $rules['st_'.$j]      = 'required';
      $rules['et_'.$j]      = 'required';
      $rules['d_'.$j]       = 'required';
      $rules['teacher_'.$j] = 'required';
      $rules['rm_'.$j]      = 'required';
    }
    
    $course_id = $this->request->getPost('crs_id');
    $sem = $this->request->getPost('sem');
    $g   = $this->request->getPost('grade_level');

    if (!$this->validate($rules)) {
      helper(['form', 'url']);
      session()->setTempData('error', 'Oops! Something went wrong! Please don\'t leave an empty field.', 3);
      $course = $this->request->getPost('course');

      $track_model         = new TrackModel();
      $course_model        = new CoursesModel();
      $coursesubject_model = new CourseSubjectModel();
      $teacher_model       = new TeacherModel();
      $section_model       = new ClassModel();
      $en = new EnrollmentModel();
      $esc = new EscGrantModel();
      
      $data = [
        'track'           => $track_model->findAll(),
        'track_strands'   => $course_model->getCourses(),
        'courses'         => $course_model->getCoursesPerSemester(),
        'subjects'        => $coursesubject_model->getSubjects($course_id, $sem, $g),
        'teachers'        => $teacher_model->findAll(),
        'sections'        => $section_model->findAll(),
        'selected_course' => $course,
        'course_id'       => $course_id,
        'sem'             => $sem,
        'validation'      => $this->validator,
        'schedules'       => $schedule_model->getSchedules(),		
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
      echo view('registrar/schedule/crs_schedule', $data);
      echo view('registrar/templates/footer');

    } else {
      $res = $schedule_model->getScheduleWhere($course_id, $sem, $g);

      if(count($res) < 1) {      
        for ($i=0; $i < $rows; $i++) { 
          $data = [
            'acad_year'         => $this->request->getPost('s_acadyear').'-'.$this->request->getPost('e_acadyear'),
            'section_id'        => $this->request->getPost('section'),
            'course_subject_id' => $this->request->getPost('subject_'.$i),
            'start_time'        => $this->request->getPost('st_'.$i),
            'dismiss_time'      => $this->request->getPost('et_'.$i),
            'days'              => $this->request->getPost('d_'.$i),
            'teacher_id'        => $this->request->getPost('teacher_'.$i),
            'room'              => $this->request->getPost('rm_'.$i),
            'class_id'          => $this->request->getPost('class'),
          ];

          $schedule_model->save($data);
        }

        session()->setTempData('success', 'Schedule has been successfully set!', 3);
      } else session()->setTempData('error', 'Schedule has been previously set with this course and semester!', 3);
      return redirect()->to('r/crs_schedule');
    }   
  }

  public function viewSched() {
    helper(['form', 'url']);
    $course_id = $this->request->getPost('crs_id');
    $sem = $this->request->getPost('sem');
    $g = $this->request->getPost('grade');

    $track_model         = new TrackModel();
    $course_model        = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();
    $teacher_model       = new TeacherModel();
    $class_model         = new ClassModel();
    $schedule_model      = new ScheduleModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();
    
    $res = $schedule_model->getScheduleWhere($course_id, $sem, $g);
    $q = $course_model->select('strands.strand_name')
                                ->join('tracks', 'tracks.track_id = courses.track_id')
                                ->join('strands', 'strands.strand_id = courses.strand_id')
                                ->getWhere(['course_id' => $course_id])->getRowArray();

    $semester = ($sem == '1') ? $sem.'st semester' : $sem.'nd semester';
    $sel_course = $q['strand_name'].' ('.$semester.')';

    if(count($res) == 0) {
      $subjects = $coursesubject_model->getSubjects($course_id, $sem, $g);
      $teachers = $teacher_model->findAll();
      if(count($subjects) == 0) { 
        session()->setTempData('error', 'There is no Subjects set for this Course with the selected Grade Level and Semester. Please set up the course first.', 3);
      }
      if(count($teachers) == 0){
        session()->setTempData('error', 'There are no teachers added to the database. Please add teachers first.', 3);
      }
      $data = [
        'track'           => $track_model->findAll(),
        'track_strands'   => $course_model->getCourses(),
        'courses'         => $course_model->getCoursesPerSemester(),
        'subjects'        => $subjects,
        'teachers'        => $teachers,
        'sections'        => $class_model->findAll(),
        'selected_course' => $sel_course,
        'grade_level'     => $this->request->getPost('grade'),
        'course_id'       => $course_id,
        'sem'             => $sem,
        'schedules'       => $schedule_model->getSchedules(),		
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
      echo view('registrar/schedule/crs_schedule');
      echo view('registrar/templates/footer');
    } else { 
      session()->setTempData('warning', 'Schedule has been previously set with this course and semester!', 3);
      return redirect()->to('r/crs_schedule');
    }
  }

  public function addClass() {
    helper(['form', 'url']);

    $track_model         = new TrackModel();
    $course_model        = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();
    $teacher_model       = new TeacherModel();
    $class_model         = new ClassModel();

    $rules = [
      'course'       => [
        'label'  => 'Course',
        'rules'  => 'required'
      ],
      'class_name' => [
        'label'  => 'Class Name',
        'rules'  => 'required|is_unique[class.class_name]',
        'errors' => [
          'is_unique' => 'The Class already exists.'
        ]
      ]
    ];

    if(!$this->validate($rules)){
      session()->setTempData('error', 'Oops! Something went wrong. Please Don\'t leave an unanswered field!', 3);
      return redirect()->to('r/crs_schedule');
    } else {
      $class = [
        'course_id'   => $this->request->getPost('course'),
        'grade_level' => $this->request->getPost('grade'),
        'class_name'  => $this->request->getPost('class_name'),
      ];

      $class_model->save($class);

      session()->setTempData('success', 'A New Class has been successfully added!', 3);
      return redirect()->to('r/crs_schedule');
    }    
  }

  public function search() {
    helper(['form', 'url']);

    $track_model         = new TrackModel();
    $course_model        = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();
    $teacher_model       = new TeacherModel();
    $section_model       = new ClassModel();
    $schedule_model      = new ScheduleModel();
		$en = new EnrollmentModel();
		$esc = new EscGrantModel();

    if(!$this->validate(['search' => 'required'])){
      return redirect()->to('r/crs_schedule');
    } else {
      $search = [
        'strand_name' => esc($this->request->getPost('search')),
        'class_name'  => esc($this->request->getPost('search')),
      ];
      $data = [
        'track'         => $track_model->findAll(),
        'track_strands' => $course_model->getCourses(),
        'courses'       => $course_model->select('*')
                                        ->join('tracks', 'tracks.track_id = courses.track_id')
                                        ->join('strands', 'strands.strand_id = courses.strand_id')
                                        ->get()->getResult(),
        'teachers'      => $teacher_model->findAll(),
        'sections'      => $section_model->findAll(),
        'schedules'     => $schedule_model->select('*')
                                          ->join('courses_subjects', 'courses_subjects.course_subject_id = schedules.course_subject_id')
                                          ->join('courses', 'courses.course_id = courses_subjects.course_id')
                                          ->join('strands', 'strands.strand_id = courses.strand_id')
                                          ->join('class', 'class.class_id = schedules.class_id')
                                          ->groupBy(['schedules.class_id', 'semester'])
                                          ->orlike($search)
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
      echo view('registrar/schedule/crs_schedule');
      echo view('registrar/templates/footer');
    }
  }
}