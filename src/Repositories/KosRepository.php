<?php

declare(strict_types=1);

namespace KosManager\Repositories;

use InvalidArgumentException;
use KosManager\Models\Kos;
use PDO;

final class KosRepository
{
    public function __construct(private readonly PDO $connection)
    {
    }

    /**
     * @return list<Kos>
     */
    public function findAll(): array
    {
        $statement = $this->connection->query(
            'SELECT id, nama_kos, alamat, lokasi, deskripsi, fasilitas, no_hp_pengelola, status_publikasi
             FROM kos
             ORDER BY id DESC'
        );

        return array_map(
            static fn (array $row): Kos => Kos::fromRow($row),
            $statement->fetchAll()
        );
    }

    public function findById(int $id): ?Kos
    {
        $this->assertValidId($id);
        $statement = $this->connection->prepare(
            'SELECT id, nama_kos, alamat, lokasi, deskripsi, fasilitas, no_hp_pengelola, status_publikasi
             FROM kos
             WHERE id = :id'
        );
        $statement->execute(['id' => $id]);
        $row = $statement->fetch();

        return $row === false ? null : Kos::fromRow($row);
    }

    /**
     * @param array{keyword?: string, min_price?: float|null, max_price?: float|null, available?: bool} $filters
     * @return list<array<string, mixed>>
     */
    public function searchPublished(array $filters = []): array
    {
        $where = ["kos.status_publikasi = 'published'"];
        $parameters = [];
        $keyword = trim($filters['keyword'] ?? '');

        if ($keyword !== '') {
            $where[] = '(kos.nama_kos LIKE :keyword_name OR kos.lokasi LIKE :keyword_location OR kos.alamat LIKE :keyword_address)';
            $searchTerm = '%' . $keyword . '%';
            $parameters['keyword_name'] = $searchTerm;
            $parameters['keyword_location'] = $searchTerm;
            $parameters['keyword_address'] = $searchTerm;
        }

        $having = [];

        if (($filters['min_price'] ?? null) !== null) {
            $having[] = 'MIN(kamar.harga_bulanan) >= :min_price';
            $parameters['min_price'] = $filters['min_price'];
        }

        if (($filters['max_price'] ?? null) !== null) {
            $having[] = 'MIN(kamar.harga_bulanan) <= :max_price';
            $parameters['max_price'] = $filters['max_price'];
        }

        if (($filters['available'] ?? false) === true) {
            $where[] = "EXISTS (
                SELECT 1
                FROM kamar AS available_room
                WHERE available_room.kos_id = kos.id
                    AND available_room.status = 'kosong'
            )";
        }

        $statement = $this->connection->prepare(
            'SELECT kos.id,
                    kos.nama_kos,
                    kos.alamat,
                    kos.lokasi,
                    kos.deskripsi,
                    kos.fasilitas,
                    kos.no_hp_pengelola,
                    kos.status_publikasi,
                    MIN(kamar.harga_bulanan) AS harga_mulai,
                    COUNT(kamar.id) AS jumlah_kamar,
                    SUM(CASE WHEN kamar.status = \'kosong\' THEN 1 ELSE 0 END) AS kamar_kosong
             FROM kos
             LEFT JOIN kamar ON kamar.kos_id = kos.id
             WHERE ' . implode(' AND ', $where) . '
             GROUP BY kos.id' . ($having === [] ? '' : ' HAVING ' . implode(' AND ', $having)) . '
             ORDER BY kos.id DESC'
        );
        $statement->execute($parameters);

        return $statement->fetchAll();
    }

    /**
     * @return array<string, mixed>|null
     */
    public function findPublishedById(int $id): ?array
    {
        $this->assertValidId($id);
        $statement = $this->connection->prepare(
            'SELECT kos.id,
                    kos.nama_kos,
                    kos.alamat,
                    kos.lokasi,
                    kos.deskripsi,
                    kos.fasilitas,
                    kos.no_hp_pengelola,
                    kos.status_publikasi,
                    MIN(kamar.harga_bulanan) AS harga_mulai,
                    COUNT(kamar.id) AS jumlah_kamar,
                    SUM(CASE WHEN kamar.status = \'kosong\' THEN 1 ELSE 0 END) AS kamar_kosong
             FROM kos
             LEFT JOIN kamar ON kamar.kos_id = kos.id
             WHERE kos.id = :id AND kos.status_publikasi = \'published\'
             GROUP BY kos.id'
        );
        $statement->execute(['id' => $id]);
        $row = $statement->fetch();

        return $row === false ? null : $row;
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function findRoomsByKosId(int $kosId): array
    {
        $this->assertValidId($kosId);
        $statement = $this->connection->prepare(
            'SELECT id, kos_id, nomor_kamar, tipe, harga_bulanan, status
             FROM kamar
             WHERE kos_id = :kos_id
             ORDER BY nomor_kamar'
        );
        $statement->execute(['kos_id' => $kosId]);

        return $statement->fetchAll();
    }

    /**
     * @return array<string, mixed>|null
     */
    public function findPublishedRoomById(int $roomId): ?array
    {
        $this->assertValidId($roomId);
        $statement = $this->connection->prepare(
            'SELECT kamar.id AS kamar_id,
                    kamar.kos_id,
                    kamar.nomor_kamar,
                    kamar.tipe,
                    kamar.harga_bulanan,
                    kamar.status AS status_kamar,
                    kos.nama_kos,
                    kos.alamat,
                    kos.lokasi,
                    kos.deskripsi,
                    kos.fasilitas,
                    kos.no_hp_pengelola
             FROM kamar
             INNER JOIN kos ON kos.id = kamar.kos_id
             WHERE kamar.id = :id AND kos.status_publikasi = \'published\''
        );
        $statement->execute(['id' => $roomId]);
        $row = $statement->fetch();

        return $row === false ? null : $row;
    }

    public function create(Kos $kos): int
    {
        $this->assertValidKos($kos);
        $statement = $this->connection->prepare(
            'INSERT INTO kos (nama_kos, alamat, lokasi, deskripsi, fasilitas, no_hp_pengelola, status_publikasi)
             VALUES (:nama_kos, :alamat, :lokasi, :deskripsi, :fasilitas, :no_hp_pengelola, :status_publikasi)'
        );
        $statement->execute($this->values($kos));

        return (int) $this->connection->lastInsertId();
    }

    public function update(Kos $kos): bool
    {
        if ($kos->id === null) {
            throw new InvalidArgumentException('An ID is required to update a kos.');
        }

        $this->assertValidId($kos->id);
        $this->assertValidKos($kos);
        $values = $this->values($kos);
        $values['id'] = $kos->id;
        $statement = $this->connection->prepare(
            'UPDATE kos
             SET nama_kos = :nama_kos,
                 alamat = :alamat,
                 lokasi = :lokasi,
                 deskripsi = :deskripsi,
                 fasilitas = :fasilitas,
                 no_hp_pengelola = :no_hp_pengelola,
                 status_publikasi = :status_publikasi
             WHERE id = :id'
        );
        $statement->execute($values);

        return $statement->rowCount() > 0 || $this->findById($kos->id) !== null;
    }

    public function delete(int $id): bool
    {
        $this->assertValidId($id);
        $statement = $this->connection->prepare('DELETE FROM kos WHERE id = :id');
        $statement->execute(['id' => $id]);

        return $statement->rowCount() > 0;
    }

    /**
     * @return array<string, int|string|null>
     */
    private function values(Kos $kos): array
    {
        return [
            'nama_kos' => trim($kos->namaKos),
            'alamat' => trim($kos->alamat),
            'lokasi' => trim($kos->lokasi),
            'deskripsi' => $kos->deskripsi,
            'fasilitas' => $kos->fasilitas,
            'no_hp_pengelola' => $kos->noHpPengelola,
            'status_publikasi' => $kos->statusPublikasi,
        ];
    }

    private function assertValidKos(Kos $kos): void
    {
        if (trim($kos->namaKos) === '' || trim($kos->alamat) === '' || trim($kos->lokasi) === '') {
            throw new InvalidArgumentException('Nama kos, alamat, dan lokasi wajib diisi.');
        }

        if (!in_array($kos->statusPublikasi, ['draft', 'published'], true)) {
            throw new InvalidArgumentException('Status publikasi kos tidak valid.');
        }
    }

    private function assertValidId(int $id): void
    {
        if ($id < 1) {
            throw new InvalidArgumentException('ID kos harus berupa bilangan positif.');
        }
    }
}
