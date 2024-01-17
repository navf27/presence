<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //index
    public function index(){
        $countUser = User::count();
        $countDivision = Divisi::count();
        $countPresence = Presensi::count();

        return view('dashboard', compact('countUser', 'countDivision', 'countPresence'));
    }
}
