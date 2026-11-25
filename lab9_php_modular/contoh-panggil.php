<?php
$judul = 'Contoh Panggil Helper';
require_once __DIR__ . '/helpers.php';   // dipanggil dari halaman kedua
require_once __DIR__ . '/header.php';
?>
<section class="content">
    <h2>Contoh Pemanggilan helpers.php dari Halaman Lain</h2>
    <div class="hasil">formatRupiah(150000) = <?php echo formatRupiah(150000); ?></div>
    <div class="hasil">Status nilai 88 = <?php echo e(tentukanStatusNilai(88)); ?></div>
    <div class="hasil">100&deg;C = <?php echo konversiCelciusKeFahrenheit(100); ?>&deg;F</div>
</section>
<?php require_once __DIR__ . '/footer.php'; ?>
