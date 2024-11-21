<?php

namespace App\Controllers;

use App\Models\usersModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\Validation\StrictRules\Rules;

class Auth extends BaseController
{
    protected $users;
    public function __construct()
    {
        $this->users = new usersModel();
    }
    public function index(): string
    {
        return view('auth/login');
    }

    public function signup()
    {
        return view('auth/signup');
    }

    public function register()
    {
        if ($this->request->isAJAX()) {
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $confirm_password = $this->request->getPost('confirm_password');

            $validation = \Config\Services::validation();

            $doValid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[users.username]',
                    'errors' => [
                        'required' => '{field} is required.',
                        'is_unique' => '{field} Already Exist.',
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|is_unique[users.email]|valid_email',
                    'errors' => [
                        'required' => '{field} is required.',
                        'is_unique' => '{field} Already Exist.',
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[8]|max_length[20]|regex_match[/^(?=.*\d)(?=.*[A-Z])(?=.*[@$!%*?&])[0-9A-Za-z@$!%*?&]+$/]',
                    'errors' => [
                        'required' => '{field} is required.',
                        'regex_match' => '{field} Must Contain Uppercase Lowercase Number and Special Character.',
                    ]
                ],
                'confirm_password' => [
                    'label' => 'Password',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} is required.',
                    ]
                ],
            ]);

            if (!$doValid) {
                $msg = [
                    'error' => [
                        'errorUsername' => $validation->getError('username'),
                        'errorEmail' => $validation->getError('email'),
                        'errorPassword' => $validation->getError('password'),
                        'errorConfirmPassword' => $validation->getError('confirm_password')
                    ]
                ];
            } else {
                $this->users->insert([
                    'username' => $username,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'created_at' => Time::now(),
                    'updated_at' => Time::now()
                ]);

                $msg = ['success' => 'Please Login Before Proceeding'];
            }

            echo json_encode($msg);
        }
    }
    public function signin()
    {
        if ($this->request->isAJAX()) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
    
            $validation = \Config\Services::validation();
    
            $doValid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} can\'t be empty',
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} can\'t be empty',
                    ]
                ]
            ]);
    
            if (!$doValid) {
                $msg = [
                    'error' => [
                        'errorUsername' => $validation->getError('username'),
                        'errorPassword' => $validation->getError('password'),
                    ]
                ];
            } else {
                $auth = $this->users->login($username, $password);
                if ($auth) {
                    session()->set([
                        'isLoggeedin' => true,
                        'email' => $auth['email'],
                        'username' => $auth['username'],
                    ]);
                    $msg = ['success' => 'You have been logged in'];
                } else {
                    // Tambahan untuk menangani login gagal
                    $msg = [
                        'error' => [
                            'errorUsername' => 'Invalid username or password',
                            'errorPassword' => 'Invalid username or password'
                        ]
                    ];
                }
            }
            echo json_encode($msg);
        }
    }
    
}
