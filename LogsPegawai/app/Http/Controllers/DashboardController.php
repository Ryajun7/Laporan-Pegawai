<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $jabatan = $user->Jabatan;

        $query = Log::latest();

        if ($jabatan === 'Pegawai') {
            $query->where('Jabatan', 'Pegawai');
        } elseif ($jabatan === 'Kepala Bidang') {
            $query->whereIn('Jabatan', ['Pegawai', 'Kepala Bidang']);
        }

        $daftarCatatan = $query->get();

        return view('dashboard.index', compact('daftarCatatan'));
    }
}
