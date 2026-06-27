<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ArtikelModel;
use App\Models\KategoriModel;

class Artikel extends Controller
{
    public function index()
    {
        $model = new ArtikelModel();
        $data = [
            'title'   => 'Daftar Artikel',
            'artikel' => $model->orderBy('id', 'DESC')->findAll(),
        ];
        return view('artikel/index', $data);
    }

    /**
     * Praktikum 9: Admin index dengan AJAX Pagination & Search
     */
    public function admin_index()
    {
        $title       = 'Daftar Artikel (Admin)';
        $model       = new ArtikelModel();
        $q           = $this->request->getVar('q') ?? '';
        $kategori_id = $this->request->getVar('kategori_id') ?? '';
        $page        = $this->request->getVar('page') ?? 1;

        $builder = $model->table('artikel')
            ->select('artikel.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori');

        if ($q != '') {
            $builder->like('artikel.judul', $q);
        }
        if ($kategori_id != '') {
            $builder->where('artikel.id_kategori', $kategori_id);
        }

        $artikel = $builder->paginate(10, 'default', $page);
        $pager   = $model->pager;

        $data = [
            'title'       => $title,
            'q'           => $q,
            'kategori_id' => $kategori_id,
            'artikel'     => $artikel,
            'pager'       => $pager,
        ];

        if ($this->request->isAJAX()) {
            return $this->response->setJSON($data);
        } else {
            $kategoriModel   = new KategoriModel();
            $data['kategori'] = $kategoriModel->findAll();
            return view('artikel/admin_index', $data);
        }
    }

    public function edit($id)
    {
        $model = new ArtikelModel();
        $data  = [
            'title'   => 'Edit Artikel',
            'artikel' => $model->find($id),
        ];
        return view('artikel/form_edit', $data);
    }

    public function delete($id)
    {
        $model = new ArtikelModel();
        $model->delete($id);
        return redirect()->to('/admin/artikel');
    }
}
