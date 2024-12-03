<?php

namespace App\Models;

use CodeIgniter\Model;

class usersModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'username',
        'email',
        'password',
        'level_user',
        'created_at',
        'updated_at',
    ];

    public function login($username, $password)
    {
        $user = $this->db->table('users')->where('username', $username)->get()->getRowArray();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }

    public function count(){
        
    }
}


