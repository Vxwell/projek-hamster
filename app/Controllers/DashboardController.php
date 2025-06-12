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

    public function detailHamster($id)
    {
        $hamster = $this->model_hamster->find($id);

        if (!$hamster) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Hamster tidak ditemukan");
        }

        return view('hamster_detail', ['hamster' => $hamster]);
    }

    public function detailPeralatan($id)
    {
        $peralatan = $this->model_kebutuhan->find($id);

        if (!$peralatan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Peralatan tidak ditemukan");
        }

        return view('kebutuhan_detail', ['peralatan' => $peralatan]);
    }
}
