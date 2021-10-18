<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model {
  protected $table         = 'enrollments';
  protected $primaryKey    = 'enrollment_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'enrollment_id', 'learning_modality', 'student_id', 'course_id', 'status', 'semester', 'acad_year', 'isdocumentcomplete', 'remarks'
  ];

  public function getEnrollments() {
    $db = db_connect();

    $builder = $db->table('enrollments');

    return $builder->select('*')
                   ->join('students', 'students.student_id = enrollments.student_id')
                   ->join('students_class', 'students_class.student_id = students.student_id')
                   ->join('class', 'class.class_id = students_class.class_id')
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
                   ->join('students_class', 'students_class.student_id = students.student_id')
                   ->join('class', 'class.class_id = students_class.class_id')
                   ->join('students_address', 'students_address.student_id = students.student_id')
                   ->join('address', 'address.address_id = students_address.address_id')
                   ->groupBy('students.student_id')
                   ->where('enrollments.student_id', $student_id)
                   ->get()
                   ->getResult();
  }
}