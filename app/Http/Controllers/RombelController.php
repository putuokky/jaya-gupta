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
}
