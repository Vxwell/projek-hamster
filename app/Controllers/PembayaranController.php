<?php

namespace App\Controllers;

use App\Models\KeranjangModel;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;
use App\Models\HamsterModel;
use App\Models\KebutuhanModel;
use CodeIgniter\Controller;

class PembayaranController extends Controller
{
    protected $keranjangModel;
    protected $transaksiModel;
    protected $detailTransaksiModel;
    protected $hamsterModel;
    protected $kebutuhanModel;

    public function __construct()
    {
        $this->keranjangModel = new KeranjangModel();
        $this->transaksiModel = new TransaksiModel();
        $this->detailTransaksiModel = new DetailTransaksiModel();
        $this->hamsterModel = new HamsterModel();
        $this->kebutuhanModel = new KebutuhanModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Anda harus login untuk checkout!');
        }

        $id_pengguna = session()->get('user_id');
        $items_keranjang = $this->keranjangModel->getItemsKeranjangByUserId($id_pengguna);

        if (empty($items_keranjang)) {
            return redirect()->to('/keranjang')->with('error', 'Keranjang Anda kosong!');
        }

        $total_harga = 0;
        foreach ($items_keranjang as $item) {
            $total_harga += ($item['harga_saat_ini'] * $item['jumlah']);
        }

        $data['items_keranjang'] = $items_keranjang;
        $data['total_harga'] = $total_harga;

        return view('CheckoutView', $data);
    }

    public function prosesPembayaran()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Anda harus login!');
        }

        $id_pengguna = session()->get('user_id');
        $items_keranjang = $this->keranjangModel->getItemsKeranjangByUserId($id_pengguna);

        if (empty($items_keranjang)) {
            return redirect()->to('/keranjang')->with('error', 'Keranjang Anda kosong!');
        }

        $total_harga = 0;
        foreach ($items_keranjang as $item) {
            $total_harga += ($item['harga_saat_ini'] * $item['jumlah']);

            if ($item['jenis_produk'] === 'hamster') {
                $hamster = $this->hamsterModel->find($item['id_produk']);
                if (!$hamster || $hamster['stok'] < $item['jumlah']) {
                    return redirect()->back()->with('error', 'Stok ' . ($hamster ? $hamster['jenis'] : 'hamster') . ' tidak cukup!');
                }
            }
        }

        $this->transaksiModel->db->transStart();

        try {
            $id_transaksi = $this->transaksiModel->insert([
                'id_pengguna'        => $id_pengguna,
                'total_harga'        => $total_harga,
                'tanggal_transaksi'  => date('Y-m-d H:i:s'),
                'status_pembayaran'  => 'lunas',
                'metode_pembayaran'  => 'Transfer Bank (Simulasi)',
                'alamat_pengiriman'  => 'Alamat default user'
            ]);

            if (!$id_transaksi) {
                throw new \Exception("Gagal menyimpan transaksi utama.");
            }

            foreach ($items_keranjang as $item) {
                $this->detailTransaksiModel->insert([
                    'id_transaksi'   => $id_transaksi,
                    'id_produk'      => $item['id_produk'],
                    'jenis_produk'   => $item['jenis_produk'],
                    'jumlah'         => $item['jumlah'],
                    'harga_satuan'   => $item['harga_saat_ini'],
                    'subtotal'       => $item['harga_saat_ini'] * $item['jumlah'],
                ]);
                if ($item['jenis_produk'] === 'hamster') {
                    $hamster = $this->hamsterModel->find($item['id_produk']);
                    if ($hamster) {
                        $new_stok = $hamster['stok'] - $item['jumlah'];
                        $this->hamsterModel->update($item['id_produk'], ['stok' => $new_stok]);
                    }
                }
            }

            $this->keranjangModel->where('id_pengguna', $id_pengguna)->delete();

            $this->transaksiModel->db->transComplete();

            if ($this->transaksiModel->db->transStatus() === FALSE) {
                throw new \Exception("Transaksi gagal.");
            }

            return redirect()->to('/transaksi')->with('success', 'Pembayaran berhasil! Transaksi Anda telah tercatat.');
        } catch (\Exception $e) {
            $this->transaksiModel->db->transRollback();
            return redirect()->back()->with('error', 'Pembayaran gagal: ' . $e->getMessage());
        }
    }

    public function daftarTransaksi()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Anda harus login untuk melihat riwayat transaksi!');
        }

        $id_pengguna = session()->get('user_id');
        $data['transaksi'] = $this->transaksiModel->getTransaksiByUserId($id_pengguna);

        return view('DaftarTransaksiView', $data);
    }

    public function detailTransaksi($id_transaksi)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Anda harus login!');
        }

        $transaksi = $this->transaksiModel->find($id_transaksi);

        if (!$transaksi || $transaksi['id_pengguna'] != session()->get('user_id')) {
            return redirect()->to('/transaksi')->with('error', 'Transaksi tidak ditemukan atau Anda tidak memiliki akses.');
        }

        $data['transaksi'] = $transaksi;
        $data['detail_items'] = $this->detailTransaksiModel->getDetailByTransaksiId($id_transaksi);

        return view('DetailTransaksiView', $data);
    }
}
