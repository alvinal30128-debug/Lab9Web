<?php
// Penghapusan hanya lewat POST + token CSRF, bukan lewat URL GET
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    setFlash('gagal', 'Penghapusan harus dilakukan melalui tombol Hapus.');
    redirect('user/list');
}
if (!csrfValid()) {
    http_response_code(403);
    exit('Token CSRF tidak valid.');
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    setFlash('gagal', 'ID pengguna tidak valid.');
    redirect('user/list');
}

$stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
$stmt->execute([$id]);

if ($stmt->rowCount() > 0) {
    setFlash('sukses', 'Pengguna berhasil dihapus.');
} else {
    setFlash('gagal', 'Pengguna tidak ditemukan.');
}
redirect('user/list');
