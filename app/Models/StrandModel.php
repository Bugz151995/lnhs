<?php

namespace App\Models;

use CodeIgniter\Model;


class StrandModel extends Model {
  protected $table         = 'strands';
  protected $primaryKey    = 'strand_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = ['strand_name'];
}