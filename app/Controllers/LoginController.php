<?php

namespace App\Controllers;

class LoginController extends BaseController
{
    public function index() : string
    {
        return view('loginpage');
    }

    public function verifikasi()
    {
        $username = $this->request->getPost('user');
        $password = $this->request->getPost('pwd');
        // cek username dan password
        if ($username === 'admin' && $password === 'admin123') {
            // jika benar, masuk ke halaman home
            return redirect()->to('/homecoba');
        } else {
            // jika salah, tampilkan pesan kesalahan berpikir
            return view('loginpage', ['error' => true]);
        }
    }
}
