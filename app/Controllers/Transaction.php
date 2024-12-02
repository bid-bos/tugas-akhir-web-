<?php

namespace App\Controllers;

class Transaction extends BaseController
{
    public function index(): string
    {
        return view('transaction-management/data');
    }
}
