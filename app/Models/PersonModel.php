<?php

namespace App\Models;

use CodeIgniter\Model;


class PersonModel extends Model {
  protected $table         = 'persons';
  protected $primaryKey    = 'person_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'person_id', 'lastname', 'firstname', 'middlename', 'contact_number'
  ];

  public function isDuplicate($data) {
    $db = db_connect();

    $builder = $db->table('persons');
    
    $query = $builder->select('person_id')
                     ->where($data)
                     ->get();

    return $query->getResult();
  }
}