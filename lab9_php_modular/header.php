<?php
// Menentukan menu aktif berdasarkan nama file yang sedang dibuka
$halamanAktif = basename($_SERVER['SCRIPT_NAME']);
$judul = $judul ?? 'Aplikasi PHP Modular';
function aktif(string $file, string $sekarang): string {
    return $file === $sekarang ? 'class="active"' : '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Aplikasi PHP Modular</h1>
        <p>Contoh pemisahan template dan konten</p>
    </header>
    <nav>
        <a href="home.php" <?php echo aktif('home.php', $halamanAktif); ?>>Home</a>
        <a href="about.php" <?php echo aktif('about.php', $halamanAktif); ?>>Tentang</a>
        <a href="profil.php" <?php echo aktif('profil.php', $halamanAktif); ?>>Profil</a>
        <a href="kontak.php" <?php echo aktif('kontak.php', $halamanAktif); ?>>Kontak</a>
        <a href="latihan-function.php" <?php echo aktif('latihan-function.php', $halamanAktif); ?>>Latihan Function</a>
    </nav>
    <main>
