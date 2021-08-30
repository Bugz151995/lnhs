<?php

namespace App\Models;

use CodeIgniter\Model;


class StudentAddressModel extends Model {
  protected $table         = 'students_address';
  protected $primaryKey    = 'student_address_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'student_address_id', 'address_id', 'student_id'
  ];
}