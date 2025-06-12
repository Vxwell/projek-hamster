<?php

namespace App\Models;

use CodeIgniter\Model;

class HamsterModel extends Model
{
    protected $table = 'hamster';
    protected $primaryKey = 'id_hamster';
    protected $allowedFields = ['jenis', 'harga', 'stok', 'gambar', 'keterangan'];
    protected $returnType = 'array';

    public function tampil_data()
    {
        return $this->db->table($this->table)->get();
    }
}
