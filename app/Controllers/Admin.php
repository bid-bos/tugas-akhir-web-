<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index(): string
    {
        return view('user/data');
    }

    public function add()
    {
        return view('User/addAdmin');
    }
}
