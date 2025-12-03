<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rombel;
use App\Models\Sekolah;
use Illuminate\Support\Facades\DB;
class RombelController extends Controller
{
    public function index()
    {
        $data = Sekolah::select(DB::raw("
            kode_wilayah_induk_kecamatan as kode_wil,
            induk_kecamatan,
            count(*) AS total,
            SUM(CASE WHEN bentuk_pendidikan = 'TK' THEN 1 ELSE 0 END) AS TK,
            SUM(CASE WHEN bentuk_pendidikan = 'SD' THEN 1 ELSE 0 END) AS SD,
            SUM(CASE WHEN bentuk_pendidikan = 'SMP' THEN 1 ELSE 0 END) AS SMP      
    "))
    ->join('ms_rombel', 'ms_sekolah.npsn', '=', 'ms_rombel.sekolah_npsn')
    ->whereIn('bentuk_pendidikan', ['TK','SD','SMP'])
    ->groupBy('induk_kecamatan', 'kode_wilayah_induk_kecamatan')
    ->paginate();
        return view('GTK.rombel.index', compact('data'));
    }
    public function rombel_kec(Request $request, $kode_wil)
    {
        $search = $request->input('search');
        $kode_wil = decrypt($kode_wil);

          $data = Sekolah::withCount([
            'Rombel as rombel_count' => function($q){
                $q->select(DB::raw("count(*)"));
            },
        ])
        ->when($search, function($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%')
                         ->orWhere('npsn', 'like', '%' . $search . '%');
        })
        ->where('kode_wilayah_induk_kecamatan', $kode_wil)
        ->whereIn('bentuk_pendidikan', ['TK','SD','SMP'])
        ->paginate(10);
 
        return view('GTK.rombel.perKecamatan', compact('data'));
    }
    public function rombel_sekolah($kode_sekolah)
    {
       

        $data = Rombel::with('walikelas')
            ->withCount([
           
            'peserta_didik as jumlah_siswa_l' => function($q)use($kode_sekolah){
                $q->whereIn('jk', ['L', 'Laki-laki']);
                $q->where('sekolah_npsn', $kode_sekolah);
            },
            'peserta_didik as jumlah_siswa_p' => function($q)use($kode_sekolah){
                $q->whereIn('jk', ['P', 'Perempuan']);
                $q->where('sekolah_npsn', $kode_sekolah);
            },
            ])
            ->where('sekolah_npsn', $kode_sekolah)
            ->paginate(10);
        $sekolah = Sekolah::where('npsn', $kode_sekolah)->first();
 
        return view('GTK.rombel.perSekolah', compact('data', 'sekolah'));
    }
}
