<?php

namespace App\Models;

use CodeIgniter\Model;


class StudentModel extends Model {
  protected $table         = 'students';
  protected $primaryKey    = 'student_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'lrn', 'user_img', 'firstname', 'middlename', 'lastname', 'sex', 'suffix', 'birthdate', 'birthplace', 'age', 'religion', 'nationality', 'contact_num', 'email', 'id_picture', 'token'
  ];

  public function isDuplicate($data) {
    $db = db_connect();

    $builder = $db->table('students');
    
    $query = $builder->select('student_id')
                     ->where($data)
                     ->get();

    return $query->getResult();
  }
}