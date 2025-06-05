<?php

namespace App\Controllers;

class CobaHomeController extends BaseController
{
    public function index(): string
    {
        return view('cobahome');
    }
}