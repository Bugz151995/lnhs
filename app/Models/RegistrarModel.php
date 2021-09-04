<?php

namespace App\Models;

use CodeIgniter\Model;


class RegistrarModel extends Model {
  protected $table         = 'registrar';
  protected $primaryKey    = 'registrar_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'email', 'lastname', 'firstname', 'middlename', 'contact_number', 'username', 'password', 'isapproved'
  ];
}