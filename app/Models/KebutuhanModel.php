<?php

namespace App\Models;
use CodeIgniter\Model;

class KebutuhanModel extends Model
{
    protected $table = 'kebutuhan_hamster';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'harga', 'keterangan', 'gambar'];
}
