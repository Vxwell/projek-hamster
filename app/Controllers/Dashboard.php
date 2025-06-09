<?php

namespace App\Controllers;

use App\Models\Model_hamster;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
    protected $model_hamster;

    public function __construct()
    {
        $this->model_hamster = new Model_hamster();
    }

    public function index()
    {
        $data['hamster'] = $this->model_hamster->tampil_data()->getResult();
        return view('templates/header')
            . view('templates/sidebar')
            . view('dashboard', $data)
            . view('templates/footer');
    }
}
