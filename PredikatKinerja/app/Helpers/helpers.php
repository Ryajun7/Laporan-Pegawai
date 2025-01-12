<?php

if (! function_exists('predikat_kinerja')) {
    function predikat_kinerja($hasil_kerja, $perilaku) {
        switch ($hasil_kerja) {
            case "Dibawah ekspektasi":
                switch ($perilaku) {
                    case "Dibawah ekspektasi":
                        return "Sangat Kurang";
                    case "Sesuai ekspektasi":
                        return "Butuh perbaikan";
                    case "Diatas ekspektasi":
                        return "Butuh perbaikan";
                    default:
                        return "Input perilaku tidak valid";
                }
            case "Sesuai ekspektasi":
                switch ($perilaku) {
                    case "Dibawah ekspektasi":
                        return "Kurang/misconduct";
                    case "Sesuai ekspektasi":
                        return "Baik";
                    case "Diatas ekspektasi":
                        return "Baik";
                    default:
                        return "Input perilaku tidak valid";
                }
            case "Diatas ekspektasi":
                switch ($perilaku) {
                    case "Dibawah ekspektasi":
                        return "Kurang/misconduct";
                    case "Sesuai ekspektasi":
                        return "Baik";
                    case "Diatas ekspektasi":
                        return "Sangat Baik";
                    default:
                        return "Input perilaku tidak valid";
                }
            default:
                return "Input hasil kerja tidak valid";
        }
    }
}
