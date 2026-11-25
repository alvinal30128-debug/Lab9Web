<?php
/**
 * helpers/functions.php - function umum yang dipakai banyak modul
 */

// ---------- Tampilan ----------
function e(?string $nilai): string {
    return htmlspecialchars((string) $nilai, ENT_QUOTES, 'UTF-8');
}

function formatRupiah(float $angka): string {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

function hitungDiskon(float $harga, float $persen = 10): float {
    return $harga * ($persen / 100);
}

function ringkasTeks(?string $teks, int $batas = 40): string {
    $teks = trim((string) $teks);
    if (mb_strlen($teks) <= $batas) {
        return $teks;
    }
    return rtrim(mb_substr($teks, 0, $batas)) . '...';
}

// ---------- Validasi ----------
function validasiEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// ---------- URL & routing ----------
// Folder dasar aplikasi, agar path aset tetap benar walau URL di-rewrite
function base_path(): string {
    $dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    return rtrim($dir, '/');
}

function asset(string $path): string {
    return base_path() . '/assets/' . ltrim($path, '/');
}

// Membuat tautan ke rute: url('user/edit', ['id' => 3])
function url(string $page = 'dashboard', array $params = []): string {
    $query = http_build_query(['page' => $page] + $params);
    return base_path() . '/index.php?' . $query;
}

function redirect(string $page, array $params = []): void {
    header('Location: ' . url($page, $params));
    exit;
}

function isMenuAktif(string $page, string $awalan): string {
    return str_starts_with($page, $awalan) ? 'active' : '';
}

// ---------- Pesan flash ----------
function setFlash(string $tipe, string $pesan): void {
    $_SESSION['flash'] = ['tipe' => $tipe, 'pesan' => $pesan];
}

function tampilFlash(): string {
    if (empty($_SESSION['flash'])) {
        return '';
    }
    $f = $_SESSION['flash'];
    unset($_SESSION['flash']);
    $kelas = $f['tipe'] === 'sukses' ? 'alert-sukses' : 'alert-gagal';
    return '<div class="alert ' . $kelas . '">' . e($f['pesan']) . '</div>';
}

// ---------- CSRF ----------
function csrfToken(): string {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrfField(): string {
    return '<input type="hidden" name="csrf" value="' . e(csrfToken()) . '">';
}

function csrfValid(): bool {
    $kirim = $_POST['csrf'] ?? '';
    return is_string($kirim) && hash_equals(csrfToken(), $kirim);
}
