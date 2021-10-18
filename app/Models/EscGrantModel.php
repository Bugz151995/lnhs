<?php

namespace App\Models;

use CodeIgniter\Model;

class EscGrantModel extends Model {
  protected $table         = 'esc_grants';
  protected $primaryKey    = 'esc_grant_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'esc_application_id',
    'status',
    'registrar_id',
    'assessed_at'
  ];
}