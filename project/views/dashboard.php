<?php
$total   = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$terbaru = $pdo->query('SELECT nama, email, alamat FROM users ORDER BY id DESC LIMIT 3')->fetchAll();
?>
<section>
    <h2>Dashboard</h2>
    <div class="kartu">
        <span>Total Pengguna</span>
        <strong><?php echo $total; ?></strong>
    </div>

    <h3>Pengguna Terbaru</h3>
    <table class="tabel">
        <thead><tr><th>Nama</th><th>Email</th><th>Alamat (ringkas)</th></tr></thead>
        <tbody>
        <?php foreach ($terbaru as $u): ?>
            <tr>
                <td><?php echo e($u['nama']); ?></td>
                <td><?php echo e($u['email']); ?></td>
                <td><?php echo e(ringkasTeks($u['alamat'], 30)); ?></td>
            </tr>
        <?php endforeach; ?>
        <?php if (!$terbaru): ?>
            <tr><td colspan="3">Belum ada data.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    <p><a class="btn" href="<?php echo e(url('user/list')); ?>">Kelola Pengguna</a></p>
</section>
