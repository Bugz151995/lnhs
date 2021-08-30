<?php

namespace App\Models;

use CodeIgniter\Model;


class EnrollmentModel extends Model {
  protected $table         = 'enrollments';
  protected $primaryKey    = 'enrollment_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'enrollment_id', 'learning_modality', 'grade_level', 'submitted_at', 'student_id', 'course_id', 'status'
  ];
}