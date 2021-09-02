<?php

namespace App\Models;

use CodeIgniter\Model;

class TransfereeReturneeModel extends Model {
  protected $table         = 'transferees_returnees';
  protected $primaryKey    = '	transferee_returnee_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'student_id', 'last_gradelevel', 'year_completed', 'school_name', 'school_address'
  ];
}