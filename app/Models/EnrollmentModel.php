<?php

namespace App\Models;

use CodeIgniter\Model;


class EnrollmentModel extends Model {
  protected $table         = 'enrollments';
  protected $primaryKey    = 'enrollment_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'enrollment_id', 'learning_modality', 'grade_level', 'student_id', 'course_id', 'status'
  ];

  public function getEnrollments() {
    $db = db_connect();

    $builder = $db->table('enrollments');

    return $builder->select('*')
                   ->join('students', 'students.student_id = enrollments.student_id')
                   ->join('students_sections', 'students_sections.student_id = students.student_id')
                   ->join('sections', 'sections.section_id = students_sections.section_id')
                   ->join('relations', 'relations.student_id = students.student_id')
                   ->join('persons', 'persons.person_id = relations.person_id')
                   ->join('students_address', 'students_address.student_id = students.student_id')
                   ->join('address', 'address.address_id = students_address.address_id')
                   ->groupBy('students.student_id')
                   ->get()
                   ->getResult();
  }

  public function getStudentEnrollment($student_id) {
    $db = db_connect();

    $builder = $db->table('enrollments');

    return $builder->select('*')
                   ->join('students', 'students.student_id = enrollments.student_id')
                   ->join('students_sections', 'students_sections.student_id = students.student_id')
                   ->join('sections', 'sections.section_id = students_sections.section_id')
                   ->join('relations', 'relations.student_id = students.student_id')
                   ->join('persons', 'persons.person_id = relations.person_id')
                   ->join('students_address', 'students_address.student_id = students.student_id')
                   ->join('address', 'address.address_id = students_address.address_id')
                   ->groupBy('students.student_id')
                   ->where('students.student_id', $student_id)
                   ->get()
                   ->getResult();
  }
}