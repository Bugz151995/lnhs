<?php

namespace App\Models;

use CodeIgniter\Model;

class TokenRequestModel extends Model {
  protected $table         = 'token_requests';
  protected $primaryKey    = 'token_request_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'valid_id', 'token', 'requested_at', 'status', 'student_id', 'acad_year', 'semester'
  ];
}