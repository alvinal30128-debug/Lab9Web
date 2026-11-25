<?php
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    setFlash('gagal', 'ID pengguna tidak valid.');
    redirect('user/list');
}

$stmt = $pdo->prepare('SELECT id, nama, email, alamat FROM users WHERE id = ?');
$stmt->execute([$id]);
$user = $stmt->fetch();
if (!$user) {
    setFlash('gagal', 'Pengguna tidak ditemukan.');
    redirect('user/list');
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrfValid()) {
        http_response_code(403);
        exit('Token CSRF tidak valid.');
    }

    $user['nama']   = trim((string) ($_POST['nama'] ?? ''));
    $user['email']  = trim((string) ($_POST['email'] ?? ''));
    $user['alamat'] = trim((string) ($_POST['alamat'] ?? ''));

    if ($user['nama'] === '') {
        $errors[] = 'Nama wajib diisi.';
    }
    if (!validasiEmail($user['email'])) {
        $errors[] = 'Format email tidak valid.';
    } else {
        $cek = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ? AND id <> ?');
        $cek->execute([$user['email'], $id]);
        if ($cek->fetchColumn() > 0) {
            $errors[] = 'Email sudah dipakai pengguna lain.';
        }
    }

    if (!$errors) {
        $upd = $pdo->prepare('UPDATE users SET nama = ?, email = ?, alamat = ? WHERE id = ?');
        $upd->execute([$user['nama'], $user['email'], $user['alamat'], $id]);
        setFlash('sukses', 'Data pengguna berhasil diperbarui.');
        redirect('user/list');
    }
}
?>
<section>
    <h2>Edit Pengguna</h2>
    <?php foreach ($errors as $err): ?>
        <div class="alert alert-gagal"><?php echo e($err); ?></div>
    <?php endforeach; ?>

    <form method="post" action="<?php echo e(url('user/edit', ['id' => $id])); ?>" class="form">
        <?php echo csrfField(); ?>
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?php echo e($user['nama']); ?>" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo e($user['email']); ?>" required>

        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" rows="3"><?php echo e($user['alamat']); ?></textarea>

        <button type="submit" class="btn">Perbarui</button>
        <a href="<?php echo e(url('user/list')); ?>">Batal</a>
    </form>
</section>
