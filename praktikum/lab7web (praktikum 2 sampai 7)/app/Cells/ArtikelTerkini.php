<?php

namespace App\Cells;

use CodeIgniter\View\Cell;
use App\Models\ArtikelModel;

/**
 * ArtikelTerkini View Cell - Praktikum 3
 * Komponen reusable untuk sidebar artikel terkini.
 */
class ArtikelTerkini extends Cell
{
    public function render(): string
    {
        $model   = new ArtikelModel();
        $artikel = $model->orderBy('id', 'DESC')->limit(5)->findAll();
        return view('components/artikel_terkini', ['artikel' => $artikel]);
    }
}
