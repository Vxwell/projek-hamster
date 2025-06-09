<?php

namespace App\Controllers;

use App\Models\LoginModel;

class LoginController extends BaseController
{
    public function index() : string
    {
        return view('loginpage');
    }

    public function verifikasi()
    {
        $username = strtolower($this->request->getPost('user'));
        $password = $this->request->getPost('pwd');

        $model = model(LoginModel::class);
        $user = $model->cekUsername($username);

        // cek username dan password
        if ($user && password_verify($password, $user['password'])) {
            // jika benar, masuk ke halaman home
            return redirect()->to('/home');
        } else {
            // jika salah, tampilkan pesan kesalahan berpikir
            return view('loginpage', ['error' => true]);
        }
    }
}
