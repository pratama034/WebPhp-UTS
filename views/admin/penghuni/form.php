<?php if ($openForm): ?>
<section class="fixed inset-0 z-50 overflow-y-auto bg-primary-container/50 flex items-center justify-center p-space-md" aria-label="Form penghuni">
<div class="w-full max-w-xl rounded-xl bg-surface-container-lowest p-space-lg shadow-xl">
<div class="flex items-start justify-between gap-space-sm">
<div><h2 class="font-headline-md text-on-surface"><?= !empty($formData['id']) ? 'Ubah Data Penghuni' : 'Check-In Penghuni' ?></h2><p class="text-body-sm text-on-surface-variant">Satu kamar hanya dapat ditempati satu penghuni.</p></div>
<a class="text-on-surface-variant hover:text-on-surface" href="<?= base_url('/penghuni') ?>" aria-label="Tutup">Tutup</a>
</div>
<?php if (!empty($formError)): ?><p class="mt-space-md p-space-sm rounded-lg bg-error-container text-on-error-container" role="alert"><?= $escape($formError) ?></p><?php endif; ?>
<?php $editingResident = !empty($formData['id']); ?>
<form class="mt-space-md flex flex-col gap-space-md" action="<?= base_url($editingResident ? '/penghuni/update' : '/penghuni') ?>" method="post">
<input type="hidden" name="csrf_token" value="<?= $escape(csrf_token()) ?>">
<?php if ($editingResident): ?><input type="hidden" name="id" value="<?= (int) $formData['id'] ?>"><?php endif; ?>
<label class="flex flex-col gap-1"><span class="font-label-md">Nama lengkap</span><input class="p-space-sm rounded-lg bg-surface-container-low text-on-surface" name="nama" maxlength="100" required value="<?= $escape($formData['nama']) ?>"></label>
<label class="flex flex-col gap-1"><span class="font-label-md">NIK (16 digit)</span><input class="p-space-sm rounded-lg bg-surface-container-low text-on-surface" name="nik" inputmode="numeric" pattern="[0-9]{16}" maxlength="16" required value="<?= $escape($formData['nik']) ?>"></label>
<label class="flex flex-col gap-1"><span class="font-label-md">Nomor telepon / WhatsApp</span><input class="p-space-sm rounded-lg bg-surface-container-low text-on-surface" name="no_hp" type="tel" maxlength="20" required value="<?= $escape($formData['no_hp']) ?>"></label>
<label class="flex flex-col gap-1"><span class="font-label-md">Kamar</span>
<select class="p-space-sm rounded-lg bg-surface-container-low text-on-surface" name="kamar_id">
<option value="">Tanpa penempatan kamar</option>
<?php if ($editingResident && $formData['kamar_id'] !== null && !array_filter($availableRooms, static fn (array $room): bool => (int) $room['id'] === (int) $formData['kamar_id'])): ?>
<option value="<?= (int) $formData['kamar_id'] ?>" selected>Kamar saat ini (ID <?= (int) $formData['kamar_id'] ?>)</option>
<?php endif; ?>
<?php foreach ($availableRooms as $room): ?>
<option value="<?= (int) $room['id'] ?>" <?= (string) $formData['kamar_id'] === (string) $room['id'] ? 'selected' : '' ?>><?= $escape($room['nama_kos']) ?> — <?= $escape($room['nomor_kamar']) ?> (<?= $escape($room['tipe']) ?>)</option>
<?php endforeach; ?>
</select></label>
<div class="flex gap-space-sm"><button class="px-space-md py-space-sm rounded-lg bg-secondary text-on-secondary font-label-md" type="submit">Simpan</button><a class="px-space-md py-space-sm rounded-lg bg-surface-container text-on-surface" href="<?= base_url('/penghuni') ?>">Batal</a></div>
</form>
</div>
</section>
<?php endif; ?>
