<?php
$featuredKos = $featuredKos ?? [];
$escape = $escape ?? static fn (mixed $value): string => htmlspecialchars((string) ($value ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
?>
<!DOCTYPE html>

<html lang="id"><head><meta charset="utf-8"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/><meta content="web_standard" name="shell-type"/>
<title>KosManager - Portal Hunian &amp; Pencarian Kos Mahasiswa</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin=""/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com"></script>
<script src="<?= base_url('/public/assets/js/app.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('/public/assets/css/style.css') ?>"/>
<link rel="stylesheet" href="<?= base_url('/public/assets/css/public.css') ?>"/>
</head><body class="bg-background font-body-md text-on-surface antialiased selection:bg-secondary-fixed selection:text-on-secondary-fixed"><header class="fixed top-0 left-0 right-0 z-50 bg-surface-container-lowest shadow-[0_1px_8px_rgba(0,0,0,0.04)]"><div class="h-16 max-w-[1200px] mx-auto px-margin md:px-margin-md flex items-center justify-between gap-space-md"><div class="flex items-center gap-space-md"><a class="flex items-center gap-space-sm group focus:outline-none"  data-path="beranda" href="<?= base_url('/') ?>"><img alt="KosManager" class="w-9 h-9 rounded-lg object-contain shrink-0 shadow-sm" src="<?= base_url('/public/assets/images/logo.svg') ?>"/><div class="flex flex-col"><span class="font-headline-md text-headline-md tracking-tight text-on-surface leading-none group-hover:text-secondary transition-colors">KosManager</span><span class="font-label-sm text-label-sm text-on-surface-variant leading-none mt-space-xs hidden sm:inline">Hunian Mahasiswa</span></div></a></div><nav class="hidden md:flex items-center gap-space-xs p-space-xs rounded-lg bg-surface-container-low" data-active-classes="bg-surface-container text-secondary font-headline-sm"><a aria-current="page" class="px-space-md py-space-xs rounded transition-all bg-surface-container text-secondary font-headline-sm"  data-path="beranda" href="<?= base_url('/') ?>">Beranda</a><a class="px-space-md py-space-xs rounded font-body-md text-body-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-lowest transition-all" data-path="cari-kos" href="<?= base_url('/kos') ?>">Cari Kos</a><a class="px-space-md py-space-xs rounded font-body-md text-body-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-lowest transition-all" data-path="panduan-mahasiswa" href="<?= base_url('/#panduan') ?>">Panduan Mahasiswa</a></nav><div class="flex items-center gap-space-sm"><a class="flex items-center gap-space-xs px-space-md py-space-xs rounded-lg bg-surface-container-lowest text-on-surface hover:bg-surface-container hover:text-secondary shadow-[0_1px_3px_rgba(15,23,42,0.05)] transition-all" data-path="area-pengelola" href="<?= base_url('/admin/dashboard') ?>"><span class="material-symbols-outlined text-[18px] text-on-surface-variant">lock</span><span class="font-label-md text-label-md hidden sm:inline">Area Pengelola</span></a><div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center"><span class="material-symbols-outlined text-on-primary text-[18px]">person</span></div></div></div></header><main class="w-full pt-16 bg-surface min-h-[calc(100vh-16rem)]"><div class="flex flex-col w-full">
<!-- Top Utility Banner / Trust Signal -->
<section class="w-full bg-surface-container-low px-margin md:px-margin-md py-space-sm">
<div class="max-w-[1200px] mx-auto flex flex-wrap items-center justify-between gap-space-sm">
<div class="flex items-center gap-space-sm text-on-surface-variant font-meta-numeric text-meta-numeric">
<span class="inline-flex items-center justify-center w-2 h-2 rounded-full bg-on-tertiary-container animate-pulse"></span>
<span class="font-semibold text-on-surface">Data Lapangan Terverifikasi</span>
<span class="opacity-40">•</span>
<span>Pembaruan berkala bersama paguyuban kos Malang</span>
</div>
<div class="flex items-center gap-space-md font-meta-numeric text-meta-numeric text-on-surface-variant">
<span class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-[15px] text-on-tertiary-container">check_circle</span>
          Bebas Biaya Perantara
        </span>
<span class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-[15px] text-secondary">verified_user</span>
          Nomor WA Terverifikasi
        </span>
</div>
</div>
</section>
<!-- Hero Section -->
<section class="w-full px-margin md:px-margin-md pt-space-xl pb-margin-lg bg-surface">
<div class="max-w-[1200px] mx-auto flex flex-col gap-space-xl">
<!-- Asymmetric Editorial Header Block -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg items-end">
<div class="lg:col-span-8 flex flex-col gap-space-md">
<div class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container text-secondary font-label-sm text-label-sm w-fit">
<span class="material-symbols-outlined text-[14px]">school</span>
<span>PORTAL HUNIAN MAHASISWA MALANG</span>
</div>
<h1 class="font-display-hero text-display-hero text-on-surface tracking-tight max-w-3xl">
            Temukan Kos yang Tepat untuk Perjalanan Kuliahmu.
          </h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">
            Jelajahi berbagai pilihan kos berdasarkan lokasi kampus, harga terjangkau, dan ketersediaan kamar kosong terverifikasi langsung dari pengelola lapangan.
          </p>
</div>
<!-- Quick Live Counter Tile -->
<div class="lg:col-span-4 flex flex-col justify-end">
<div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-space-xs">
<div class="flex items-center justify-between">
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Kondisi Saat Ini</span>
<span class="px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-meta-numeric text-meta-numeric">Live 24 Jam</span>
</div>
<div class="flex items-baseline gap-space-xs mt-space-xs">
<span class="font-display-hero text-display-hero text-secondary leading-none"><?= (int) $availableRoomCount ?></span>
<span class="font-headline-sm text-headline-sm text-on-surface font-bold">Kamar Kosong</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant">
              Jumlah kamar kosong pada kos yang dipublikasikan.
            </p>
</div>
</div>
</div>
<!-- Integrated Multi-Filter Search Card -->
<div class="w-full p-space-lg rounded-xl bg-surface-container-lowest shadow-md">
<form class="grid grid-cols-1 md:grid-cols-12 gap-gutter-md items-end" action="<?= base_url('/kos') ?>" method="get">
<!-- Input Location/Name -->
<div class="md:col-span-4 flex flex-col gap-space-xs">
<label class="font-label-md text-label-md text-on-surface flex items-center gap-space-xs" for="search-keyword">
<span class="material-symbols-outlined text-[16px] text-secondary">search</span>
              Nama Kos atau Sekitar Kampus
            </label>
<div class="relative flex items-center">
<input class="w-full h-12 pl-space-md pr-space-xl rounded-lg bg-surface-container-low text-on-surface font-body-md text-body-md placeholder:text-on-surface-variant/60 focus:bg-surface-container-lowest focus:outline-none focus:ring-2 focus:ring-secondary transition-all" id="search-keyword" name="q" placeholder="Cari nama kos atau jalan sekitar kampus..." type="text"/>
<span class="absolute right-3 material-symbols-outlined text-on-surface-variant text-[20px] pointer-events-none">my_location</span>
</div>
</div>
<!-- Dropdown Price Range -->
<div class="md:col-span-3 flex flex-col gap-space-xs">
<label class="font-label-md text-label-md text-on-surface flex items-center gap-space-xs" for="price-range">
<span class="material-symbols-outlined text-[16px] text-secondary">payments</span>
              Rentang Anggaran
            </label>
<div class="relative flex items-center">
<select class="w-full h-12 px-space-md rounded-lg bg-surface-container-low text-on-surface font-body-md text-body-md appearance-none focus:bg-surface-container-lowest focus:outline-none focus:ring-2 focus:ring-secondary transition-all cursor-pointer" id="price-range" name="max_price">
<option value="">Semua Anggaran (Semua Kelas)</option>
<option value="600000">Hingga Rp 600.000 / bln</option>
<option value="1000000">Hingga Rp 1.000.000 / bln</option>
<option value="1600000">Hingga Rp 1.600.000 / bln</option>
</select>
<span class="absolute right-3 material-symbols-outlined text-on-surface-variant text-[20px] pointer-events-none">expand_more</span>
</div>
</div>
<!-- Dropdown Availability -->
<div class="md:col-span-3 flex flex-col gap-space-xs">
<label class="font-label-md text-label-md text-on-surface flex items-center gap-space-xs" for="availability-status">
<span class="material-symbols-outlined text-[16px] text-on-tertiary-container">bed</span>
              Status Ketersediaan
            </label>
<div class="relative flex items-center">
<select class="w-full h-12 px-space-md rounded-lg bg-surface-container-low text-on-surface font-body-md text-body-md appearance-none focus:bg-surface-container-lowest focus:outline-none focus:ring-2 focus:ring-secondary transition-all cursor-pointer" id="availability-status" name="availability">
<option value="vacant-only">Hanya Kamar Kosong</option>
<option selected="" value="all">Semua Status (Termasuk Penuh)</option>
</select>
<span class="absolute right-3 material-symbols-outlined text-on-surface-variant text-[20px] pointer-events-none">expand_more</span>
</div>
</div>
<!-- Search Button -->
<div class="md:col-span-2 flex flex-col justify-end">
<button class="w-full h-12 rounded-lg bg-secondary text-on-secondary font-headline-sm text-headline-sm flex items-center justify-center gap-space-xs hover:bg-on-secondary-fixed-variant active:scale-[0.98] transition-all shadow-sm" type="submit">
<span class="material-symbols-outlined text-[20px]">search</span>
<span>Cari Kos</span>
</button>
</div>
</form>
<!-- Quick filter tag recommendations -->
<div class="mt-space-md pt-space-md flex flex-wrap items-center gap-space-xs text-on-surface-variant font-body-sm text-body-sm bg-surface-container-lowest">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface">Paling dicari:</span>
<a class="px-space-sm py-1 rounded bg-surface-container-low hover:bg-surface-container hover:text-secondary text-on-surface font-meta-numeric text-meta-numeric transition-colors" href="<?= base_url('/kos?q=UB') ?>">Dekat Gerbang UB Suhat</a>
<a class="px-space-sm py-1 rounded bg-surface-container-low hover:bg-surface-container hover:text-secondary text-on-surface font-meta-numeric text-meta-numeric transition-colors" href="<?= base_url('/kos?q=Putri') ?>">Putri KM Dalam</a>
<a class="px-space-sm py-1 rounded bg-surface-container-low hover:bg-surface-container hover:text-secondary text-on-surface font-meta-numeric text-meta-numeric transition-colors" href="<?= base_url('/kos?max_price=800000') ?>">&lt; 800rb Termasuk Listrik</a>
<a class="px-space-sm py-1 rounded bg-surface-container-low hover:bg-surface-container hover:text-secondary text-on-surface font-meta-numeric text-meta-numeric transition-colors" href="<?= base_url('/kos?q=Polinema') ?>">Jalan Kaki ke Polinema</a>
</div>
</div>
<!-- Trust Mini Stats Banner -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter-md">
<div class="flex items-center gap-space-md p-space-md rounded-xl bg-surface-container-lowest shadow-sm">
<div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-secondary text-[26px]">update</span>
</div>
<div class="flex flex-col min-w-0">
<span class="font-headline-sm text-headline-sm text-on-surface leading-tight"><?= (int) $availableRoomCount ?> Kamar Kosong</span>
<span class="font-body-sm text-body-sm text-on-surface-variant truncate">Sinkronisasi status real-time hari ini</span>
</div>
</div>
<div class="flex items-center gap-space-md p-space-md rounded-xl bg-surface-container-lowest shadow-sm">
<div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-on-tertiary-container text-[26px]">money_off</span>
</div>
<div class="flex flex-col min-w-0">
<span class="font-headline-sm text-headline-sm text-on-surface leading-tight">Tanpa Biaya Layanan</span>
<span class="font-body-sm text-body-sm text-on-surface-variant truncate">100% gratis untuk mahasiswa perantau</span>
</div>
</div>
<div class="flex items-center gap-space-md p-space-md rounded-xl bg-surface-container-lowest shadow-sm">
<div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-secondary text-[26px]">forum</span>
</div>
<div class="flex flex-col min-w-0">
<span class="font-headline-sm text-headline-sm text-on-surface leading-tight">Kontak Langsung Pemilik</span>
<span class="font-body-sm text-body-sm text-on-surface-variant truncate">Hubungi via WA langsung tanpa calo</span>
</div>
</div>
</div>
</div>
</section>
<!-- Popular Recommended Section -->
<section class="w-full px-margin md:px-margin-md py-margin-lg bg-surface-container-low" id="rekomendasi">
<div class="max-w-[1200px] mx-auto flex flex-col gap-space-xl">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md">
<div class="flex flex-col gap-space-xs max-w-2xl">
<div class="flex items-center gap-space-xs text-secondary font-label-md"><span class="material-symbols-outlined text-[16px]">stars</span><span>REKOMENDASI KOS PILIHAN</span></div>
<h2 class="font-headline-lg text-on-surface tracking-tight">Kos Pilihan untuk Mahasiswa</h2>
<p class="font-body-md text-on-surface-variant">Jelajahi kos terverifikasi yang memiliki kamar tersedia.</p>
</div>
<a class="inline-flex items-center gap-space-xs text-secondary hover:text-on-secondary-fixed-variant font-headline-sm group" href="<?= base_url('/kos') ?>"><span>Lihat Semua Kos</span><span class="material-symbols-outlined text-[18px]">arrow_forward</span></a>
</div>
<?php if ($featuredKos === []): ?>
<div class="rounded-xl bg-surface-container-lowest p-space-xl text-center text-on-surface-variant">Belum ada kos yang dapat ditampilkan.</div>
<?php else: ?>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter-lg">
<?php foreach ($featuredKos as $property): ?>
<?php require __DIR__ . '/kos-card.php'; ?>
<?php endforeach; ?>
</div>
<?php endif; ?>
</div>
</section>
<!-- Section Keunggulan KosManager untuk Mahasiswa -->
<section class="w-full px-margin md:px-margin-md py-margin-lg bg-surface">
<div class="max-w-[1200px] mx-auto flex flex-col gap-space-xl">
<!-- Section Intro -->
<div class="flex flex-col items-center text-center gap-space-xs max-w-2xl mx-auto">
<span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest font-bold">
          PRINSIP DASAR KOSMANAGER
        </span>
<h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">
          Dibangun Khusus Menjawab Keresahan Anak Rantau
        </h2>
<p class="font-body-md text-body-md text-on-surface-variant">
          Tanpa gimik, tanpa mark-up harga sewa kamar, dan tanpa prosedur rumit yang membuang waktu studimu.
        </p>
</div>
<!-- 3 Pilar Human-Crafted Bento Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter-lg">
<!-- Pilar 1: Transparansi Status Kamar Real-time -->
<div class="p-space-xl rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between gap-space-lg group hover:shadow-md transition-shadow">
<div class="flex flex-col gap-space-md">
<div class="flex items-center justify-between">
<div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-secondary">
<span class="material-symbols-outlined text-[26px]">fact_check</span>
</div>
<span class="font-meta-numeric text-meta-numeric text-on-surface-variant font-bold">01 / PILAR</span>
</div>
<div class="flex flex-col gap-space-xs">
<h3 class="font-headline-md text-headline-md text-on-surface font-bold">
                Transparansi Status Kamar Real-time
              </h3>
<p class="font-body-md text-body-md text-on-surface-variant">
                Data ketersediaan kamar disinkronkan langsung dari buku register pengelola kos. Anda tidak akan lagi kecewa mendatangi kosan yang ternyata sudah penuh berbulan-bulan lalu.
              </p>
</div>
</div>
<!-- Supporting Spec Detail -->
<div class="p-space-md rounded-lg bg-surface-container-low flex items-center gap-space-sm text-on-surface-variant font-meta-numeric text-meta-numeric">
<span class="material-symbols-outlined text-on-tertiary-container text-[18px]">verified</span>
<span>Verifikasi fisik &amp; digital berkala oleh tim relawan kampus</span>
</div>
</div>
<!-- Pilar 2: Langsung Hubungi Pengelola -->
<div class="p-space-xl rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between gap-space-lg group hover:shadow-md transition-shadow">
<div class="flex flex-col gap-space-md">
<div class="flex items-center justify-between">
<div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-on-tertiary-container">
<span class="material-symbols-outlined text-[26px]">mark_chat_unread</span>
</div>
<span class="font-meta-numeric text-meta-numeric text-on-surface-variant font-bold">02 / PILAR</span>
</div>
<div class="flex flex-col gap-space-xs">
<h3 class="font-headline-md text-headline-md text-on-surface font-bold">
                Langsung Hubungi Pengelola
              </h3>
<p class="font-body-md text-body-md text-on-surface-variant">
                Nomor WhatsApp dan telepon pemilik kos disajikan terbuka dan valid. Anda bisa langsung membuat janji temu survei, negosiasi periode sewa, atau bertanya aturan tanpa calo perantara.
              </p>
</div>
</div>
<!-- Supporting Spec Detail -->
<div class="p-space-md rounded-lg bg-surface-container-low flex items-center gap-space-sm text-on-surface-variant font-meta-numeric text-meta-numeric">
<span class="material-symbols-outlined text-secondary text-[18px]">support_agent</span>
<span>Tautan WhatsApp langsung ke bapak/ibu kos setempat</span>
</div>
</div>
<!-- Pilar 3: Bebas Ribet -->
<div class="p-space-xl rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between gap-space-lg group hover:shadow-md transition-shadow">
<div class="flex flex-col gap-space-md">
<div class="flex items-center justify-between">
<div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-secondary">
<span class="material-symbols-outlined text-[26px]">lock_open</span>
</div>
<span class="font-meta-numeric text-meta-numeric text-on-surface-variant font-bold">03 / PILAR</span>
</div>
<div class="flex flex-col gap-space-xs">
<h3 class="font-headline-md text-headline-md text-on-surface font-bold">
                Bebas Ribet Tanpa Login
              </h3>
<p class="font-body-md text-body-md text-on-surface-variant">
                Tidak perlu membuat akun, mengunggah data identitas pribadi berulang kali, atau mengunduh aplikasi tambahan. Cari informasi kamar dan dapatkan kontak kos secara langsung dan aman.
              </p>
</div>
</div>
<!-- Supporting Spec Detail -->
<div class="p-space-md rounded-lg bg-surface-container-low flex items-center gap-space-sm text-on-surface-variant font-meta-numeric text-meta-numeric">
<span class="material-symbols-outlined text-on-surface text-[18px]">bolt</span>
<span>Akses instan dari peramban ponsel mahasiswa</span>
</div>
</div>
</div>
</div>
</section>
<!-- Visual Context Callout (Malang Area Map Preview & Student Guide Snippet) -->
<section class="w-full px-margin md:px-margin-md py-space-xl bg-surface scroll-mt-20" id="panduan">
<div class="max-w-[1200px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg items-center p-space-xl rounded-2xl bg-surface-container">
<div class="lg:col-span-7 flex flex-col gap-space-md">
<div class="flex items-center gap-space-xs text-secondary font-label-md text-label-md">
<span class="material-symbols-outlined text-[18px]">verified</span>
<span>PANDUAN SURVEI KOS BAGI MAHASISWA BARU</span>
</div>
<h3 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">
          "Berapa rata-rata harga kos di sekitar kampus saat ini?"
        </h3>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
          Berdasarkan catatan indeks hunian KosManager, rata-rata kamar mandi luar berkisar Rp 550rb - 850rb/bulan, sementara fasilitas kamar mandi dalam + kasur berkisar Rp 850rb - 1,4jt/bulan. Pastikan selalu mengecek aturan jam malam dan ketersediaan wifi sebelum sepakat membayar deposit.
        </p>
<div class="flex flex-wrap gap-space-md pt-space-xs">
<div class="flex items-center gap-space-xs text-on-surface font-meta-numeric text-meta-numeric">
<span class="material-symbols-outlined text-on-tertiary-container text-[18px]">check</span>
<span>Cek sirkulasi udara &amp; jendela kamar</span>
</div>
<div class="flex items-center gap-space-xs text-on-surface font-meta-numeric text-meta-numeric">
<span class="material-symbols-outlined text-on-tertiary-container text-[18px]">check</span>
<span>Pastikan tagihan air &amp; listrik jelas</span>
</div>
</div>
</div>
<div class="lg:col-span-5 flex flex-col gap-space-sm">
<div class="w-full h-56 rounded-xl bg-cover bg-center shadow-sm relative overflow-hidden" data-location="Universitas Brawijaya Malang" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDTeEetxNF3kmXXdqxyFPSjWgqhvFF2dNL_TAILBfLzPK1UmYtX98jYePhtPQRO1Yj807Bz6SDEXv_OgD_KJ3QPeyomCEdo3Yc_Co3IjRGKGwoQRkySuH2blspnGijThFPNjB7S23apiw_HKa9OSt9A0uOzAyTTiwNYF0MBLevE0aDa7ZpVlWH_9Xn9QQbEc2bvuEKosoWo4CF_DubRD4jqkzKfxCmmihwSRW1CiBA')">
<div class="absolute inset-0 bg-primary/20 backdrop-blur-[0.5px] flex items-end p-space-md">
<div class="bg-surface-container-lowest/90 px-3 py-1.5 rounded-lg shadow-sm flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-[16px]">pin_drop</span>
<span class="font-label-sm text-label-sm text-on-surface">Pusat Klaster: Lowokwaru &amp; Sukun</span>
</div>
</div>
</div>
<p class="font-meta-numeric text-meta-numeric text-on-surface-variant text-center">
          *Peta penunjuk radius aman jalan kaki mahasiswa ke gerbang fakultas.
        </p>
</div>
</div>
</section>
<!-- CTA Banner Bawah Bersahaja -->
<section class="w-full px-margin md:px-margin-md py-margin-lg bg-surface">
<div class="max-w-[1200px] mx-auto">
<div class="p-space-xl md:p-margin-md rounded-2xl bg-surface-container-lowest shadow-sm flex flex-col md:flex-row items-center justify-between gap-space-xl">
<div class="flex flex-col gap-space-sm max-w-xl text-center md:text-left">
<div class="inline-flex items-center justify-center md:justify-start gap-space-xs text-secondary font-label-md text-label-md">
<span class="material-symbols-outlined text-[18px]">home</span>
<span>KATALOG LENGKAP KOS AKTIF</span>
</div>
<h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">
            Belum Menemukan yang Pas dengan Jadwal Kuliahmu?
          </h2>
<p class="font-body-md text-body-md text-on-surface-variant">
            Lihat daftar lengkap seluruh kos terverifikasi di sekeliling Malang. Bandingkan fasilitas, aturan pulang malam, hingga kapasitas parkir dalam satu layar.
          </p>
</div>
<div class="flex flex-col sm:flex-row items-center gap-space-md shrink-0 w-full sm:w-auto">
<a class="w-full sm:w-auto h-12 px-space-xl rounded-lg bg-secondary text-on-secondary font-headline-sm text-headline-sm flex items-center justify-center gap-space-xs hover:bg-on-secondary-fixed-variant active:scale-[0.98] transition-all shadow-sm"  data-path="cari-kos" href="<?= base_url('/kos') ?>">
<span>Jelajahi Semua Kos</span>
<span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</a>
<a class="w-full sm:w-auto h-12 px-space-lg rounded-lg bg-surface-container-low text-on-surface font-headline-sm text-headline-sm flex items-center justify-center gap-space-xs hover:bg-surface-container transition-all" data-path="panduan-mahasiswa" href="<?= base_url('/#panduan') ?>">
<span class="material-symbols-outlined text-[18px]">menu_book</span>
<span>Panduan Survei</span>
</a>
</div>
</div>
</div>
</section>
</div></main><footer class="w-full bg-surface-container-lowest shadow-[0_-1px_8px_rgba(0,0,0,0.02)] mt-margin-lg"><div class="max-w-[1200px] mx-auto px-margin md:px-margin-md py-space-xl"><div class="grid grid-cols-1 md:grid-cols-4 gap-gutter-lg mb-space-xl"><div class="md:col-span-2 flex flex-col gap-space-sm"><a class="flex items-center gap-space-sm w-fit group focus:outline-none" href="<?= base_url('/') ?>"><img alt="KosManager" class="w-8 h-8 rounded-lg object-contain shrink-0 shadow-sm" src="<?= base_url('/public/assets/images/logo.svg') ?>"/><span class="font-headline-md text-headline-md text-on-surface font-bold group-hover:text-secondary transition-colors">KosManager</span></a><p class="font-body-md text-body-md text-on-surface-variant max-w-md">Platform pencarian kos jujur dan transparan untuk mahasiswa perantau. Menyajikan informasi biaya riil, aturan hunian, jarak ke gerbang kampus, dan ketersediaan kamar secara berkala.</p><div class="flex items-center gap-space-xs text-on-tertiary-container font-label-md text-label-md mt-space-xs"><span class="material-symbols-outlined text-[16px]">verified</span><span>Terverifikasi Tim Survei Kampus</span></div></div><div class="flex flex-col gap-space-sm"><span class="font-headline-sm text-headline-sm text-on-surface">Area Sekitar Kampus</span><ul class="flex flex-col gap-space-xs font-body-sm text-body-sm text-on-surface-variant"><li><a class="hover:text-secondary transition-colors" href="<?= base_url('/kos?q=UB') ?>">Universitas Brawijaya (UB)</a></li><li><a class="hover:text-secondary transition-colors" href="<?= base_url('/kos?q=UM') ?>">Universitas Negeri Malang (UM)</a></li><li><a class="hover:text-secondary transition-colors" href="<?= base_url('/kos?q=UIN') ?>">UIN Maulana Malik Ibrahim</a></li><li><a class="hover:text-secondary transition-colors" href="<?= base_url('/kos?q=Polinema') ?>">Politeknik Negeri Malang (Polinema)</a></li><li><a class="hover:text-secondary transition-colors" href="<?= base_url('/kos?q=Lowokwaru') ?>">Universitas Muhammadiyah Malang</a></li></ul></div><div class="flex flex-col gap-space-sm"><span class="font-headline-sm text-headline-sm text-on-surface">Bantuan &amp; Kontak</span><div class="flex flex-col gap-space-xs font-body-sm text-body-sm text-on-surface-variant"><span>Helpdesk Mahasiswa</span><span class="font-meta-numeric text-meta-numeric text-on-surface font-semibold">+62 812-3456-7890</span><span>Malang, Jawa Timur, Indonesia</span><div class="mt-space-xs"><a class="text-secondary hover:underline font-label-md text-label-md" data-path="area-pengelola" href="<?= base_url('/admin/dashboard') ?>">Daftarkan Kos Anda →</a></div></div></div></div><div class="pt-space-lg flex flex-col sm:flex-row items-center justify-between gap-space-sm"><p class="font-meta-numeric text-meta-numeric text-on-surface-variant">© 2025 KosManager. Dikembangkan untuk mahasiswa perantau Indonesia.</p><div class="flex items-center gap-space-md font-meta-numeric text-meta-numeric text-on-surface-variant"><a class="hover:text-on-surface transition-colors" href="#">Privasi</a><a class="hover:text-on-surface transition-colors" href="#">Syarat Ketentuan</a><a class="hover:text-on-surface transition-colors" href="#">Standar Kelayakan</a></div></div></div></footer><script src="<?= base_url('/public/assets/js/search.js') ?>"></script>
</body></html>