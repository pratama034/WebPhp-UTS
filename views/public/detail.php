<!DOCTYPE html>

<html lang="id"><head><meta charset="utf-8"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/><meta content="web_standard" name="shell-type"/>
<title><?= $escape($kos['nama_kos']) ?> | KosManager</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin=""/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com"></script>
<script src="<?= base_url('/public/assets/js/app.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('/public/assets/css/style.css') ?>"/>
<link rel="stylesheet" href="<?= base_url('/public/assets/css/public.css') ?>"/>
</head><body class="bg-background font-body-md text-on-surface antialiased selection:bg-secondary-fixed selection:text-on-secondary-fixed"><header class="fixed top-0 left-0 right-0 z-50 bg-surface-container-lowest shadow-[0_1px_8px_rgba(0,0,0,0.04)]"><div class="h-16 max-w-[1200px] mx-auto px-margin md:px-margin-md flex items-center justify-between gap-space-md"><div class="flex items-center gap-space-md"><a class="flex items-center gap-space-sm group focus:outline-none"  data-path="beranda" href="<?= base_url('/') ?>"><img alt="KosManager" class="w-9 h-9 rounded-lg object-contain shrink-0 shadow-sm" src="<?= base_url('/public/assets/images/logo.svg') ?>"/><div class="flex flex-col"><span class="font-headline-md text-headline-md tracking-tight text-on-surface leading-none group-hover:text-secondary transition-colors">KosManager</span><span class="font-label-sm text-label-sm text-on-surface-variant leading-none mt-space-xs hidden sm:inline">Hunian Mahasiswa</span></div></a></div><nav class="hidden md:flex items-center gap-space-xs p-space-xs rounded-lg bg-surface-container-low" data-active-classes="bg-surface-container text-secondary font-headline-sm"><a class="px-space-md py-space-xs rounded font-body-md text-body-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-lowest transition-all" data-path="beranda" href="<?= base_url('/') ?>">Beranda</a><a aria-current="page" class="px-space-md py-space-xs rounded transition-all bg-surface-container text-secondary font-headline-sm" data-path="cari-kos" href="<?= base_url('/kos') ?>">Cari Kos</a><a class="px-space-md py-space-xs rounded font-body-md text-body-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-lowest transition-all" data-path="panduan-mahasiswa" href="<?= base_url('/#panduan') ?>">Panduan Mahasiswa</a></nav><div class="flex items-center gap-space-sm"><a class="flex items-center gap-space-xs px-space-md py-space-xs rounded-lg bg-surface-container-lowest text-on-surface hover:bg-surface-container hover:text-secondary shadow-[0_1px_3px_rgba(15,23,42,0.05)] transition-all" data-path="area-pengelola" href="<?= base_url('/admin/dashboard') ?>"><span class="material-symbols-outlined text-[18px] text-on-surface-variant">lock</span><span class="font-label-md text-label-md hidden sm:inline">Area Pengelola</span></a><div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center"><span class="material-symbols-outlined text-on-primary text-[18px]">person</span></div></div></div></header><main class="w-full pt-16 bg-surface min-h-[calc(100vh-16rem)]"><div class="flex flex-col w-full">
<?php
$contactRoom = $selectedRoom;
if ($contactRoom === null) {
    foreach ($rooms as $room) {
        if (($room['status'] ?? '') === 'kosong') { $contactRoom = $room; break; }
    }
}
$locationQuery = rawurlencode((string) ($kos['alamat'] ?? $kos['lokasi'] ?? ''));
?>
<div class="w-full max-w-[1200px] mx-auto px-margin md:px-margin-md py-space-lg flex flex-col gap-space-lg">
<nav class="flex items-center gap-space-xs font-body-sm text-on-surface-variant"><a class="hover:text-secondary" href="<?= base_url('/') ?>">Beranda</a><span>/</span><a class="hover:text-secondary" href="<?= base_url('/kos') ?>">Cari Kos</a><span>/</span><span class="text-on-surface"><?= $escape($kos['nama_kos']) ?></span></nav>
<section class="flex flex-col md:flex-row md:items-start justify-between gap-space-md">
<div class="flex flex-col gap-space-sm"><div class="flex flex-wrap gap-space-xs"><span class="px-space-sm py-1 rounded-full bg-surface-container text-on-tertiary-container font-label-sm"><?= (int) ($kos['kamar_kosong'] ?? 0) ?> kamar tersedia</span><span class="px-space-sm py-1 rounded-full bg-surface-container-high text-secondary font-label-sm">Terdaftar di KosManager</span></div>
<h1 class="font-headline-lg text-on-surface"><?= $escape($kos['nama_kos']) ?></h1>
<p class="text-body-md text-on-surface-variant"><span class="material-symbols-outlined text-secondary align-middle">location_on</span> <?= $escape($kos['alamat']) ?><?= $kos['lokasi'] !== '' ? ' &middot; ' . $escape($kos['lokasi']) : '' ?></p>
</div><a class="inline-flex items-center gap-space-xs px-space-md py-space-sm rounded-lg bg-surface-container text-secondary font-label-md" href="https://maps.google.com/?q=<?= $locationQuery ?>" target="_blank" rel="noopener noreferrer"><span class="material-symbols-outlined">map</span>Buka Peta</a>
</section>
<section class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg items-start">
<div class="lg:col-span-8 flex flex-col gap-space-lg">
<?php
$placeholderImages = [
    'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1200&q=80',
    'https://images.unsplash.com/photo-1598928506311-c55ded91a20c?auto=format&fit=crop&w=1200&q=80',
    'https://images.unsplash.com/photo-1540518614846-7ede433c4574?auto=format&fit=crop&w=1200&q=80',
    'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1200&q=80',
];
$kosId = (int) ($kos['id'] ?? 1);
$detailImageUrl = !empty($kos['gambar']) ? (string) $kos['gambar'] : $placeholderImages[abs($kosId - 1) % count($placeholderImages)];
?>
<div class="h-64 sm:h-80 rounded-xl bg-surface-container-low overflow-hidden shadow-sm"><img alt="<?= $escape($kos['nama_kos']) ?>" class="w-full h-full object-cover" src="<?= $escape($detailImageUrl) ?>"></div>
<article class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm"><h2 class="font-headline-md text-on-surface mb-space-sm">Tentang Kos</h2><p class="text-body-md text-on-surface-variant whitespace-pre-line"><?= $escape($kos['deskripsi'] ?? 'Informasi kos belum tersedia.') ?></p>
<?php if (!empty($kos['fasilitas'])): ?><div class="mt-space-md"><h3 class="font-headline-sm text-on-surface mb-space-xs">Fasilitas</h3><p class="text-body-sm text-on-surface-variant"><?= $escape($kos['fasilitas']) ?></p></div><?php endif; ?>
</article>
<section class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm"><div class="flex items-center justify-between gap-space-sm mb-space-md"><div><h2 class="font-headline-md text-on-surface">Daftar Kamar</h2><p class="text-body-sm text-on-surface-variant"><?= count($rooms) ?> kamar terdaftar</p></div></div>
<?php if ($rooms === []): ?><p class="p-space-md rounded-lg bg-surface-container-low text-on-surface-variant">Belum ada informasi kamar.</p><?php else: ?>
<div class="grid grid-cols-1 md:grid-cols-2 gap-space-sm">
<?php foreach ($rooms as $room): $vacant = ($room['status'] ?? '') === 'kosong'; ?>
<article class="p-space-md rounded-lg bg-surface-container-low <?= $selectedRoom !== null && (int) $selectedRoom['kamar_id'] === (int) $room['id'] ? 'ring-2 ring-secondary' : '' ?>">
<div class="flex items-start justify-between gap-space-sm"><div><h3 class="font-headline-sm text-on-surface">Kamar <?= $escape($room['nomor_kamar']) ?></h3><p class="text-body-sm text-on-surface-variant"><?= $escape($room['tipe']) ?></p></div><span class="px-2 py-1 rounded-full font-label-sm <?= $vacant ? 'bg-tertiary-fixed text-on-tertiary-fixed' : 'bg-surface-container-high text-on-surface-variant' ?>"><?= $vacant ? 'Kosong' : 'Terisi' ?></span></div>
<p class="font-price-display text-secondary mt-space-md">Rp <?= $escape(number_format((float) $room['harga_bulanan'], 0, ',', '.')) ?><span class="font-body-sm text-on-surface-variant"> / bulan</span></p>
<?php if ($vacant): ?><a class="inline-flex mt-space-sm px-space-md py-2 rounded-lg bg-secondary text-on-secondary font-label-md" href="<?= base_url('/kamar/detail?id=' . (int) $room['id'] . '#hubungi') ?>">Tanya kamar ini</a><?php endif; ?>
</article>
<?php endforeach; ?>
</div><?php endif; ?>
</section>
</div>
<aside id="hubungi" class="lg:col-span-4 bg-surface-container-lowest p-space-lg rounded-xl shadow-sm h-fit"><h2 class="font-headline-md text-on-surface">Kontak Pengelola</h2><p class="mt-space-sm text-body-sm text-on-surface-variant">Hubungi pengelola untuk menanyakan ketersediaan atau menjadwalkan survei.</p>
<?php if ($contactRoom !== null && ($contactRoom['status'] ?? $contactRoom['status_kamar'] ?? '') === 'kosong'): ?><button class="mt-space-md w-full py-space-sm px-space-md rounded-lg bg-secondary text-on-secondary font-headline-sm" id="openSurveyModalBtn" type="button">Hubungi / Janji Survei</button><?php else: ?><p class="mt-space-md p-space-sm rounded-lg bg-surface-container-low text-on-surface-variant">Tidak ada kamar kosong saat ini.</p><?php endif; ?>
<?php if (!empty($kos['no_hp_pengelola'])): ?><a class="mt-space-sm block text-center text-secondary hover:underline" href="tel:<?= $escape(preg_replace('/[^0-9+]/', '', (string) $kos['no_hp_pengelola'])) ?>"><?= $escape($kos['no_hp_pengelola']) ?></a><?php endif; ?>
</aside>
</section>
</div>
</main><footer class="w-full bg-surface-container-lowest shadow-[0_-1px_8px_rgba(0,0,0,0.02)] mt-margin-lg"><div class="max-w-[1200px] mx-auto px-margin md:px-margin-md py-space-xl"><div class="grid grid-cols-1 md:grid-cols-4 gap-gutter-lg mb-space-xl"><div class="md:col-span-2 flex flex-col gap-space-sm"><a class="flex items-center gap-space-sm w-fit group focus:outline-none" href="<?= base_url('/') ?>"><img alt="KosManager" class="w-8 h-8 rounded-lg object-contain shrink-0 shadow-sm" src="<?= base_url('/public/assets/images/logo.svg') ?>"/><span class="font-headline-md text-headline-md text-on-surface font-bold group-hover:text-secondary transition-colors">KosManager</span></a><p class="font-body-md text-body-md text-on-surface-variant max-w-md">Platform pencarian kos jujur dan transparan untuk mahasiswa perantau. Menyajikan informasi biaya riil, aturan hunian, jarak ke gerbang kampus, dan ketersediaan kamar secara berkala.</p><div class="flex items-center gap-space-xs text-on-tertiary-container font-label-md text-label-md mt-space-xs"><span class="material-symbols-outlined text-[16px]">verified</span><span>Terverifikasi Tim Survei Kampus</span></div></div><div class="flex flex-col gap-space-sm"><span class="font-headline-sm text-headline-sm text-on-surface">Area Sekitar Kampus</span><ul class="flex flex-col gap-space-xs font-body-sm text-body-sm text-on-surface-variant"><li><a class="hover:text-secondary transition-colors" href="<?= base_url('/kos?q=UB') ?>">Universitas Brawijaya (UB)</a></li><li><a class="hover:text-secondary transition-colors" href="<?= base_url('/kos?q=UM') ?>">Universitas Negeri Malang (UM)</a></li><li><a class="hover:text-secondary transition-colors" href="<?= base_url('/kos?q=UIN') ?>">UIN Maulana Malik Ibrahim</a></li><li><a class="hover:text-secondary transition-colors" href="<?= base_url('/kos?q=Polinema') ?>">Politeknik Negeri Malang (Polinema)</a></li><li><a class="hover:text-secondary transition-colors" href="<?= base_url('/kos?q=Lowokwaru') ?>">Universitas Muhammadiyah Malang</a></li></ul></div><div class="flex flex-col gap-space-sm"><span class="font-headline-sm text-headline-sm text-on-surface">Bantuan &amp; Kontak</span><div class="flex flex-col gap-space-xs font-body-sm text-body-sm text-on-surface-variant"><span>Helpdesk Mahasiswa</span><span class="font-meta-numeric text-meta-numeric text-on-surface font-semibold">+62 812-3456-7890</span><span>Malang, Jawa Timur, Indonesia</span><div class="mt-space-xs"><a class="text-secondary hover:underline font-label-md text-label-md" data-path="area-pengelola" href="<?= base_url('/admin/dashboard') ?>">Daftarkan Kos Anda →</a></div></div></div></div><div class="pt-space-lg flex flex-col sm:flex-row items-center justify-between gap-space-sm"><p class="font-meta-numeric text-meta-numeric text-on-surface-variant">© 2025 KosManager. Dikembangkan untuk mahasiswa perantau Indonesia.</p><div class="flex items-center gap-space-md font-meta-numeric text-meta-numeric text-on-surface-variant"><a class="hover:text-on-surface transition-colors" href="#">Privasi</a><a class="hover:text-on-surface transition-colors" href="#">Syarat Ketentuan</a><a class="hover:text-on-surface transition-colors" href="#">Standar Kelayakan</a></div></div></div></footer><?php include __DIR__ . '/contact.php'; ?>
<script src="<?= base_url('/public/assets/js/search.js') ?>"></script>
</body></html>