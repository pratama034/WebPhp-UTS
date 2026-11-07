<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $isEdit ? 'Ubah' : 'Tambah' ?> Properti Kos | KosManager</title>
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
<section class="max-w-3xl mx-auto bg-surface-container-lowest p-space-lg rounded-xl shadow-sm">
<a class="text-secondary hover:underline inline-flex items-center gap-1 font-label-md" href="<?= base_url('/admin/kos') ?>">
    <span class="material-symbols-outlined text-[16px]">arrow_back</span>
    <span>Kembali ke daftar properti kos</span>
</a>
<h1 class="mt-space-md font-headline-lg text-on-surface"><?= $isEdit ? 'Ubah Data Properti Kos' : 'Tambah Properti Kos Baru' ?></h1>
<p class="text-body-sm text-on-surface-variant mt-1">Lengkapi data properti agar pencari kos mendapatkan informasi akurat dan jelas.</p>

<?php if (!empty($formError)): ?>
    <p class="mt-space-md p-space-md rounded-lg bg-error-container text-on-error-container" role="alert"><?= $escape($formError) ?></p>
<?php endif; ?>

<form class="mt-space-lg flex flex-col gap-space-md" action="<?= base_url($isEdit ? '/admin/kos/update' : '/admin/kos') ?>" method="post">
<input type="hidden" name="csrf_token" value="<?= $escape(csrf_token()) ?>">
<?php if ($isEdit): ?>
    <input type="hidden" name="id" value="<?= (int) $kos->id ?>">
<?php endif; ?>

<label class="flex flex-col gap-1">
    <span class="font-label-md text-on-surface">Nama Properti Kos <span class="text-error">*</span></span>
    <input class="p-space-sm rounded-lg bg-surface-container-low text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary" name="nama_kos" required maxlength="150" placeholder="Contoh: Kos Putri Melati Asri" value="<?= $escape($formData['nama_kos']) ?>">
</label>

<div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
    <label class="flex flex-col gap-1">
        <span class="font-label-md text-on-surface">Lokasi / Area Sekitar Kampus <span class="text-error">*</span></span>
        <input class="p-space-sm rounded-lg bg-surface-container-low text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary" name="lokasi" required maxlength="150" placeholder="Contoh: Dekat Kampus UB & ITN" value="<?= $escape($formData['lokasi']) ?>">
    </label>
    <label class="flex flex-col gap-1">
        <span class="font-label-md text-on-surface">No. HP / WhatsApp Pengelola</span>
        <input class="p-space-sm rounded-lg bg-surface-container-low text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary" name="no_hp_pengelola" maxlength="20" placeholder="Contoh: 081234567890" value="<?= $escape($formData['no_hp_pengelola']) ?>">
    </label>
</div>

<label class="flex flex-col gap-1">
    <span class="font-label-md text-on-surface">Alamat Lengkap <span class="text-error">*</span></span>
    <textarea class="p-space-sm rounded-lg bg-surface-container-low text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary resize-y" name="alamat" rows="2" required placeholder="Jl. Nama Jalan No. XX, Kelurahan, Kecamatan, Kota Malang"><?= $escape($formData['alamat']) ?></textarea>
</label>

<label class="flex flex-col gap-1">
    <span class="font-label-md text-on-surface">Deskripsi Properti</span>
    <textarea class="p-space-sm rounded-lg bg-surface-container-low text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary resize-y" name="deskripsi" rows="3" placeholder="Jelaskan lingkungan kos, aturan umum, kenyamanan, atau keunggulan kos..."><?= $escape($formData['deskripsi']) ?></textarea>
</label>

<label class="flex flex-col gap-1">
    <span class="font-label-md text-on-surface">Fasilitas Properti</span>
    <textarea class="p-space-sm rounded-lg bg-surface-container-low text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary resize-y" name="fasilitas" rows="2" placeholder="Contoh: Wi-Fi Cepat, Dapur Bersama, Kulkas, CCTV 24 Jam, Parkir Motor Aman"><?= $escape($formData['fasilitas']) ?></textarea>
</label>

<label class="flex flex-col gap-1">
    <span class="font-label-md text-on-surface">Status Publikasi <span class="text-error">*</span></span>
    <select class="p-space-sm rounded-lg bg-surface-container-low text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary" name="status_publikasi" required>
        <option value="draft" <?= $formData['status_publikasi'] === 'draft' ? 'selected' : '' ?>>Draft (Hanya terlihat di admin)</option>
        <option value="published" <?= $formData['status_publikasi'] === 'published' ? 'selected' : '' ?>>Published (Ditampilkan di katalog publik mahasiswa)</option>
    </select>
</label>

<div class="flex items-center gap-space-sm pt-space-sm">
    <button class="px-space-md py-space-sm rounded-lg bg-secondary text-on-secondary font-label-md hover:opacity-90 transition-opacity" type="submit">
        <?= $isEdit ? 'Simpan Perubahan' : 'Tambah Properti' ?>
    </button>
    <a class="px-space-md py-space-sm rounded-lg bg-surface-container text-on-surface font-label-md hover:bg-surface-container-high transition-colors" href="<?= base_url('/admin/kos') ?>">
        Batal
    </a>
</div>
</form>
</section>
</main>
</div>
</body>
</html>

