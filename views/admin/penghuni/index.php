<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Manajemen Penghuni | KosManager</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script src="<?= base_url('/public/assets/js/admin-theme.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('/public/assets/css/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('/public/assets/css/admin.css') ?>">
</head>
<body class="bg-background font-body-md text-on-surface antialiased">
<?php $activeAdminPage = 'data-penghuni'; include __DIR__ . '/../layout/sidebar.php'; ?>
<div class="pl-72">
<?php include __DIR__ . '/../layout/admin-header.php'; ?>
<main class="relative pt-16 bg-background w-full px-gutter-md py-gutter-md">
<div class="max-w-7xl mx-auto space-y-space-lg">
<header class="flex flex-wrap items-end justify-between gap-space-md">
<div><h1 class="font-headline-lg text-on-surface">Manajemen Penghuni</h1><p class="text-body-md text-on-surface-variant">Penempatan dan penghapusan penghuni memperbarui status kamar secara otomatis.</p></div>
<a class="px-space-md py-space-sm rounded-lg bg-secondary text-on-secondary font-label-md" href="<?= base_url('/penghuni/tambah') ?>">Check-in penghuni</a>
</header>
<?php $flash = get_flash(); if ($flash !== null): ?>
<div class="p-space-md rounded-xl flex items-center gap-space-sm <?= $flash['type'] === 'error' ? 'bg-error-container text-on-error-container' : 'bg-tertiary-fixed text-on-tertiary-fixed' ?>" role="alert">
    <span class="material-symbols-outlined text-[20px]"><?= $flash['type'] === 'error' ? 'error' : 'check_circle' ?></span>
    <span class="font-label-md"><?= $escape($flash['message']) ?></span>
</div>
<?php endif; ?>
<?php if (!empty($formError)): ?><p class="p-space-md rounded-lg bg-error-container text-on-error-container" role="alert"><?= $escape($formError) ?></p><?php endif; ?>
<section class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
<div class="overflow-x-auto"><table class="w-full text-left">
<thead class="bg-surface-container-low text-on-surface-variant"><tr>
<th class="p-space-md font-label-sm">Nama / NIK</th><th class="p-space-md font-label-sm">Kontak</th><th class="p-space-md font-label-sm">Kos / Kamar</th><th class="p-space-md font-label-sm">Aksi</th>
</tr></thead>
<tbody class="divide-y divide-surface-container">
<?php foreach ($residentList as $resident): ?>
<tr>
<td class="p-space-md"><strong class="block"><?= $escape($resident['nama']) ?></strong><span class="text-body-sm text-on-surface-variant">NIK: <?= $escape($resident['nik']) ?></span></td>
<td class="p-space-md"><a class="text-secondary hover:underline" href="tel:<?= $escape(preg_replace('/[^0-9+]/', '', (string) $resident['no_hp'])) ?>"><?= $escape($resident['no_hp']) ?></a></td>
<td class="p-space-md"><?= $escape($resident['nama_kos'] ?? '-') ?> / <?= $escape($resident['nomor_kamar'] ?? '-') ?></td>
<td class="p-space-md"><div class="flex items-center gap-space-xs">
<a class="px-space-sm py-1 rounded bg-surface-container text-secondary" href="<?= base_url('/penghuni/ubah?id=' . (int) $resident['id']) ?>">Ubah</a>
<form action="<?= base_url('/penghuni/hapus') ?>" method="post" onsubmit="return confirm('Akhiri masa sewa dan hapus penghuni ini?')">
<input type="hidden" name="csrf_token" value="<?= $escape(csrf_token()) ?>">
<input type="hidden" name="id" value="<?= (int) $resident['id'] ?>">
<button class="px-space-sm py-1 rounded bg-error-container text-on-error-container" type="submit">Checkout</button>
</form>
</div></td>
</tr>
<?php endforeach; ?>
<?php if ($residentList === []): ?><tr><td class="p-space-lg text-center text-on-surface-variant" colspan="4">Belum ada penghuni aktif.</td></tr><?php endif; ?>
</tbody>
</table></div>
</section>
</div>
<?php include __DIR__ . '/form.php'; ?>
</main>
</div>
<script src="<?= base_url('/public/assets/js/admin.js') ?>"></script>
</body>
</html>
