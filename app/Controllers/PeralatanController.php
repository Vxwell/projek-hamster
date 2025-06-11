<?php

namespace App\Controllers;
use App\Models\PeralatanModel;

class PeralatanController extends BaseController
{
    public function index()
    {
        $model = new PeralatanModel();
        $data['peralatan'] = $model->findAll();

        return view('dashboard', $data);
    }
}
