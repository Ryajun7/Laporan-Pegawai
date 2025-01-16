<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = Log::where('Status', 'Pending');

        if ($user->Jabatan === 'Kepala Bidang') {
            $query->where('Jabatan', 'Pegawai');
        } elseif ($user->Jabatan !== 'Kepala Dinas') {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $daftarVerifikasi = $query->get();
        return view('verifikasi.index', compact('daftarVerifikasi'));
    }

    public function updateStatus(Request $request, Log $log)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak',
        ]);
        $user = Auth::user();
        if ($user->Jabatan === 'Kepala Bidang' && $log->Jabatan !== 'Pegawai') {
            return abort(403, 'Anda tidak diizinkan mengubah status catatan ini.');
        } else if ($user->Jabatan !== 'Kepala Dinas' && $user->Jabatan !== 'Kepala Bidang') {
            return abort(403, 'Anda tidak diizinkan mengubah status catatan ini.');
        }
        $log->Status = $request->status;
        $log->save();

        return redirect()->route('verifikasi.index')->with('success', 'Status catatan berhasil diperbarui.');
    }

    public function save(Log $log)
    {
         $user = Auth::user();
        if ($user->Jabatan === 'Kepala Bidang' && $log->Jabatan !== 'Pegawai') {
            return abort(403, 'Anda tidak diizinkan mengubah status catatan ini.');
        } else if ($user->Jabatan !== 'Kepala Dinas' && $user->Jabatan !== 'Kepala Bidang') {
            return abort(403, 'Anda tidak diizinkan mengubah status catatan ini.');
        }
        if($log->Status != "Pending"){
            $log->delete();
            return redirect()->route('dashboard')->with('success', 'Catatan berhasil disimpan.');
        }else{
            return redirect()->back()->with('error', 'Status catatan belum diubah.');
        }
    }
}
