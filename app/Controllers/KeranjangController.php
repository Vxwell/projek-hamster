<?php

namespace App\Controllers;

use App\Models\KeranjangModel;
use App\Models\HamsterModel; 
use App\Models\KebutuhanModel; 
use CodeIgniter\Controller;

class KeranjangController extends Controller
{
    protected $keranjangModel;
    protected $hamsterModel;
    protected $kebutuhanModel;

    public function __construct()
    {
        $this->keranjangModel = new KeranjangModel();
        $this->hamsterModel = new HamsterModel();
        $this->kebutuhanModel = new KebutuhanModel();
    }

    public function tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Anda harus login untuk menambah ke keranjang!');
        }

        $id_pengguna = session()->get('user_id');
        $id_produk   = $this->request->getPost('id_produk');
        $jenis_produk = $this->request->getPost('jenis_produk');
        $jumlah      = $this->request->getPost('jumlah') ?? 1;

        $harga_saat_ini = 0;
        $product_data = null;

        if ($jenis_produk === 'hamster') {
            $product_data = $this->hamsterModel->find($id_produk);
        } elseif ($jenis_produk === 'kebutuhan') {
            $product_data = $this->kebutuhanModel->find($id_produk);
        } else {
            return redirect()->back()->with('error', 'Jenis produk tidak valid!');
        }

        if (!$product_data) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }

        $harga_saat_ini = $product_data['harga'];

        if ($jenis_produk === 'hamster' && isset($product_data['stok'])) {
            if ($product_data['stok'] < $jumlah) {
                return redirect()->back()->with('error', 'Stok ' . $product_data['jenis'] . ' tidak cukup!');
            }
        }

        if ($this->keranjangModel->tambahKeKeranjang($id_pengguna, $id_produk, $jenis_produk, $jumlah, $harga_saat_ini)) {
            return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan produk ke keranjang.');
        }
    }

    public function index() // <-- Metode ini yang hilang
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Anda harus login untuk melihat keranjang!');
        }

        $id_pengguna = session()->get('user_id');
        $data['items_keranjang'] = $this->keranjangModel->getItemsKeranjangByUserId($id_pengguna);

        return view('KeranjangView', $data);
    }

    public function hapus($id_keranjang_item)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Anda harus login!');
        }

        $id_pengguna = session()->get('user_id');

        if ($this->keranjangModel->hapusItemKeranjang($id_keranjang_item, $id_pengguna)) {
            return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
        } else {
            return redirect()->back()->with('error', 'Item tidak ditemukan atau Anda tidak memiliki akses untuk menghapusnya.');
        }
    }
}
