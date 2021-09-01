<?php

namespace App\Models;

use CodeIgniter\Model;

class SectionModel extends Model {
  protected $table         = 'sections';
  protected $primaryKey    = 'section_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'section_name', 'course_id'
  ];
}