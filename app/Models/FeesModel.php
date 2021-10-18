<?php

namespace App\Models;

use CodeIgniter\Model;

class FeesModel extends Model {
  protected $table         = 'fees';
  protected $primaryKey    = 'fee_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'tuition',
    'library',
    'medical',
    'guidance',
    'foundation',
    'modules',
    'disinfectant',
    'internet',
    'maintenance',
    'learning',
    'grade_level',
  ];
}