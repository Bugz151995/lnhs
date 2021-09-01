<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherModel extends Model {
  protected $table         = 'teachers';
  protected $primaryKey    = 'teacher_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'teacher_img', 'lastname', 'firstname', 'middlename', 'suffix', 'email', 'contact_number'
  ];
}