<?php

namespace App\Models;

use CodeIgniter\Model;


class StudentSchedulesModel extends Model {
  protected $table         = 'students_schedules';
  protected $primaryKey    = 'student_schedule_id';

  protected $returnType    = 'array';
  
  protected $allowedFields = [
    'schedule_id', 'student_id', 'acad_year', 'semester'
  ];
}