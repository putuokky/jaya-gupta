<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Sekolah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\PesertaDidik;
class SekolahController extends Controller
{
    public function index()
    {
        $semester_id = date('Y') . '1';
 

    
           $data= Sekolah::select(DB::raw("kode_wilayah_induk_kecamatan as kode_wil, induk_kecamatan,
           count(*) AS total,
            SUM ( CASE WHEN bentuk_pendidikan = 'TK' THEN 1 ELSE 0 END ) AS TK,
            SUM ( CASE WHEN bentuk_pendidikan = 'SD' THEN 1 ELSE 0 END ) AS SD,
            SUM ( CASE WHEN bentuk_pendidikan = 'SMP' THEN 1 ELSE 0 END ) AS SMP"))            
            ->whereIn('bentuk_pendidikan', ['TK','SD','SMP'])
            ->groupBy("induk_kecamatan", "kode_wilayah_induk_kecamatan")
            ->get();
         
        return view('GTK.sekolah.index', compact('data'));
    }
    public function sekolah_kec(Request $request, $id_level_wil, $kode_wil)
    {
        $search = $request->input('search');
        $semester_id = date('Y') . '1';
        $kode_wil = Crypt::decrypt($kode_wil);
        
        
        $data = Sekolah::withCount([
            'guru as guru_spatie_count' => function($q){
            $q->whereHas('roles', function($q2){
                $q2->where('name', 'guru');
            });
            },
            'guru as tendik_spatie_count' => function($q){
            $q->whereHas('roles', function($q2){
                $q2->where('name', 'tendik');
            });
            },
        ])
        ->when($search, function($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%')
                         ->orWhere('npsn', 'like', '%' . $search . '%');
        })
        ->where('kode_wilayah_induk_kecamatan', $kode_wil)
        ->whereIn('bentuk_pendidikan', ['TK','SD','SMP'])
        ->paginate(10);
        
        return view('GTK.sekolah.show', compact('data'));
    }

    public function sekolah_detail($npsn)
    {
        $semester_id = date('Y') . '1';
        $npsn = Crypt::decrypt($npsn);
        $getData =Sekolah::withCount(['PesertaDidik'=>function($q) {
            $q->whereNotNull('rombel');
        }])->where('npsn', $npsn)->first();
          
        return view('GTK.sekolah.detail', compact('getData'));
    }
}
