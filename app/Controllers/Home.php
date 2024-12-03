<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('Backend/login/home');
    }
}
