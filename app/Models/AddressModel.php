<?php

namespace App\Models;

use CodeIgniter\Model;


class AddressModel extends Model {
  protected $table         = 'address';
  protected $primaryKey    = 'address_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'address_id', 'street', 'barangay', 'city_municipality', 'province'
  ];

  public function isDuplicate($data) {
    $db = db_connect();

    $builder = $db->table('address');
    
    $query = $builder->select('address_id')
                     ->where($data)
                     ->get();

    return $query->getResult();
  }
}