<?php

namespace App\Models;

use CodeIgniter\Model;

class TrackModel extends Model {
  protected $table         = 'tracks';
  protected $primaryKey    = 'track_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = ['track_name'];
}