<?php

namespace App\Controllers;

use App\Models\Model_hamster;
use App\Models\PeralatanModel;
use CodeIgniter\Controller;

class DashboardController extends Controller
{
    protected $model_hamster;
    protected $model_peralatan;

    public function __construct()
    {
        $this->model_hamster = new Model_hamster();
        $this->model_peralatan = new PeralatanModel();
    }

    public function index()
    {
        $data['hamster'] = $this->model_hamster->tampil_data()->getResult();
        $data['peralatan'] = $this->model_peralatan->findAll(); // ambil semua data peralatan

        return view('dashboard', $data);
    }
}
