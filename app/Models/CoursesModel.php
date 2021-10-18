<?php

namespace App\Models;

use CodeIgniter\Model;


class CoursesModel extends Model {
  protected $table         = 'courses';
  protected $primaryKey    = 'course_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'track_id', 'strand_id'
  ];

  public function getCourses() {
    $db = db_connect();

    $builder = $db->table('courses');

    return $builder->select('courses.course_id, tracks.track_name, strands.strand_name, courses.added_at')
                   ->orderBy('courses.track_id', 'ASC')
                   ->groupBy('courses.course_id')
                   ->join('tracks', 'tracks.track_id = courses.track_id')
                   ->join('strands', 'strands.strand_id = courses.strand_id')
                   ->join('courses_subjects', 'courses_subjects.course_id = courses.course_id')
                   ->get()
                   ->getResult();
  }

  public function getCoursesPerSemester() {
    $db = db_connect();

    $builder = $db->table('courses');

    return $builder->select('*')
                   ->join('courses_subjects', 'courses_subjects.course_id = courses.course_id')
                   ->groupBy(['strands.strand_id', 'semester'])
                   ->join('tracks', 'tracks.track_id = courses.track_id')
                   ->join('strands', 'strands.strand_id = courses.strand_id')
                   ->get()
                   ->getResult();
  }
}