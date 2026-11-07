<?php
$placeholderImages = [
    'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1598928506311-c55ded91a20c?auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1540518614846-7ede433c4574?auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=800&q=80',
];
$kosId = (int) ($property['id'] ?? 1);
$imageUrl = !empty($property['gambar']) ? (string) $property['gambar'] : $placeholderImages[abs($kosId - 1) % count($placeholderImages)];
?>
<article class="flex flex-col rounded-xl bg-surface-container-lowest shadow-sm hover:shadow-md transition-shadow overflow-hidden group">
<div class="relative w-full aspect-[16/10] overflow-hidden bg-surface-container flex items-center justify-center">
<img alt="<?= $escape($property['nama_kos'] ?? 'Foto Kos') ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" src="<?= $escape($imageUrl) ?>">
<span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-surface-container-lowest/95 text-on-tertiary-container font-label-sm shadow-sm">
<?= (int) ($property['kamar_kosong'] ?? 0) ?> kamar tersedia
</span>
</div>
<div class="p-space-lg flex flex-col flex-1 justify-between gap-space-md">
<div class="flex flex-col gap-space-xs">
<h3 class="font-headline-md text-on-surface font-bold"><?= $escape($property['nama_kos'] ?? '') ?></h3>
<p class="font-body-sm text-on-surface-variant flex items-start gap-1">
<span class="material-symbols-outlined text-[16px] text-outline shrink-0" aria-hidden="true">location_on</span>
<span><?= $escape($property['lokasi'] ?? '') ?> · <?= $escape($property['alamat'] ?? '') ?></span>
</p>
<?php if (!empty($property['deskripsi'])): ?>
<p class="font-body-sm text-on-surface-variant"><?= $escape($property['deskripsi']) ?></p>
<?php endif; ?>
<?php $facilities = array_filter(array_map('trim', preg_split('/[,;\\n]+/', (string) ($property['fasilitas'] ?? '')) ?: [])); ?>
<?php if ($facilities !== []): ?>
<div class="flex flex-wrap gap-1.5 mt-space-sm">
<?php foreach (array_slice($facilities, 0, 4) as $facility): ?>
<span class="px-2 py-1 rounded bg-surface-container-low text-on-surface-variant font-meta-numeric"><?= $escape($facility) ?></span>
<?php endforeach; ?>
</div>
<?php endif; ?>
</div>
<div class="pt-space-md flex items-center justify-between gap-space-sm">
<div class="flex flex-col">
<span class="font-label-sm text-on-surface-variant uppercase tracking-wider">Mulai dari</span>
<span class="font-price-display text-secondary">
<?= $property['harga_mulai'] === null ? 'Belum ada kamar' : 'Rp ' . $escape(number_format((float) $property['harga_mulai'], 0, ',', '.')) ?>
</span>
</div>
<a class="px-space-md py-2 rounded-lg bg-surface-container text-on-surface font-headline-sm hover:bg-secondary hover:text-on-secondary transition-all"
href="<?= base_url('/kos/detail?id=' . (int) $property['id']) ?>">Lihat Detail</a>
</div>
</div>
</article>
