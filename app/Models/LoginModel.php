<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'password'];

    public function cekUsername($username)
    {

        return $this->where('username', $username)->first();
    }
}
