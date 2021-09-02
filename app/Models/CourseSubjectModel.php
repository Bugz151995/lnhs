<?php

namespace App\Models;

use CodeIgniter\Model;


class CourseSubjectModel extends Model {
  protected $table         = 'courses_subjects';
  protected $primaryKey    = 'course_subject_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'course_id', 'subject_id', 'semester'
  ];

  public function getCoursesPerSemester() {
    $db = db_connect();

    $builder = $db->table('courses_subjects');

    return $builder->select('*')
                   ->join('subjects', 'subjects.subject_id = courses_subjects.subject_id')
                   ->join('courses', 'courses.course_id = courses_subjects.course_id')
                   ->join('tracks', 'tracks.track_id = courses.track_id')
                   ->join('strands', 'strands.strand_id = courses.strand_id')
                   ->groupBy('semester')
                   ->get()
                   ->getResult();
  }

  public function getSubjects($course_id, $sem) {
    $db = db_connect();

    $builder = $db->table('courses_subjects');

    return $builder->select('*')
                   ->join('subjects', 'subjects.subject_id = courses_subjects.subject_id')
                   ->join('courses', 'courses.course_id = courses_subjects.course_id')
                   ->join('tracks', 'tracks.track_id = courses.track_id')
                   ->join('strands', 'strands.strand_id = courses.strand_id')
                   ->orderBy('subjects.subject_id', 'ASC')
                   ->where('courses_subjects.course_id', $course_id)
                   ->where('courses_subjects.semester', $sem)
                   ->get()->getResult();
  }
}