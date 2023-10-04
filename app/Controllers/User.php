<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }
    public function index()
    {
        return view('user/index');
    }
}
