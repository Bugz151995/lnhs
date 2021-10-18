<?php

namespace App\Validation;

use App\Models\AdminModel;

class AdminSignInRules {
  public function verify_admin(string $str, string $fields, array $data) : bool {
    $a = new AdminModel();

    $user = $a->find(session()->get('admin'));

    return (!$user) ? FALSE : password_verify($data['password'], $user['password']);
  }
}