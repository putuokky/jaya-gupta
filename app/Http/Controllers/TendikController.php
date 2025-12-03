<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class TendikController extends Controller
{
    public function index()
    {
       $data = DB::table('model_has_roles as mhr')
        ->join('roles as r', 'mhr.role_id', '=', 'r.id')
        ->join('users', 'mhr.model_id', '=', 'users.id')
        ->join('ms_biodatauser as b', 'users.id', '=', 'b.id')
        ->join('ms_sekolah as s', 'b.asal_satuan_pendidikan', '=', 's.npsn')
        ->where('r.name', 'tendik')
        ->groupBy('s.induk_kecamatan','s.kode_wilayah_induk_kecamatan')
        ->selectRaw("
            s.induk_kecamatan,
            s.kode_wilayah_induk_kecamatan,
           
            COUNT(DISTINCT CASE WHEN b.gender = 'L' THEN users.id END) as jumlah_l,
            COUNT(DISTINCT CASE WHEN b.gender = 'W' THEN users.id END) as jumlah_w,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'TK' AND b.gender = 'L' THEN users.id END) as tk_l,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SD' AND b.gender = 'L' THEN users.id END) as sd_l,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SMP' AND b.gender = 'L' THEN users.id END) as smp_l,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'TK' AND b.gender = 'W' THEN users.id END) as tk_p,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SD' AND b.gender = 'W' THEN users.id END) as sd_p,
            COUNT(DISTINCT CASE WHEN s.bentuk_pendidikan = 'SMP' AND b.gender = 'W' THEN users.id END) as smp_p
            
        ")
        ->get();
        return view('GTK.tendik.index', compact('data'));
    }

    public function perWilayah(Request $request, $kode_wil)
    {
         $search = $request->input('search');
        $kode_wil = decrypt($kode_wil);

          $data = Sekolah::when($search, function($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%')
                             ->orWhere('npsn', 'like', '%' . $search . '%');
            })
            ->where('kode_wilayah_induk_kecamatan', $kode_wil)
            ->whereIn('bentuk_pendidikan', ['TK','SD','SMP'])
            ->select('ms_sekolah.*')
            ->selectSub(function($query){
                $query->from('users')
                    ->join('ms_biodatauser as b','users.id','=','b.id')
                    ->join('model_has_roles as mhr','mhr.model_id','=','users.id')
                    ->join('roles as r','mhr.role_id','=','r.id')
                    ->whereColumn('b.asal_satuan_pendidikan','ms_sekolah.npsn')
                    ->where('r.name','tendik')
                    ->selectRaw('COUNT(DISTINCT users.id)');
            }, 'total')
            ->selectSub(function($query){
                $query->from('users')
                    ->join('ms_biodatauser as b','users.id','=','b.id')
                    ->join('model_has_roles as mhr','mhr.model_id','=','users.id')
                    ->join('roles as r','mhr.role_id','=','r.id')
                    ->whereColumn('b.asal_satuan_pendidikan','ms_sekolah.npsn')
                    ->where('r.name','tendik')
                    ->where('b.gender','L')
                    ->selectRaw('COUNT(DISTINCT users.id)');
            }, 'laki_laki_count')
            ->selectSub(function($query){
                $query->from('users')
                    ->join('ms_biodatauser as b','users.id','=','b.id')
                    ->join('model_has_roles as mhr','mhr.model_id','=','users.id')
                    ->join('roles as r','mhr.role_id','=','r.id')
                    ->whereColumn('b.asal_satuan_pendidikan','ms_sekolah.npsn')
                    ->where('r.name','tendik')
                    ->where('b.gender','W')
                    ->selectRaw('COUNT(DISTINCT users.id)');
            }, 'perempuan_count')
            ->paginate(10);
       
      
        return view('GTK.tendik.perKecamatan', compact('data'));
    }

    public function perSekolah($kode_sekolah)
    {
          $kode_sekolah = decrypt($kode_sekolah);

        $data = User::join('ms_biodatauser as b', 'users.id', '=', 'b.id')->whereHas('roles', function($q) {
            $q->where('name', 'tendik');
        })->where('b.asal_satuan_pendidikan', $kode_sekolah)->paginate(10);

        $sekolah = Sekolah::where('npsn', $kode_sekolah)->first();
      
        return view('GTK.tendik.perSekolah', compact('kode_sekolah', 'data', 'sekolah'));
    }
}
