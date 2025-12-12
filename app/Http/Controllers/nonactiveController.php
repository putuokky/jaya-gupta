<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class nonactiveController extends Controller
{
    public function index_nonaktif()
    {
 $data = DB::table('model_has_roles as mhr')
        ->join('roles as r', 'mhr.role_id', '=', 'r.id')
        ->join('users', 'mhr.model_id', '=', 'users.id')
        ->join('ms_biodatauser as b', 'users.id', '=', 'b.id')
        ->join('ms_sekolah as s', 'b.asal_satuan_pendidikan', '=', 's.npsn')
        ->where('r.name', 'nonaktif')
        ->groupBy('s.induk_kecamatan','s.kode_wilayah_induk_kecamatan')
        ->selectRaw("
            s.induk_kecamatan,
            s.kode_wilayah_induk_kecamatan,
           
            COUNT(DISTINCT CASE WHEN b.gender = 'L' THEN users.id END) as jumlah_l,
            COUNT(DISTINCT CASE WHEN b.gender = 'W' THEN users.id END) as jumlah_w,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'TK' AND b.gender = 'L' THEN users.id END) as tk_l,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'TK' AND b.gender = 'W' THEN users.id END) as tk_p,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SD' AND b.gender = 'L' THEN users.id END) as sd_l,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SD' AND b.gender = 'W' THEN users.id END) as sd_p,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SMP' AND b.gender = 'L' THEN users.id END) as smp_l,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SMP' AND b.gender = 'W' THEN users.id END) as smp_p,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SMA' AND b.gender = 'L' THEN users.id END) as sma_l,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SMA' AND b.gender = 'W' THEN users.id END) as sma_p,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SMK' AND b.gender = 'W' THEN users.id END) as smk_p,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SMK' AND b.gender = 'L' THEN users.id END) as smk_l,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SLB' AND b.gender = 'W' THEN users.id END) as slb_p,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SLB' AND b.gender = 'L' THEN users.id END) as slb_l
            
            
        ")
        ->get();
        // dd($data);
        return view('GTK.nonaktif.index', compact('data'));
    }
    public function perWilayah(Request $request, $kode_wil)
    {
        $search = $request->input('search');
        $kode_wil = decrypt($kode_wil);

          $data = DB::table('model_has_roles as mhr')
        ->join('roles as r', 'mhr.role_id', '=', 'r.id')
        ->join('users', 'mhr.model_id', '=', 'users.id')
        ->join('ms_biodatauser as b', 'users.id', '=', 'b.id')
        ->join('ms_sekolah as s', 'b.asal_satuan_pendidikan', '=', 's.npsn')
        ->where('r.name', 'nonaktif')
        ->when($search, function($query, $search) {
                return $query->where('s.nama', 'like', '%' . $search . '%')
                             ->orWhere('s.npsn', 'like', '%' . $search . '%');
            })
        ->where('s.kode_wilayah_induk_kecamatan', $kode_wil)
        ->select('s.*')
        ->selectRaw("
            COUNT(DISTINCT CASE WHEN b.gender = 'L' THEN users.id END) as jumlah_l,
            COUNT(DISTINCT CASE WHEN b.gender = 'W' THEN users.id END) as jumlah_w,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'TK' AND b.gender = 'L' THEN users.id END) as tk_l,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'TK' AND b.gender = 'W' THEN users.id END) as tk_p,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SD' AND b.gender = 'L' THEN users.id END) as sd_l,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SD' AND b.gender = 'W' THEN users.id END) as sd_p,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SMP' AND b.gender = 'L' THEN users.id END) as smp_l,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SMP' AND b.gender = 'W' THEN users.id END) as smp_p,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SMA' AND b.gender = 'L' THEN users.id END) as sma_l,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SMA' AND b.gender = 'W' THEN users.id END) as sma_p,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SMK' AND b.gender = 'W' THEN users.id END) as smk_p,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SMK' AND b.gender = 'L' THEN users.id END) as smk_l,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SLB' AND b.gender = 'W' THEN users.id END) as slb_p,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SLB' AND b.gender = 'L' THEN users.id END) as slb_l
        ")
        ->groupBy('s.sekolah_id', 's.npsn', 's.nama', 's.bentuk_pendidikan', 's.induk_kecamatan', 's.kode_wilayah_induk_kecamatan')
        ->paginate(10);
            // dd($data);
          
        return view('GTK.nonaktif.perKecamatan', compact('data'));
    }
    public function perSekolah(Request $request, $kode_sekolah)
    {
        $kode_sekolah = decrypt($kode_sekolah);

        $data = DB::table('model_has_roles as mhr')
        ->join('roles as r', 'mhr.role_id', '=', 'r.id')
        ->join('users', 'mhr.model_id', '=', 'users.id')
        ->join('ms_biodatauser as b', 'users.id', '=', 'b.id')
        ->join('ms_sekolah as s', 'b.asal_satuan_pendidikan', '=', 's.npsn')
        ->where('r.name', 'nonaktif')
        ->where('r.name', 'nonaktif')
        ->where('s.sekolah_id', $kode_sekolah)

        ->when($request->input('search'), function($query, $search) {
                return $query->where('b.nama_lengkap', 'like', '%' . $search . '%')
                             ->orWhere('b.nik', 'like', '%' . $search . '%');
            })
        ->paginate(10);
    
            // dd($data);
        return view('GTK.nonaktif.perSekolah', compact('data'));
    }
}
