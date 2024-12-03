<?php

namespace App\Controllers;

use App\Models\usersModel;
use CodeIgniter\I18n\Time;

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
        $userData = $this->users->findAll();

        // Pastikan nilai 'id' selalu tersedia atau default ke 0
        $data = [
            'total_user' => $totalusers ? $totalusers['id'] : 0,
            'data_user' => $userData
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

    public function add()
    {
        return view('user/addAdmin');
    }

    public function saveuser()
    {
        if ($this->request->isAJAX()) {
            // Ambil input data
            $username = $this->request->getVar('username');
            $email    = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $level_user = $this->request->getVar('level_user');

            // Konfigurasi validasi
            $validation = \Config\Services::validation();

            $doValid = $this->validate([
                'username' => [
                    'label'  => 'Username',
                    'rules'  => 'required|is_unique[users.username,id,{id}]',
                    'errors' => [
                        'required'  => '{field} Can\'t be empty',
                        'is_unique' => '{field} Already Existed',
                    ]
                ],
                'email' => [
                    'label'  => 'Email',
                    'rules'  => 'required|valid_email|is_unique[users.email,id,{id}]',
                    'errors' => [
                        'required'  => '{field} Can\'t be empty',
                        'valid_email' => 'Please provide a valid email address.',
                        'is_unique' => '{field} Already Existed',
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[8]|max_length[20]|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/]',
                    'errors' => [
                        'required' => 'The {field} field is required.',
                        'min_length' => 'Password must be at least 8 characters long.',
                        'max_length' => 'Password cannot exceed 20 characters.',
                        'regex_match' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
                    ],
                ],
                'password_confirm' => [
                    'label' => 'Confirm Password',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} Can\'t be Empty',
                        'matches' => 'Password confirmation does not match the password.'
                    ],
                ],
                'level_user' => [
                    'label' => 'Level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Can\'t be Empty',
                    ],
                ]
            ]);

            if (!$doValid) {
                // Jika validasi gagal
                $msg = [
                    'error' => [
                        'errorUserName' => $validation->getError('username'),
                        'errorEmail' => $validation->getError('email'),
                        'errorPassword' => $validation->getError('password'),
                        'errorPasswordConfirm' => $validation->getError('password_confirm'),
                        'errorLevel' => $validation->getError('level_user'),
                    ]
                ];
            } else {
                // Simpan data ke database
                $this->users->insert([
                    'username'   => $username,
                    'email'      => $email,
                    'password'   => password_hash($password, PASSWORD_DEFAULT),
                    'level_user' => $level_user,
                    'created_at' => Time::now(),
                    'updated_at' => Time::now(),
                ]);

                // Pesan sukses
                $msg = ['success' => 'User Successfully Added'];
            }

            echo json_encode($msg);
        }
    }

    public function delete($id)
    {
        if ($this->request->isAJAX()) {
            // Cari user berdasarkan ID
            $user = $this->users->find($id);

            if (!$user) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'User not found',
                ]);
            }

            // Hapus user
            $this->users->delete($id);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'User successfully deleted',
            ]);
        } else {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid request',
            ]);
        }
    }

    public function edit($id)
    {
        if ($this->request->isAJAX()) {
            // Cari user berdasarkan ID
            $user = $this->users->find($id);

            if ($user) {
                return $this->response->setJSON($user);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'User not found',
                ], 404);
            }
        } else {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid request',
            ]);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $user = $this->users->find($id);

            if (!$user) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'User not found',
                ], 404);
            }

            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'level_user' => $this->request->getPost('role'),
            ];

            // Jika password diisi, tambahkan ke array
            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            // Update data ke database
            if ($this->users->update($id, $data)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'User successfully updated',
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to update user',
                ], 500);
            }
        } else {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid request',
            ]);
        }
    }
}
