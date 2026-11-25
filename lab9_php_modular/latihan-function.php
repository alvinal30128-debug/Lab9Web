<?php
$judul = 'Latihan Function';
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/header.php';
?>
<section class="content">
    <h2>Latihan Function</h2>

    <h3>1. Konversi Celcius ke Fahrenheit</h3>
    <div class="hasil">37 &deg;C = <?php echo konversiCelciusKeFahrenheit(37); ?> &deg;F</div>

    <h3>2. Status Nilai</h3>
    <?php foreach ([92, 76, 58, 45, 20] as $n): ?>
        <div class="hasil">Nilai <?php echo $n; ?> &rarr; <?php echo e(tentukanStatusNilai($n)); ?></div>
    <?php endforeach; ?>

    <h3>3. Total Belanja</h3>
    <?php $total = hitungTotal(15000, 4); ?>
    <div class="hasil">Harga <?php echo formatRupiah(15000); ?> &times; 4 = <?php echo formatRupiah($total); ?></div>

    <h3>4. Diskon (parameter default)</h3>
    <div class="hasil">Diskon 10% dari <?php echo formatRupiah(200000); ?> = <?php echo formatRupiah(hitungDiskon(200000)); ?></div>
    <div class="hasil">Diskon 15% dari <?php echo formatRupiah(200000); ?> = <?php echo formatRupiah(hitungDiskon(200000, 15)); ?></div>

    <h3>5. Escaping dengan e()</h3>
    <div class="hasil"><?php echo e('<script>alert("uji")</script>'); ?></div>
</section>
<?php require_once __DIR__ . '/footer.php'; ?>
