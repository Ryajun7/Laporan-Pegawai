<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProvinsiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinsiController extends Controller
{
    protected $provinsiService;

    public function __construct(ProvinsiService $provinsiService)
    {
        $this->provinsiService = $provinsiService;
    }

    public function index()
    {
        try {
            $provinsis = $this->provinsiService->getProvinsis();
            return response()->json($provinsis);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat mengambil data provinsi.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $provinsi = $this->provinsiService->getProvinsi($id);
            if (!$provinsi) {
                return response()->json(['message' => 'Provinsi tidak ditemukan'], 404);
            }
            return response()->json($provinsi);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat mengambil data provinsi.'], 500);
        }
    }

    public function store(Request $request) {
      $validator = Validator::make($request->all(), [
          'name' => 'required|string|max:255',
      ]);

      if ($validator->fails()) {
          return response()->json(['errors' => $validator->errors()], 422);
      }
      try {
        $provinsi = $this->provinsiService->addProvinsi($request->all());
        return response()->json($provinsi, 201);
      } catch (\Exception $e) {
        return response()->json(['message' => 'Terjadi kesalahan saat menambahkan data provinsi.'], 500);
      }
    }

    public function update(Request $request, $id) {
      $validator = Validator::make($request->all(), [
          'name' => 'required|string|max:255',
      ]);

      if ($validator->fails()) {
          return response()->json(['errors' => $validator->errors()], 422);
      }
      try {
        $provinsi = $this->provinsiService->updateProvinsi($id, $request->all());
        if(!$provinsi){
          return response()->json(['message' => 'Provinsi tidak ditemukan'], 404);
        }
        return response()->json($provinsi);
      } catch (\Exception $e) {
        return response()->json(['message' => 'Terjadi kesalahan saat mengupdate data provinsi.'], 500);
      }
    }

    public function destroy($id) {
      try {
        $result = $this->provinsiService->deleteProvinsi($id);
        if(!$result){
          return response()->json(['message' => 'Provinsi tidak ditemukan'], 404);
        }
        return response()->json(['message' => 'Provinsi berhasil dihapus'], 204);
      } catch (\Exception $e) {
        return response()->json(['message' => 'Terjadi kesalahan saat menghapus data provinsi.'], 500);
      }
    }
}
