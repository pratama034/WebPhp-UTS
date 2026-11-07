<?php

declare(strict_types=1);

namespace KosManager\Models;

final class Kos
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $namaKos,
        public readonly string $alamat,
        public readonly string $lokasi,
        public readonly ?string $deskripsi = null,
        public readonly ?string $fasilitas = null,
        public readonly ?string $noHpPengelola = null,
        public readonly string $statusPublikasi = 'draft'
    ) {
    }

    /**
     * @param array<string, mixed> $row
     */
    public static function fromRow(array $row): self
    {
        return new self(
            (int) $row['id'],
            (string) $row['nama_kos'],
            (string) $row['alamat'],
            (string) $row['lokasi'],
            isset($row['deskripsi']) ? (string) $row['deskripsi'] : null,
            isset($row['fasilitas']) ? (string) $row['fasilitas'] : null,
            isset($row['no_hp_pengelola']) ? (string) $row['no_hp_pengelola'] : null,
            (string) $row['status_publikasi']
        );
    }
}
