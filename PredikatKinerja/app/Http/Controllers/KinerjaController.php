<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KinerjaController extends Controller
{
    public function index()
    {
        return view('kinerja.index');
    }

    public function prediksi(Request $request)
    {
        $hasil_kerja = $request->input('hasil_kerja');
        $perilaku = $request->input('perilaku');
        $prediksi = predikat_kinerja($hasil_kerja, $perilaku);

        return response()->json(['prediksi' => $prediksi]);
    }
}
