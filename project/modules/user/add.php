<?php
$errors = [];
$data   = ['nama' => '', 'email' => '', 'alamat' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrfValid()) {
        http_response_code(403);
        exit('Token CSRF tidak valid.');
    }

    $data['nama']   = trim((string) ($_POST['nama'] ?? ''));
    $data['email']  = trim((string) ($_POST['email'] ?? ''));
    $data['alamat'] = trim((string) ($_POST['alamat'] ?? ''));

    if ($data['nama'] === '') {
        $errors[] = 'Nama wajib diisi.';
    }
    if (!validasiEmail($data['email'])) {
        $errors[] = 'Format email tidak valid.';
    } else {
        $cek = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
        $cek->execute([$data['email']]);
        if ($cek->fetchColumn() > 0) {
            $errors[] = 'Email sudah terdaftar.';
        }
    }

    if (!$errors) {
        $stmt = $pdo->prepare('INSERT INTO users (nama, email, alamat) VALUES (?, ?, ?)');
        $stmt->execute([$data['nama'], $data['email'], $data['alamat']]);
        setFlash('sukses', 'Pengguna berhasil ditambahkan.');
        redirect('user/list');
    }
}
?>
<section>
    <h2>Tambah Pengguna</h2>
    <?php foreach ($errors as $err): ?>
        <div class="alert alert-gagal"><?php echo e($err); ?></div>
    <?php endforeach; ?>

    <form method="post" action="<?php echo e(url('user/add')); ?>" class="form">
        <?php echo csrfField(); ?>
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?php echo e($data['nama']); ?>" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo e($data['email']); ?>" required>

        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" rows="3"><?php echo e($data['alamat']); ?></textarea>

        <button type="submit" class="btn">Simpan</button>
        <a href="<?php echo e(url('user/list')); ?>">Batal</a>
    </form>
</section>
