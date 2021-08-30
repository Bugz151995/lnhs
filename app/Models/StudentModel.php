<?php

namespace App\Models;

use CodeIgniter\Model;


class StudentModel extends Model {
  protected $table         = 'students';
  protected $primaryKey    = 'student_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'lrn', 'user_img', 'firstname', 'middlename', 'lastname', 'suffix', 'birthdate', 'birthplace', 'age', 'religion', 'nationality', 'contact_num', 'email'
  ];
}