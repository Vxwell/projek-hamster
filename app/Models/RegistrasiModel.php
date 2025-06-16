<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrasiModel extends Model {
    protected $table = 'users';
    protected $allowedFields = ['username', 'password'];

    public function simpanUser($data) {
        $this->save($data);
    }

    public function cekUsername($username) {
        return $this->where('username', $username)->first();
    }
}