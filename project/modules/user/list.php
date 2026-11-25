<?php
$users = $pdo->query('SELECT id, nama, email, alamat, created_at FROM users ORDER BY id ASC')->fetchAll();
?>
<section>
    <h2>Data Pengguna</h2>
    <p><a class="btn" href="<?php echo e(url('user/add')); ?>">+ Tambah Pengguna</a></p>

    <table class="tabel">
        <thead>
            <tr><th>No</th><th>Nama</th><th>Email</th><th>Alamat</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        <?php foreach ($users as $i => $u): ?>
            <tr>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo e($u['nama']); ?></td>
                <td><?php echo e($u['email']); ?></td>
                <td><?php echo e(ringkasTeks($u['alamat'], 40)); ?></td>
                <td class="aksi">
                    <a class="btn btn-kecil" href="<?php echo e(url('user/edit', ['id' => $u['id']])); ?>">Edit</a>
                    <form method="post" action="<?php echo e(url('user/delete')); ?>"
                          onsubmit="return confirm('Hapus pengguna ini?');">
                        <?php echo csrfField(); ?>
                        <input type="hidden" name="id" value="<?php echo (int) $u['id']; ?>">
                        <button type="submit" class="btn btn-kecil btn-bahaya">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (!$users): ?>
            <tr><td colspan="5">Belum ada data pengguna.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</section>
