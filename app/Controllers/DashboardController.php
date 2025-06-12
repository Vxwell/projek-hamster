<?php

namespace App\Controllers;

use App\Models\HamsterModel;
use App\Models\KebutuhanModel;
use CodeIgniter\Controller;

class DashboardController extends Controller
{
    protected $model_hamster;
    protected $model_kebutuhan;

    public function __construct()
    {
        $this->model_hamster = new HamsterModel();
        $this->model_kebutuhan = new KebutuhanModel();
    }
    public function index()
    {
        $data['hamster'] = $this->model_hamster->tampil_data()->getResult();
        $data['peralatan'] = $this->model_kebutuhan->findAll();
        return view('DashboardView', $data);
    }
}
