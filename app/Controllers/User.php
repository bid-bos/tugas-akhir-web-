<?php

namespace App\Controllers;

use App\Models\usersModel;

class User extends BaseController
{
    protected $users;

    public function __construct()
    {
        // Inisialisasi model
        $this->users = new usersModel();
    }

    public function index()
    {
        // Mengambil jumlah total user
        $totalusers = $this->users->selectCount('id')->first();

        // Pastikan nilai 'id' selalu tersedia atau default ke 0
        $data = [
            'total_user' => $totalusers ? $totalusers['id'] : 0,
        ];

        // Kirim data ke view
        return view('user/data', $data);
    }

    public function getTotalUsers()
    {
        // Mengambil jumlah total user
        $totalusers = $this->users->selectCount('id')->first();

        // Kembalikan data dalam format JSON
        return $this->response->setJSON([
            'total_user' => $totalusers ? $totalusers['id'] : 0,
        ]);
    }
}
