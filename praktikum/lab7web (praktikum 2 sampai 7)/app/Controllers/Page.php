<?php

namespace App\Controllers;

/**
 * Page Controller - Praktikum 1
 * Menangani halaman-halaman statis.
 */
class Page extends BaseController
{
    public function about()
    {
        return view('about', [
            'title'   => 'Halaman About',
            'content' => 'Ini adalah halaman About yang menjelaskan tentang isi halaman ini.'
        ]);
    }

    public function contact()
    {
        return view('contact', [
            'title'   => 'Halaman Contact',
            'content' => 'Ini adalah halaman Contact. Silakan hubungi kami melalui email atau telepon.'
        ]);
    }

    public function faqs()
    {
        return view('faqs', [
            'title'   => 'Halaman FAQ',
            'content' => 'Berikut adalah pertanyaan-pertanyaan yang sering diajukan.'
        ]);
    }

    public function tos()
    {
        echo "ini halaman Term of Services";
    }
}
