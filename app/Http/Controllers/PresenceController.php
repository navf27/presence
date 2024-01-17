<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    public function index(){
        $data = Presensi::all();

        return view('presence', compact('data'));
    }

    public function presence(){
        $namaUser = session('nama');
        $divisiUser = session('divisi');
        
        $maxTime = Carbon::createFromTime(7, 0, 0);
        $reqTime = Carbon::now()->format('Y-m-d H:i:s');

        if($reqTime < $maxTime){
            Presensi::create([
                'nama' => $namaUser,
                'divisi' => $divisiUser,
                'keterlambatan' => false
            ]);

            Auth::logout();

            return redirect()->route('login')->with('successPresence', 'Presence Successfull. Your Status: On Time!');
        } elseif($reqTime > $maxTime){
            Presensi::create([
                'nama' => $namaUser,
                'divisi' => $divisiUser,
                'keterlambatan' => true
            ]);

            Auth::logout();

            return redirect()->route('login')->with('latePresence', 'Presence Successfull. Your Status: Late!');
        }
    }

    public function clean(){
        Presensi::truncate();

        return redirect()->back()->with('cleanSuccess', 'Clean up successfull!');
    }
}
