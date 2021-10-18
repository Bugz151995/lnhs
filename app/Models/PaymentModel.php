<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model {
  protected $table         = 'payment';
  protected $primaryKey    = 'payment_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'recorded_at',
    'acad_year',
    'payee',
    'amount',
    'balance',
    'payment_type',
    'payment_status',
    'remarks',
    'fee_id',
    'student_id',
  ];
}