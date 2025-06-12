<?php
namespace App\Controllers;

use App\Models\LoginModel;

class LoginController extends BaseController
{

    public function index(): string
    {
        return view('LoginView');
    }

    public function verifikasi()
    {
        $username = strtolower($this->request->getPost('user'));
        $password = $this->request->getPost('pwd');

        $model = model(LoginModel::class);
        $user = $model->cekUsername($username);

        if ($user && password_verify($password, $user['password'])) {

            session()->set([

                'logged_in' => true,

                'user_id' => $user['id'],

                'username' => $user['username']

            ]);

            return redirect()->to('/home');
        } else {
            return view('LoginView', ['error' => true]);
        }
    }

    public function logout()
    {
        session()->destroy();
        setcookie('pesan_logout', 'Anda telah logout.', time() + 5);
        return redirect()->to('/login');
    }
}
