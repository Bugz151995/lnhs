<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleModel extends Model {
  protected $table         = 'schedules';
  protected $primaryKey    = 'schedule_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'acad_year', 'start_time', 'dismiss_time', 'days', 'room', 'teacher_id', 'course_subject_id', 'class_id'
  ];

  public function getSchedules() {
    $db = db_connect();

    $builder = $db->table('schedules');

    return $builder->select('*')
                   ->join('courses_subjects', 'courses_subjects.course_subject_id = schedules.course_subject_id')
                   ->join('courses', 'courses.course_id = courses_subjects.course_id')
                   ->join('strands', 'strands.strand_id = courses.strand_id')
                   ->join('class', 'class.class_id = schedules.class_id')
                   ->groupBy(['schedules.class_id', 'semester'])
                   ->get()
                   ->getResult();
  }

  public function getScheduleWhere($c, $s, $g) {
    $db = db_connect();

    $builder = $db->table('schedules');

    return $builder->select('*')
                   ->join('courses_subjects', 'courses_subjects.course_subject_id = schedules.course_subject_id')
                   ->groupBy('courses_subjects.semester')
                   ->getWhere([
                     'course_id'   => $c,
                     'semester'    => $s,
                     'grade_level' => $g
                   ])
                   ->getResult();
  }

  public function getSectionSched($class, $sem) {
    $db = db_connect();

    $builder = $db->table('schedules');

    return $builder->select('*')
                   ->join('teachers', 'teachers.teacher_id = schedules.teacher_id')
                   ->join('courses_subjects', 'courses_subjects.course_subject_id = schedules.course_subject_id')
                   ->join('class', 'class.class_id = schedules.class_id')
                   ->join('subjects', 'subjects.subject_id = courses_subjects.subject_id')
                   ->orderBy('schedules.schedule_id', 'ASC')
                   ->where('schedules.class_id', $class)
                   ->where('courses_subjects.semester', $sem)
                   ->get()
                   ->getResult();
  }
}