<?php

namespace App\Controllers;

use App\Models\RegistrasiModel;

class RegistrasiController extends BaseController
{
    public function index()
    {
        return view('RegistrasiView');
    }

    public function registrasi()
    {
        helper('form');

        $username = strtolower($this->request->getPost('user'));
        $password = $this->request->getPost('pwd');
        $password2 = $this->request->getPost('pwd2');

        $model = model(RegistrasiModel::class);

        if ($model->cekUsername($username)) {
            session()->setFlashdata('error', 'Username sudah terdaftar!');
            return redirect()->back();
        }

        if ($password !== $password2) {
            session()->setFlashdata('error', 'Konfirmasi Password tidak sesuai!');
            return redirect()->back();
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'username' => $username,
            'password' => $password
        ];

        $model->simpanUser($data);

        session()->setFlashdata('success', 'User berhasil ditambahkan!');
        return redirect()->to('/login');
    }
}
