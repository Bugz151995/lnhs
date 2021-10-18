<?php

namespace App\Models;

use CodeIgniter\Model;

class EscApplicationModel extends Model {
  protected $table         = 'esc_applications';
  protected $primaryKey    = 'esc_application_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'is2or3wheelsowned',
    'is4wheelsowned',
    'islandorfarmowned',
    'home_details',
    'beds',
    'school_name',
    'school_type',
    'school_address',
    'tuition',
    'other_fee',
    'misc_fee',
    'student_id',
  ];
}