<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('menuWindows8\menuWindows');
    }
}
