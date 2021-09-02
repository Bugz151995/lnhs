<?php

namespace App\Controllers;

use App\Models\TrackModel;
use App\Models\StrandModel;
use App\Models\SubjectModel;
use App\Models\CoursesModel;
use App\Models\CourseSubjectModel;
use App\Models\TeacherModel;
use App\Models\SectionModel;
use App\Models\ScheduleModel;

class ScheduleManagement extends BaseController{
	public function index() {
    helper(['form', 'url']);

    $track_model         = new TrackModel();
    $course_model        = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();
    $teacher_model       = new TeacherModel();
    $section_model       = new SectionModel();
    $schedule_model      = new ScheduleModel();

    $data = [
      'track'         => $track_model->findAll(),
      'track_strands' => $course_model->getCourses(),
      'courses'       => $coursesubject_model->getCoursesPerSemester(),
      'teachers'      => $teacher_model->findAll(),
      'sections'      => $section_model->findAll(),
      'schedules'     => $schedule_model->getSchedules()
    ];

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar');
		echo view('registrar/templates/topbar');
		echo view('registrar/crs_schedule', $data);
    echo view('registrar/templates/footer');
  }

  public function updateSched() {
    helper(['form', 'url']);
    $schedule_model = new ScheduleModel();
    $track_model         = new TrackModel();
    $course_model        = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();
    $teacher_model       = new TeacherModel();
    $section_model       = new SectionModel();

    $rows = $this->request->getPost('e_row_count');

    $rules = [
      'e_s_acadyear' => 'required|max_length[4]',
      'e_e_acadyear' => 'required|max_length[4]',
      'e_section'    => 'required'
    ];
    
    for ($j=0; $j < $rows; $j++) { 
      $rules['e_st_'.$j]      = 'required';
      $rules['e_et_'.$j]      = 'required';
      $rules['e_d_'.$j]       = 'required';
      $rules['e_teacher_'.$j] = 'required';
      $rules['e_rm_'.$j]      = 'required';
    }
    
    if (!$this->validate($rules)) {
      session()->setFlashData('error', 'Oops! Something went wrong! Please don\'t leave an empty field.');
      
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
        'validation'     => $this->validator
      ];

      echo view('registrar/templates/header');
      echo view('registrar/templates/sidebar');
      echo view('registrar/templates/topbar');
      echo view('registrar/crs_edit_sched', $data);
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
        ];

        $schedule_model->save($schedule);

        $coursesubject = [
          'course_subject_id' => esc($this->request->getPost('e_subject_'.$i)),
          'semester'          => esc($this->request->getPost('e_semester'))
        ];

        $coursesubject_model->save($coursesubject);
      }

      session()->setFlashData('success', 'Schedule has been successfully edited!');
      return redirect()->to('r/crs_schedule');
    }   
  }

  public function editSched() {
    helper(['form', 'url']);

    $track_model         = new TrackModel();
    $course_model        = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();
    $teacher_model       = new TeacherModel();
    $section_model       = new SectionModel();
    $schedule_model      = new ScheduleModel();
    
    $section = $this->request->getPost('section');
    $sem = $this->request->getPost('sem');

    $data = [
      'track'          => $track_model->findAll(),
      'track_strands'  => $course_model->getCourses(),
      'courses'        => $coursesubject_model->getCoursesPerSemester(),
      'teachers'       => $teacher_model->findAll(),
      'sections'       => $section_model->findAll(),
      'schedules'      => $schedule_model->getSchedules(),
      'section_scheds' => $schedule_model->getSectionSched($section, $sem)
    ];

    $schedule_id = $this->request->getPost('schedule_id');

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar');
		echo view('registrar/templates/topbar');
		echo view('registrar/crs_schedule', $data);
    echo view('registrar/crs_edit_sched');
    echo view('registrar/templates/footer');
	}

  public function setSched() {
    $schedule_model = new ScheduleModel();

    $rows = $this->request->getPost('row_count');

    $rules = [
      's_acadyear' => 'required|max_length[4]',
      'e_acadyear' => 'required|max_length[4]',
      'section'    => 'required'
    ];
    
    for ($j=0; $j < $rows; $j++) { 
      $rules['st_'.$j]      = 'required';
      $rules['et_'.$j]      = 'required';
      $rules['d_'.$j]       = 'required';
      $rules['teacher_'.$j] = 'required';
      $rules['rm_'.$j]      = 'required';
    }
    
    if (!$this->validate($rules)) {
      helper(['form', 'url']);
      session()->setFlashData('error', 'Oops! Something went wrong! Please don\'t leave an empty field.');
      $course_id = $this->request->getPost('crs_id');
      $sem = $this->request->getPost('sem');
      $course = $this->request->getPost('course');

      $track_model         = new TrackModel();
      $course_model        = new CoursesModel();
      $coursesubject_model = new CourseSubjectModel();
      $teacher_model       = new TeacherModel();
      $section_model       = new SectionModel();
      
      $data = [
        'track'           => $track_model->findAll(),
        'track_strands'   => $course_model->getCourses(),
        'courses'         => $coursesubject_model->getCoursesPerSemester(),
        'subjects'        => $coursesubject_model->getSubjects($course_id, $sem),
        'teachers'        => $teacher_model->findAll(),
        'sections'        => $section_model->findAll(),
        'selected_course' => $course,
        'course_id'       => $course_id,
        'sem'             => $sem,
        'validation'      => $this->validator,
        'schedules'       => $schedule_model->getSchedules()
      ];

      echo view('registrar/templates/header');
      echo view('registrar/templates/sidebar');
      echo view('registrar/templates/topbar');
      echo view('registrar/crs_schedule', $data);
      echo view('registrar/templates/footer');

    } else {
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
        ];

        $schedule_model->save($data);
      }

      session()->setFlashData('success', 'Schedule has been successfully set!');
      return redirect()->to('r/crs_schedule');
    }   
  }

  public function viewSched() {
    helper(['form', 'url']);
    $course_id = $this->request->getPost('crs_id');
    $sem = $this->request->getPost('sem');
    $course = $this->request->getPost('course');

    $track_model         = new TrackModel();
    $course_model        = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();
    $teacher_model       = new TeacherModel();
    $section_model       = new SectionModel();
    $schedule_model      = new ScheduleModel();
    
    $data = [
      'track'           => $track_model->findAll(),
      'track_strands'   => $course_model->getCourses(),
      'courses'         => $coursesubject_model->getCoursesPerSemester(),
      'subjects'        => $coursesubject_model->getSubjects($course_id, $sem),
      'teachers'        => $teacher_model->findAll(),
      'sections'        => $section_model->findAll(),
      'selected_course' => $course,
      'course_id'       => $course_id,
      'sem'             => $sem,
      'schedules'      => $schedule_model->getSchedules()
    ];

    echo view('registrar/templates/header');
    echo view('registrar/templates/sidebar');
		echo view('registrar/templates/topbar');
		echo view('registrar/crs_schedule', $data);
    echo view('registrar/templates/footer');
  }

  public function addSection() {
    helper(['form', 'url']);

    $track_model         = new TrackModel();
    $course_model        = new CoursesModel();
    $coursesubject_model = new CourseSubjectModel();
    $teacher_model       = new TeacherModel();
    $section_model       = new SectionModel();

    $rules = [
      'course'       => [
        'label'  => 'Course',
        'rules'  => 'required'
      ],
      'section_name' => [
        'label'  => 'Section Name',
        'rules'  => 'required|is_unique[sections.section_name]',
        'errors' => [
          'is_unique' => 'The Section already exists.'
        ]
      ]
    ];

    if(!$this->validate($rules)){
      session()->setFlashData('error', 'Oops! Something went wrong. ');

      $data = [
        'track'         => $track_model->findAll(),
        'track_strands' => $course_model->getCourses(),
        'courses'       => $coursesubject_model->getCoursesPerSemester(),
        'teachers'      => $teacher_model->findAll(),
        'sections'      => $section_model->findAll(),
        'validation'    => $this->validator
      ];

      echo view('registrar/templates/header');
      echo view('registrar/templates/sidebar');
      echo view('registrar/templates/topbar');
      echo view('registrar/crs_schedule', $data);
      echo view('registrar/templates/footer');
    } else {
      $section = [
        'course_id'    => $this->request->getPost('course'),
        'section_name' => $this->request->getPost('section_name'),
      ];

      $section_model->save($section);

      session()->setFlashData('success', 'New Section has been successfully added!');
      return redirect()->to('r/crs_schedule');
    }    
  }
}