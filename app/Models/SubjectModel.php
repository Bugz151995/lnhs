<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model {
  protected $table         = 'subjects';
  protected $primaryKey    = 'subject_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'subject_category', 'subject_code', 'subject_name'
  ];

  public function isDuplicate($data) {
    $db = db_connect();

    $builder = $db->table('subjects');
    
    $query = $builder->select('subject_id')
                     ->where($data)
                     ->get();

    return $query->getResult();
  }
}