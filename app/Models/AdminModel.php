<?php

namespace App\Models;

use CodeIgniter\Model;


class AdminModel extends Model {
  protected $table         = 'admin';
  protected $primaryKey    = 'admin_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'email', 'lastname', 'firstname', 'middlename', 'contact_number', 'username', 'password'
  ];
}