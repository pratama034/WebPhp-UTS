<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Profil & Informasi Properti Kos | KosManager</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script src="<?= base_url('/public/assets/js/admin-theme.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('/public/assets/css/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('/public/assets/css/admin.css') ?>">
</head>
<body class="bg-background font-body-md text-on-surface antialiased">
<?php $activeAdminPage = 'profil-informasi-properti'; include __DIR__ . '/../layout/sidebar.php'; ?>
<div class="pl-72">
<?php include __DIR__ . '/../layout/admin-header.php'; ?>
<main class="relative pt-16 bg-background w-full px-gutter-md py-gutter-md">
<div class="max-w-7xl mx-auto space-y-space-lg">
<header class="flex flex-wrap items-end justify-between gap-space-md">
<div>
    <h1 class="font-headline-lg text-on-surface">Profil & Informasi Properti Kos</h1>
    <p class="text-body-md text-on-surface-variant">Kelola daftar properti kos, alamat, fasilitas, kontak pengelola, dan status publikasi.</p>
</div>
<a class="px-space-md py-space-sm rounded-lg bg-secondary text-on-secondary font-label-md inline-flex items-center gap-space-xs shadow-sm hover:opacity-90 transition-opacity" href="<?= base_url('/admin/kos/tambah') ?>">
    <span class="material-symbols-outlined text-[18px]">add_business</span>
    <span>Tambah Properti Kos</span>
</a>
</header>

<?php $flash = get_flash(); if ($flash !== null): ?>
    <div class="p-space-md rounded-xl flex items-center gap-space-sm <?= $flash['type'] === 'error' ? 'bg-error-container text-on-error-container' : 'bg-tertiary-fixed text-on-tertiary-fixed' ?>" role="alert">
        <span class="material-symbols-outlined text-[20px]"><?= $flash['type'] === 'error' ? 'error' : 'check_circle' ?></span>
        <span class="font-label-md"><?= $escape($flash['message']) ?></span>
    </div>
<?php endif; ?>

<?php if (!empty($formError)): ?>
    <p class="p-space-md rounded-lg bg-error-container text-on-error-container" role="alert"><?= $escape($formError) ?></p>
<?php endif; ?>

<section class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
<div class="overflow-x-auto">
<table class="w-full text-left">
<thead class="bg-surface-container-low text-on-surface-variant">
<tr>
    <th class="p-space-md font-label-sm">Nama Properti</th>
    <th class="p-space-md font-label-sm">Lokasi & Alamat</th>
    <th class="p-space-md font-label-sm">Kontak Pengelola</th>
    <th class="p-space-md font-label-sm">Fasilitas Utama</th>
    <th class="p-space-md font-label-sm">Status</th>
    <th class="p-space-md font-label-sm">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-container">
<?php foreach ($kosList as $kos): ?>
<tr>
    <td class="p-space-md">
        <div class="font-headline-sm text-on-surface"><?= $escape($kos->namaKos) ?></div>
        <div class="text-meta-numeric text-on-surface-variant text-xs">ID #<?= (int) $kos->id ?></div>
    </td>
    <td class="p-space-md max-w-xs">
        <div class="font-semibold text-on-surface text-sm"><?= $escape($kos->lokasi) ?></div>
        <div class="text-body-sm text-on-surface-variant truncate" title="<?= $escape($kos->alamat) ?>"><?= $escape($kos->alamat) ?></div>
    </td>
    <td class="p-space-md">
        <?php if (!empty($kos->noHpPengelola)): ?>
            <a class="text-secondary hover:underline inline-flex items-center gap-1 font-meta-numeric text-sm" href="https://wa.me/<?= $escape(preg_replace('/[^0-9]/', '', $kos->noHpPengelola)) ?>" target="_blank" rel="noopener noreferrer">
                <span class="material-symbols-outlined text-[16px]">chat</span>
                <span><?= $escape($kos->noHpPengelola) ?></span>
            </a>
        <?php else: ?>
            <span class="text-on-surface-variant text-sm">-</span>
        <?php endif; ?>
    </td>
    <td class="p-space-md max-w-xs">
        <div class="text-body-sm text-on-surface-variant truncate" title="<?= $escape($kos->fasilitas ?? 'Tidak ada') ?>">
            <?= $escape($kos->fasilitas ?? 'Belum ada fasilitas dicatat') ?>
        </div>
    </td>
    <td class="p-space-md">
        <?php if ($kos->statusPublikasi === 'published'): ?>
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full font-label-sm bg-tertiary-fixed text-on-tertiary-fixed text-xs font-semibold">
                <span class="w-1.5 h-1.5 rounded-full bg-on-tertiary-container"></span>
                <span>Published</span>
            </span>
        <?php else: ?>
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full font-label-sm bg-surface-container-high text-on-surface-variant text-xs font-medium">
                <span class="w-1.5 h-1.5 rounded-full bg-on-surface-variant"></span>
                <span>Draft</span>
            </span>
        <?php endif; ?>
    </td>
    <td class="p-space-md">
        <div class="flex items-center gap-space-xs">
            <a class="px-space-sm py-1 rounded bg-surface-container text-secondary text-sm font-label-md hover:bg-surface-container-high transition-colors" href="<?= base_url('/admin/kos/ubah?id=' . (int) $kos->id) ?>">
                Ubah
            </a>
            <?php if ($kos->statusPublikasi === 'published'): ?>
                <a class="px-space-sm py-1 rounded bg-surface-container-low text-on-surface-variant text-sm hover:text-on-surface transition-colors" href="<?= base_url('/kos/detail?id=' . (int) $kos->id) ?>" target="_blank" title="Lihat tampilan publik">
                    <span class="material-symbols-outlined text-[16px] align-middle">visibility</span>
                </a>
            <?php endif; ?>
            <form action="<?= base_url('/admin/kos/hapus') ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus properti <?= $escape($kos->namaKos) ?>? Semua kamar terkait harus sudah dihapus terlebih dahulu.')">
                <input type="hidden" name="csrf_token" value="<?= $escape(csrf_token()) ?>">
                <input type="hidden" name="id" value="<?= (int) $kos->id ?>">
                <button class="px-space-sm py-1 rounded bg-error-container text-on-error-container text-sm font-label-md hover:opacity-90 transition-opacity" type="submit">
                    Hapus
                </button>
            </form>
        </div>
    </td>
</tr>
<?php endforeach; ?>
<?php if ($kosList === []): ?>
<tr>
    <td class="p-space-lg text-center text-on-surface-variant" colspan="6">
        <div class="flex flex-col items-center justify-center py-6 gap-2">
            <span class="material-symbols-outlined text-4xl text-on-surface-variant">home_work</span>
            <p>Belum ada data properti kos yang terdaftar.</p>
            <a class="text-secondary hover:underline text-sm font-medium" href="<?= base_url('/admin/kos/tambah') ?>">+ Tambah properti pertama</a>
        </div>
    </td>
</tr>
<?php endif; ?>
</tbody>
</table>
</div>
</section>
</div>
</main>
</div>
</body>
</html>

