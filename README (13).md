<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('home', [
            'title'   => 'Halaman Home',
            'content' => 'Selamat datang di Portal Berita. Ini adalah halaman utama website.'
        ]);
    }
}
