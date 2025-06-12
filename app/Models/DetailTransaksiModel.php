<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksiModel extends Model
{
    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_transaksi',
        'id_produk',
        'jenis_produk',
        'jumlah',
        'harga_satuan',
        'subtotal'
    ];
    protected $useTimestamps = false;

    public function getDetailByTransaksiId($id_transaksi)
    {
        $detailItems = $this->where('detail_transaksi.id_transaksi', $id_transaksi)->findAll();

        $hamsterModel = new HamsterModel();
        $kebutuhanModel = new KebutuhanModel();

        $detailedItems = [];
        foreach ($detailItems as $item) {
            $product = null;
            if ($item['jenis_produk'] === 'hamster') {
                $product = $hamsterModel->find($item['id_produk']);
                if ($product) {
                    $item['nama_produk'] = $product['jenis'];
                    $item['gambar_produk'] = $product['gambar'];
                }
            } elseif ($item['jenis_produk'] === 'kebutuhan') {
                $product = $kebutuhanModel->find($item['id_produk']);
                if ($product) {
                    $item['nama_produk'] = $product['nama'];
                    $item['gambar_produk'] = $product['gambar'];
                }
            }
            if ($product) {
                $detailedItems[] = $item;
            }
        }
        return $detailedItems;
    }
}
