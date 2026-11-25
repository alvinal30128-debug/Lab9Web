<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi PHP Modular - Data Pengguna</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
<div class="container">
    <header>
        <h1>Aplikasi PHP Modular</h1>
        <p>CRUD pengguna dengan template bersama dan router</p>
    </header>
    <nav>
        <a href="<?php echo e(url('dashboard')); ?>" class="<?php echo $page === 'dashboard' ? 'active' : ''; ?>">Dashboard</a>
        <a href="<?php echo e(url('user/list')); ?>" class="<?php echo isMenuAktif($page, 'user/'); ?>">Data Pengguna</a>
        <a href="<?php echo e(url('about')); ?>" class="<?php echo $page === 'about' ? 'active' : ''; ?>">Tentang</a>
    </nav>
    <main>
        <?php echo tampilFlash(); ?>
