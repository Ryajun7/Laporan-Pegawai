<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function create()
    {
        return view('logs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Catatan' => 'required|string',
        ]);

        $user = Auth::user();

        Log::create([
            'NIP' => $user->NIP,
            'Nama' => $user->Nama,
            'Jabatan' => $user->Jabatan,
            'Catatan' => $request->Catatan,
            'Tanggal' => now()->format('Y-m-d'),
            'Status' => 'Pending',
        ]);


        return redirect()->route('dashboard')->with('success', 'Catatan harian berhasil disimpan.'); // Redirect ke route 'dashboard'
    }

    public function edit(Log $log)
    {
        return view('logs.edit', compact('log'));
    }

    public function update(Request $request, Log $log)
    {
        $request->validate([
            'Catatan' => 'required|string',
            'Tanggal' => 'required|date',
        ]);

        $log->Catatan = $request->Catatan;
        $log->Tanggal = $request->Tanggal;
        $log->save();

        return redirect()->route('dashboard')->with('success', 'Catatan berhasil diperbarui.');
    }

    public function destroy(Log $log)
    {
        $log->delete();
        return redirect()->route('dashboard')->with('success', 'Catatan berhasil dihapus.');
    }

    public function submit(Log $log)
    {
        $user = Auth::user();
        if($user->NIP != $log->NIP){
            return abort(403, 'Anda tidak diizinkan mensubmit catatan ini.');
        }
        if($log->Status == 'Pending'){
            return redirect()->back()->with('error', 'Catatan ini sudah di submit');
        }
        $log->Status = 'Pending';
        $log->save();

        return redirect()->route('dashboard')->with('success', 'Catatan berhasil disubmit dan menunggu verifikasi.');
    }
}
