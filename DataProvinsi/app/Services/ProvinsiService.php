<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProvinsiService
{
    private $apiUrl = 'https://wilayah.id/api/provinces.json';
    private $provinsis = null;

    public function __construct()
    {
        $this->loadProvinsis();
    }

    private function loadProvinsis()
    {
        try {
            $response = Http::get($this->apiUrl);
            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['data']) && is_array($data['data'])) {
                    $this->provinsis = $data['data'];
                } else {
                    Log::error("Data dari API tidak valid (tidak ada key 'data' atau bukan array): " . json_encode($data));
                    $this->provinsis = [];
                    throw new \Exception("Data dari API tidak valid.");
                }
            } else {
                Log::error("Gagal mengambil data provinsi dari API: " . $response->status());
                throw new \Exception("Gagal mengambil data provinsi dari API.");
            }
        } catch (\Exception $e) {
            Log::error("Error saat loadProvinsis: " . $e->getMessage());
            $this->provinsis = [];
        }
    }

    public function getProvinsis()
    {
        return $this->provinsis;
    }

    public function getProvinsi($id)
    {
        if ($this->provinsis === null || !is_array($this->provinsis)) {
            Log::error("Data provinsi belum di load atau bukan array.");
            return null;
        }

        foreach ($this->provinsis as $provinsi) {
            if (isset($provinsi['code']) && (string)$provinsi['code'] === (string)$id) {
                return $provinsi;
            }
        }
        return null;
    }

    public function addProvinsi($data) {
        $newCode = count($this->provinsis) > 0 ? (int)max(array_column($this->provinsis, 'code')) + 1 : 1;
        $data['code'] = (string)$newCode;
        $this->provinsis[] = $data;
        return $data;
    }

    public function updateProvinsi($id, $data) {
        foreach ($this->provinsis as $key => &$provinsi) {
            if ((string)$provinsi['code'] === (string)$id) {
                $this->provinsis[$key] = array_merge($provinsi, $data);
                return $this->provinsis[$key];
            }
        }
        return null;
    }

    public function deleteProvinsi($id) {
        foreach ($this->provinsis as $key => $provinsi) {
            if ((string)$provinsi['code'] === (string)$id) {
                unset($this->provinsis[$key]);
                $this->provinsis = array_values($this->provinsis);
                return true;
            }
        }
        return false;
    }
}
