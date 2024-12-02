<?php

namespace App\Controllers;

class Categories extends BaseController
{
    public function index(): string
    {
        return view('categories/data');
    }

    public function add()
    {
        return view('categories/addForm');
    }
}
