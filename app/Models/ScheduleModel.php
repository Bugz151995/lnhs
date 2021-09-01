<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleModel extends Model {
  protected $table         = 'schedules';
  protected $primaryKey    = 'schedule_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'acad_year', 'start_time', 'dismiss_time', 'days', 'room', 'teacher_id', 'course_subject_id', 'section_id'
  ];

  public function getSchedules() {
    $db = db_connect();

    $builder = $db->table('schedules');

    return $builder->select('*')
                   ->join('teachers', 'teachers.teacher_id = schedules.teacher_id')
                   ->join('courses_subjects', 'courses_subjects.course_subject_id = schedules.course_subject_id')
                   ->join('sections', 'sections.section_id = schedules.section_id')
                   ->groupBy('courses_subjects.semester')
                   ->get()
                   ->getResult();
  }

  public function getSectionSched($section, $sem) {
    $db = db_connect();

    $builder = $db->table('schedules');

    return $builder->select('*')
                   ->join('teachers', 'teachers.teacher_id = schedules.teacher_id')
                   ->join('courses_subjects', 'courses_subjects.course_subject_id = schedules.course_subject_id')
                   ->join('sections', 'sections.section_id = schedules.section_id')
                   ->join('subjects', 'subjects.subject_id = courses_subjects.subject_id')
                   ->orderBy('schedules.schedule_id', 'ASC')
                   ->where('schedules.section_id', $section)
                   ->where('courses_subjects.semester', $sem)
                   ->get()
                   ->getResult();
  }
}