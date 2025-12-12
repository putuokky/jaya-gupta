<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use Illuminate\Http\Request;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\PesertaDidik;
use App\Models\Inovasi;
class berandaController extends Controller
{
    public function index(){
        $total_sekolah=Sekolah::count();
        // $total_pns=   User::with(['bio']=>)->count();
        return view('beranda');
    }
    public function index_sekolah(){
        $asal_satuan_pendidikan = Auth::user()->biodata->asal_satuan_pendidikan;
        $role = Auth::user()->getRoleNames()->first();
        $sekolah = Sekolah::with('kepala_sekolah')->where('npsn', $asal_satuan_pendidikan)->first();
        
        $jml['gtk']  = User::join('ms_biodatauser as b', 'users.id', '=', 'b.id')->where('b.asal_satuan_pendidikan', $sekolah->npsn)->count();
        $jml['rombel'] = Rombel::where('sekolah_npsn', $sekolah->npsn)->count();
        $jml['pd'] = PesertaDidik::where('sekolah_npsn', $sekolah->npsn)->count();
        $jml['inovasi'] = Inovasi::join('ms_biodatauser as b','b.id','=','tr_inovasi.bio_id')->where('b.asal_satuan_pendidikan', $sekolah->npsn)->when($role=='guru', function ($query) {
            $query->where('bio_id', Auth::user()->id);
        })->count();
        $jml['inovasi_tolak'] = Inovasi::join('ms_biodatauser as b','b.id','=','tr_inovasi.bio_id')->where('b.asal_satuan_pendidikan', $sekolah->npsn)->when($role=='guru', function ($query) {
            $query->where('bio_id', Auth::user()->id);
        })->where('tr_inovasi.status',0)->count();
        $jml['inovasi_lulus'] = Inovasi::join('ms_biodatauser as b','b.id','=','tr_inovasi.bio_id')->where('b.asal_satuan_pendidikan', $sekolah->npsn)->when($role=='guru', function ($query) {
            $query->where('bio_id', Auth::user()->id);
        })->where('tr_inovasi.status',1)->count();
        $jml['menunggu_penilaian'] = Inovasi::join('ms_biodatauser as b','b.id','=','tr_inovasi.bio_id')->where('b.asal_satuan_pendidikan', $sekolah->npsn)->when($role=='guru', function ($query) {
            $query->where('bio_id', Auth::user()->id);
        })->with('nilai.owner', 'owner')->doesntHave('nilai')->count();
        return view('beranda_sekolah', compact('sekolah','jml'));
    }

}
