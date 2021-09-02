<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentSectionModel extends Model {
  protected $table         = 'students_sections';
  protected $primaryKey    = 'student_section_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'student_id', 'section_id'
  ];
}