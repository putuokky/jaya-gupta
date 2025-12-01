<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;
use Illuminate\Support\Facades\DB;
use App\Models\PesertaDidik;
class pesertaDidikController extends Controller
{
    public function index_admin()
    {
       

    $data = Sekolah::select(DB::raw("
        kode_wilayah_induk_kecamatan as kode_wil,
        induk_kecamatan,
        count(*) AS total,
        SUM(CASE WHEN bentuk_pendidikan = 'TK' THEN 1 ELSE 0 END) AS TK,
        SUM(CASE WHEN bentuk_pendidikan = 'TK' AND (tr_pesertadidik.jk = 'L' OR tr_pesertadidik.jk = 'Laki-laki') THEN 1 ELSE 0 END) AS TK_L,
        SUM(CASE WHEN bentuk_pendidikan = 'TK' AND (tr_pesertadidik.jk = 'P' OR tr_pesertadidik.jk = 'Perempuan') THEN 1 ELSE 0 END) AS TK_P,
        SUM(CASE WHEN bentuk_pendidikan = 'SD' THEN 1 ELSE 0 END) AS SD,
        SUM(CASE WHEN bentuk_pendidikan = 'SD' AND (tr_pesertadidik.jk = 'L' OR tr_pesertadidik.jk = 'Laki-laki') THEN 1 ELSE 0 END) AS SD_L,
        SUM(CASE WHEN bentuk_pendidikan = 'SD' AND (tr_pesertadidik.jk = 'P' OR tr_pesertadidik.jk = 'Perempuan') THEN 1 ELSE 0 END) AS SD_P,
        SUM(CASE WHEN bentuk_pendidikan = 'SMP' THEN 1 ELSE 0 END) AS SMP,
        SUM(CASE WHEN bentuk_pendidikan = 'SMP' AND (tr_pesertadidik.jk = 'L' OR tr_pesertadidik.jk = 'Laki-laki') THEN 1 ELSE 0 END) AS SMP_L,
        SUM(CASE WHEN bentuk_pendidikan = 'SMP' AND (tr_pesertadidik.jk = 'P' OR tr_pesertadidik.jk = 'Perempuan') THEN 1 ELSE 0 END) AS SMP_P
    "))
    ->join('tr_pesertadidik', 'ms_sekolah.npsn', '=', 'tr_pesertadidik.sekolah_npsn')
    ->whereIn('bentuk_pendidikan', ['TK','SD','SMP'])
    ->groupBy('induk_kecamatan', 'kode_wilayah_induk_kecamatan')
    ->get();

        return view('GTK.peserta_didik.index',compact('data'));
    }
    public function peserta_didik_kec(Request $request, $kode_wil)
    {
        $search = $request->input('search');
        $kode_wil = decrypt($kode_wil);

          $data = Sekolah::withCount([
            'PesertaDidik as laki_laki_count' => function($q){
            $q->where('jk', 'L')->orWhere('jk', 'Laki-laki');
            },
            'PesertaDidik as perempuan_count' => function($q){
            $q->where('jk', 'P')->orWhere('jk', 'Perempuan');
            },
        ])
        ->when($search, function($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%')
                         ->orWhere('npsn', 'like', '%' . $search . '%');
        })
        ->where('kode_wilayah_induk_kecamatan', $kode_wil)
        ->whereIn('bentuk_pendidikan', ['TK','SD','SMP'])
        ->paginate(10);

        return view('GTK.peserta_didik.show', compact('data'));
    }
    public function peserta_didik_sekolah($kode_sekolah)
    {
        $kode_sekolah = decrypt($kode_sekolah);

        $data = PesertaDidik::where('sekolah_npsn', $kode_sekolah)->paginate(10);
   

        return view('GTK.peserta_didik.perSekolah', compact('data'));
    }
}
