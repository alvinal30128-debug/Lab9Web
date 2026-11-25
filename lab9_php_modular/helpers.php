<?php
/**
 * helpers.php - kumpulan function latihan (Bagian E)
 */

// Escaping output agar aman ditampilkan ke HTML
function e(string $nilai): string {
    return htmlspecialchars($nilai, ENT_QUOTES, 'UTF-8');
}

function formatRupiah(float $angka): string {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

// Latihan 1: konversi suhu
function konversiCelciusKeFahrenheit(float $c): float {
    return ($c * 9 / 5) + 32;
}

// Latihan 2: predikat nilai (rentang ditetapkan sendiri)
function tentukanStatusNilai(float $nilai): string {
    if ($nilai >= 85) return 'A (Sangat Baik)';
    if ($nilai >= 70) return 'B (Baik)';
    if ($nilai >= 55) return 'C (Cukup)';
    if ($nilai >= 40) return 'D (Kurang)';
    return 'E (Tidak Lulus)';
}

// Latihan 3: total belanja
function hitungTotal(float $harga, int $jumlah): float {
    return $harga * $jumlah;
}

// Function dengan nilai default (contoh bagian E.4)
function hitungDiskon(float $harga, float $persen = 10): float {
    return $harga * ($persen / 100);
}
