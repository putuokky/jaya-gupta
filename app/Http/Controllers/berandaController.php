<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;
use App\Models\User;
class berandaController extends Controller
{
    public function index(){
        $total_sekolah=Sekolah::count();
        // $total_pns=   User::with(['bio']=>)->count();
        return view('beranda');
    }
}
