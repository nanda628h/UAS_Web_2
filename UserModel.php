<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

/**
 * Praktikum 13-14: Auth Controller untuk Token-Based Authentication
 * Endpoint: /auth/login
 */
class Auth extends ResourceController
{
    use ResponseTrait;

    public function login()
    {
        $model    = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $model->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return $this->respond([
                'status'   => 401,
                'error'    => 401,
                'messages' => 'Username atau password salah!',
            ], 401);
        }

        // Buat token sederhana (hash dari user data + waktu)
        $token = bin2hex(random_bytes(32));

        // Simpan token ke database
        $model->update($user['id'], ['token' => $token]);

        return $this->respond([
            'status'   => 200,
            'error'    => null,
            'messages' => ['success' => 'Login berhasil.'],
            'data'     => [
                'id'       => $user['id'],
                'username' => $user['username'],
                'token'    => $token,
            ],
        ]);
    }
}
