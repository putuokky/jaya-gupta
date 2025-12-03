<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TendikController extends Controller
{
    public function index()
    {
        return view('GTK.tendik.index');
    }

    public function perWilayah($kode_wil)
    {
        return view('GTK.tendik.perWilayah', compact('kode_wil'));
    }

    public function perSekolah($kode_sekolah)
    {
        return view('GTK.tendik.perSekolah', compact('kode_sekolah'));
    }
}
