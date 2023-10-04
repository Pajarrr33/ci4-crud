<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Blocked extends BaseController
{
    public function index()
    {
        return view('blocked/index');
    }
}
