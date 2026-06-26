<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\KategoriModel;

/**
 * Artikel Controller
 * Praktikum 2 : CRUD dasar
 * Praktikum 3 : View Layout & View Cell
 * Praktikum 5 : Pagination & Pencarian
 * Praktikum 6 : Relasi Tabel & Query Builder
 * Praktikum 7 : Upload File Gambar
 */
class Artikel extends BaseController
{
    // ------------------------------------------------------------------
    // PUBLIC - Daftar Artikel (Praktikum 2 + 6)
    // ------------------------------------------------------------------
    public function index()
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        // Praktikum 6: gunakan method join dengan kategori
        $artikel = $model->getArtikelDenganKategori();
        return view('artikel/index', compact('artikel', 'title'));
    }

    // ------------------------------------------------------------------
    // PUBLIC - Detail Artikel (Praktikum 2)
    // ------------------------------------------------------------------
    public function view($slug)
    {
        $model   = new ArtikelModel();
        $artikel = $model->where('slug', $slug)->first();

        if (! $artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $title = $artikel['judul'];
        return view('artikel/detail', compact('artikel', 'title'));
    }

    // ------------------------------------------------------------------
    // ADMIN - Daftar Artikel (Praktikum 5 Pagination + Pencarian, Praktikum 6 filter kategori)
    // ------------------------------------------------------------------
    public function admin_index()
    {
        $title       = 'Daftar Artikel';
        $model       = new ArtikelModel();
        $q           = $this->request->getVar('q') ?? '';
        $kategori_id = $this->request->getVar('kategori_id') ?? '';

        // Query Builder dengan join kategori (Praktikum 6)
        $builder = $model->db->table('artikel')
            ->select('artikel.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');

        if ($q != '') {
            $builder->like('artikel.judul', $q);
        }

        if ($kategori_id != '') {
            $builder->where('artikel.id_kategori', $kategori_id);
        }

        // Pagination manual (Praktikum 5)
        $perPage    = 10;
        $page       = (int) ($this->request->getVar('page') ?? 1);
        $totalRows  = $builder->countAllResults(false);
        $artikel    = $builder->limit($perPage, ($page - 1) * $perPage)->get()->getResultArray();

        $pager = \Config\Services::pager();

        $kategoriModel = new KategoriModel();

        $data = [
            'title'       => $title,
            'q'           => $q,
            'kategori_id' => $kategori_id,
            'artikel'     => $artikel,
            'kategori'    => $kategoriModel->findAll(),
            'pager'       => $pager,
            'total'       => $totalRows,
            'perPage'     => $perPage,
            'page'        => $page,
        ];

        return view('artikel/admin_index', $data);
    }

    // ------------------------------------------------------------------
    // ADMIN - Tambah Artikel (Praktikum 2 + 7 upload gambar + 6 kategori)
    // ------------------------------------------------------------------
    public function add()
    {
        $validation = \Config\Services::validation();
        $validation->setRules(['judul' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model = new ArtikelModel();

            $gambarName = null;
            // Praktikum 7: Upload gambar
            $file = $this->request->getFile('gambar');
            if ($file && $file->isValid() && ! $file->hasMoved()) {
                $file->move(ROOTPATH . 'public/gambar');
                $gambarName = $file->getName();
            }

            $model->insert([
                'judul'       => $this->request->getPost('judul'),
                'isi'         => $this->request->getPost('isi'),
                'slug'        => url_title($this->request->getPost('judul')),
                'gambar'      => $gambarName,
                'id_kategori' => $this->request->getPost('id_kategori'),
            ]);

            return redirect()->to('/admin/artikel');
        }

        $kategoriModel = new KategoriModel();
        $title         = 'Tambah Artikel';
        $kategori      = $kategoriModel->findAll();
        return view('artikel/form_add', compact('title', 'kategori'));
    }

    // ------------------------------------------------------------------
    // ADMIN - Edit Artikel (Praktikum 2 + 6 kategori)
    // ------------------------------------------------------------------
    public function edit($id)
    {
        $model      = new ArtikelModel();
        $validation = \Config\Services::validation();
        $validation->setRules(['judul' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model->update($id, [
                'judul'       => $this->request->getPost('judul'),
                'isi'         => $this->request->getPost('isi'),
                'id_kategori' => $this->request->getPost('id_kategori'),
            ]);
            return redirect()->to('/admin/artikel');
        }

        $data              = $model->where('id', $id)->first();
        $kategoriModel     = new KategoriModel();
        $title             = 'Edit Artikel';
        $kategori          = $kategoriModel->findAll();
        return view('artikel/form_edit', compact('title', 'data', 'kategori'));
    }

    // ------------------------------------------------------------------
    // ADMIN - Hapus Artikel (Praktikum 2)
    // ------------------------------------------------------------------
    public function delete($id)
    {
        $model = new ArtikelModel();
        $model->delete($id);
        return redirect()->to('/admin/artikel');
    }
}
