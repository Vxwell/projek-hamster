<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_hamster extends Model
{
    protected $table = 'hamster'; // sesuaikan nama tabel di database Anda

    public function tampil_data()
    {
        return $this->db->table($this->table)->get();
    }
}
