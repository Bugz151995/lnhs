<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentClassModel extends Model {
  protected $table         = 'students_class';
  protected $primaryKey    = 'student_class_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'student_id', 'class_id'
  ];
}