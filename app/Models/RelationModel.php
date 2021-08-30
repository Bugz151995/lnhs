<?php

namespace App\Models;

use CodeIgniter\Model;


class RelationModel extends Model {
  protected $table         = 'relations';
  protected $primaryKey    = 'relation_id';

  protected $returnType    = 'array';

  protected $allowedFields = [
    'student_id', 'person_id', 'relationship'
  ];
}