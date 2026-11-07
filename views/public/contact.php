<?php
$contactRoom = $contactRoom ?? null;
$contactPhone = preg_replace('/[^0-9]/', '', (string) ($kos['no_hp_pengelola'] ?? ''));
if (str_starts_with($contactPhone, '0')) {
    $contactPhone = '62' . substr($contactPhone, 1);
} elseif ($contactPhone !== '' && !str_starts_with($contactPhone, '62')) {
    $contactPhone = '62' . $contactPhone;
}
?>
<div class="fixed inset-0 z-50 overflow-y-auto bg-primary-container/70 backdrop-blur-sm items-center justify-center p-3 sm:p-6" style="display:none" hidden aria-hidden="true" role="dialog" aria-modal="true" id="surveyModalWrapper"
 data-kos-name="<?= $escape($kos['nama_kos'] ?? '') ?>" data-owner-name="Pengelola" data-phone="<?= $escape($contactPhone) ?>"
 data-room-name="<?= $escape($contactRoom['tipe'] ?? '') ?>" data-room-code="<?= $escape($contactRoom['nomor_kamar'] ?? '') ?>" data-room-price="<?= $escape(number_format((float) ($contactRoom['harga_bulanan'] ?? 0), 0, ',', '.')) ?>">
<div class="relative w-full max-w-2xl bg-surface-container-lowest rounded-xl shadow-2xl overflow-hidden my-auto">
<header class="bg-surface-container-low px-space-lg py-space-md flex items-center justify-between gap-space-md"><div><h2 class="font-headline-md text-on-surface">Hubungi Pengelola &amp; Janji Survei</h2><p class="font-body-sm text-on-surface-variant">Pesan akan dikirim melalui WhatsApp.</p></div><button aria-label="Tutup" class="p-2 rounded-lg hover:bg-surface-container" id="closeModalBtn" type="button"><span class="material-symbols-outlined">close</span></button></header>
<div class="p-space-lg space-y-space-md">
<label class="block font-label-sm text-on-surface-variant" for="studentName">Nama Anda<input class="mt-1 w-full p-space-sm rounded-lg bg-surface-container-low text-on-surface" id="studentName" type="text" placeholder="Nama lengkap"></label>
<label class="block font-label-sm text-on-surface-variant" for="studentOrigin">Asal kampus / kota<input class="mt-1 w-full p-space-sm rounded-lg bg-surface-container-low text-on-surface" id="studentOrigin" type="text" placeholder="Opsional"></label>
<label class="block font-label-sm text-on-surface-variant" for="moveInDate">Rencana masuk<input class="mt-1 w-full p-space-sm rounded-lg bg-surface-container-low text-on-surface" id="moveInDate" type="date"></label>
<label class="flex items-center gap-space-sm text-body-sm text-on-surface"><input checked class="accent-secondary" id="surveyCheckbox" type="checkbox"> Saya ingin menjadwalkan survei</label>
<label class="block font-label-sm text-on-surface-variant" for="surveySlot">Waktu yang diusulkan<select class="mt-1 w-full p-space-sm rounded-lg bg-surface-container-low text-on-surface" id="surveySlot"><option value="Tanya ketersediaan dulu via chat">Tanyakan ketersediaan terlebih dahulu</option><option value="pagi">Pagi</option><option value="siang">Siang</option><option value="sore">Sore</option></select></label>
<div class="p-space-md rounded-lg bg-surface-container-low"><h3 class="font-label-md text-on-surface mb-1">Pratinjau pesan</h3><p class="text-body-sm text-on-surface-variant" id="waMessagePreview"></p></div>
<div class="flex flex-wrap justify-end gap-space-sm"><button class="px-space-md py-2 rounded-lg bg-surface-container text-on-surface" id="cancelModalBtn" type="button">Batal</button><button class="px-space-md py-2 rounded-lg bg-surface-container-high text-secondary" id="copyMessageBtn" type="button"><span id="copyBtnText">Salin Pesan</span></button><a class="px-space-md py-2 rounded-lg bg-secondary text-on-secondary" id="waSendLink" href="#" target="_blank" rel="noopener noreferrer">Lanjut ke WhatsApp</a></div>
</div></div></div>
