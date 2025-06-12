<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_pengguna',
        'tanggal_transaksi',
        'total_harga',
        'status_pembayaran',
        'metode_pembayaran',
        'alamat_pengiriman',
        'tanggal_dibuat',
        'tanggal_diubah'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'tanggal_dibuat';
    protected $updatedField  = 'tanggal_diubah';
    protected $dateFormat    = 'datetime';

    public function getTransaksiByUserId($id_pengguna)
    {
        return $this->where('id_pengguna', $id_pengguna)
            ->orderBy('tanggal_transaksi', 'DESC')
            ->findAll();
    }
}
