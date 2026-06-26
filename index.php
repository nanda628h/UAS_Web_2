<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ArtikelModel;

/**
 * Praktikum 10: REST API Controller
 * Endpoint  : /post
 * Namespace : App\Controllers\Api
 */
class Post extends ResourceController
{
    use ResponseTrait;

    // GET /post  — Tampilkan semua data
    public function index()
    {
        $model           = new ArtikelModel();
        $data['artikel'] = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }

    // POST /post  — Tambah data baru
    public function create()
    {
        $model = new ArtikelModel();
        $data  = [
            'judul'  => $this->request->getVar('judul'),
            'isi'    => $this->request->getVar('isi'),
            'status' => $this->request->getVar('status') ?? 0,
        ];
        $model->insert($data);
        return $this->respondCreated([
            'status'   => 201,
            'error'    => null,
            'messages' => ['success' => 'Data artikel berhasil ditambahkan.'],
        ]);
    }

    // GET /post/:id  — Tampilkan data spesifik
    public function show($id = null)
    {
        $model = new ArtikelModel();
        $data  = $model->where('id', $id)->first();
        if ($data) {
            return $this->respond($data);
        }
        return $this->failNotFound('Data tidak ditemukan.');
    }

    // PUT /post/:id  — Ubah data
    public function update($id = null)
    {
        $model = new ArtikelModel();
        $data  = [
            'judul'  => $this->request->getVar('judul'),
            'isi'    => $this->request->getVar('isi'),
            'status' => $this->request->getVar('status'),
        ];
        $model->update($id, $data);
        return $this->respond([
            'status'   => 200,
            'error'    => null,
            'messages' => ['success' => 'Data artikel berhasil diubah.'],
        ]);
    }

    // DELETE /post/:id  — Hapus data
    public function delete($id = null)
    {
        $model = new ArtikelModel();
        $exist = $model->find($id);
        if ($exist) {
            $model->delete($id);
            return $this->respondDeleted([
                'status'   => 200,
                'error'    => null,
                'messages' => ['success' => 'Data artikel berhasil dihapus.'],
            ]);
        }
        return $this->failNotFound('Data tidak ditemukan.');
    }
}
