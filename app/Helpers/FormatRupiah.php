<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah($number)
    {
        $number = str_replace(',', '.', $number); // Ganti koma jika ada dengan titik untuk desimal

        // Konversi nilai menjadi float
        $number = floatval($number);

        // Cek apakah ada angka desimal
        $decimalPlaces = strpos($number, '.') !== false ? strlen(substr(strrchr($number, "."), 1)) : 0;

        // Format angka tanpa membulatkan desimal
        return 'Rp. ' . number_format($number, $decimalPlaces, ',', '.');
    }
    function formatNominal($number)
    {
        return number_format($number, 0, ',', '.');
    }
}
