<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Http\RequestInterface;
use CodeIgniter\Http\ResponseInterface;
use Config\Services;

/**
 * Praktikum 14: API Auth Filter (Server-Side Security)
 * Memeriksa keberadaan token Bearer pada setiap request yang masuk.
 */
class ApiAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Ambil Header Authorization dari request klien
        $authHeader = $request->getServer('HTTP_AUTHORIZATION');

        if (!$authHeader) {
            $response = Services::response();
            $response->setStatusCode(401);
            return $response->setJSON([
                'status'   => 401,
                'error'    => 401,
                'messages' => 'Akses Ditolak. Token tidak ditemukan pada request!',
            ]);
        }

        // 2. Ekstrak string token (pisahkan kata "Bearer" dari token-nya)
        $token = null;
        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        // 3. Validasi token
        if (!$token || empty($token)) {
            $response = Services::response();
            $response->setStatusCode(401);
            return $response->setJSON([
                'status'   => 401,
                'error'    => 401,
                'messages' => 'Sesi Token tidak valid atau kedaluwarsa!',
            ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak diperlukan aksi setelah request diproses
    }
}
