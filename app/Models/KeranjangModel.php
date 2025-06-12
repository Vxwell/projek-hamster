<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_pengguna',
        'id_produk',
        'jenis_produk',
        'jumlah',
        'harga_saat_ini',
        'tanggal_dibuat',
        'tanggal_diubah'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'tanggal_dibuat';
    protected $updatedField  = 'tanggal_diubah';
    protected $dateFormat    = 'datetime';

    public function tambahKeKeranjang($id_pengguna, $id_produk, $jenis_produk, $jumlah, $harga_saat_ini)
    {
        $existingItem = $this->where([
            'id_pengguna'  => $id_pengguna,
            'id_produk'    => $id_produk,
            'jenis_produk' => $jenis_produk
        ])->first();

        if ($existingItem) {
            $newQuantity = $existingItem['jumlah'] + $jumlah;
            return $this->update($existingItem['id'], ['jumlah' => $newQuantity]);
        } else {
            $data = [
                'id_pengguna'    => $id_pengguna,
                'id_produk'      => $id_produk,
                'jenis_produk'   => $jenis_produk,
                'jumlah'         => $jumlah,
                'harga_saat_ini' => $harga_saat_ini,
            ];
            return $this->insert($data);
        }
    }

    public function getItemsKeranjangByUserId($id_pengguna)
    {
        $keranjangItems = $this->where('keranjang.id_pengguna', $id_pengguna)->findAll();

        $hamsterModel = new HamsterModel();
        $kebutuhanModel = new KebutuhanModel();

        $detailedItems = [];
        foreach ($keranjangItems as $item) {
            $product = null;
            if ($item['jenis_produk'] === 'hamster') {
                $product = $hamsterModel->find($item['id_produk']);
                if ($product) {
                    $item['nama_produk'] = $product['jenis'];
                    $item['gambar_produk'] = $product['gambar'];
                    $item['stok_produk'] = $product['stok'];
                }
            } elseif ($item['jenis_produk'] === 'kebutuhan') {
                $product = $kebutuhanModel->find($item['id_produk']);
                if ($product) {
                    $item['nama_produk'] = $product['nama'];
                    $item['gambar_produk'] = $product['gambar'];
                    $item['stok_produk'] = null;
                }
            }
            if ($product) {
                $detailedItems[] = $item;
            }
        }
        return $detailedItems;
    }

    public function hapusItemKeranjang($id_keranjang_item, $id_pengguna)
    {
        return $this->where(['id' => $id_keranjang_item, 'id_pengguna' => $id_pengguna])->delete();
    }
}
