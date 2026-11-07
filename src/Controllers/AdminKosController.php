<?php

declare(strict_types=1);

namespace KosManager\Controllers;

use InvalidArgumentException;
use KosManager\Models\Kos;
use KosManager\Repositories\KosRepository;
use PDOException;
use Throwable;

final class AdminKosController
{
    public function __construct(private readonly KosRepository $kosRepository)
    {
    }

    public function index(): void
    {
        AuthController::checkAuth();

        $kosList = $this->kosRepository->findAll();
        $escape = PublicController::escape(...);

        require dirname(__DIR__, 2) . '/views/admin/kos/index.php';
    }

    public function create(): void
    {
        AuthController::checkAuth();

        $this->renderForm();
    }

    public function edit(): void
    {
        AuthController::checkAuth();

        $id = $this->readId($_GET['id'] ?? null);
        $kos = $id === null ? null : $this->kosRepository->findById($id);

        if ($kos === null) {
            $this->notFound();
            return;
        }

        $this->renderForm($kos);
    }

    public function store(): void
    {
        AuthController::checkAuth();
        AuthController::verifyCsrf('/admin/kos');

        $input = $this->readInput();

        try {
            $this->kosRepository->create($this->makeKos($input));
            set_flash('success', 'Properti kos baru berhasil ditambahkan.');
            $this->redirect('/admin/kos');
        } catch (InvalidArgumentException $exception) {
            $this->renderForm(null, $exception->getMessage(), $input, 422);
        } catch (PDOException $exception) {
            error_log($exception->__toString());
            $this->renderForm(null, 'Gagal menyimpan properti kos. Periksa data yang Anda masukkan.', $input, 422);
        }
    }

    public function update(): void
    {
        AuthController::checkAuth();
        AuthController::verifyCsrf('/admin/kos');

        $id = $this->readId($_POST['id'] ?? null);

        if ($id === null) {
            $this->notFound();
            return;
        }

        $input = $this->readInput();

        try {
            if (!$this->kosRepository->update($this->makeKos($input, $id))) {
                $this->notFound();
                return;
            }

            set_flash('success', 'Data properti kos berhasil diperbarui.');
            $this->redirect('/admin/kos');
        } catch (InvalidArgumentException $exception) {
            $kos = $this->kosRepository->findById($id);
            $this->renderForm($kos, $exception->getMessage(), $input, 422);
        } catch (PDOException $exception) {
            error_log($exception->__toString());
            $kos = $this->kosRepository->findById($id);
            $this->renderForm($kos, 'Gagal memperbarui properti kos. Periksa data yang Anda masukkan.', $input, 422);
        }
    }

    public function destroy(): void
    {
        AuthController::checkAuth();
        AuthController::verifyCsrf('/admin/kos');

        $id = $this->readId($_POST['id'] ?? null);

        if ($id === null) {
            $this->notFound();
            return;
        }

        try {
            $this->kosRepository->delete($id);
            set_flash('success', 'Properti kos berhasil dihapus.');
            $this->redirect('/admin/kos');
        } catch (Throwable $exception) {
            error_log($exception->__toString());
            set_flash('error', 'Properti kos tidak dapat dihapus karena masih memiliki data kamar atau penghuni.');
            $this->redirect('/admin/kos');
        }
    }

    public function delete(): void
    {
        AuthController::checkAuth();

        $this->destroy();
    }

    /**
     * @param array<string, mixed> $formData
     */
    private function renderForm(?Kos $kos = null, ?string $formError = null, array $formData = [], int $status = 200): void
    {
        http_response_code($status);
        $formData += [
            'nama_kos' => $kos?->namaKos ?? '',
            'lokasi' => $kos?->lokasi ?? '',
            'alamat' => $kos?->alamat ?? '',
            'deskripsi' => $kos?->deskripsi ?? '',
            'fasilitas' => $kos?->fasilitas ?? '',
            'no_hp_pengelola' => $kos?->noHpPengelola ?? '',
            'status_publikasi' => $kos?->statusPublikasi ?? 'draft',
        ];
        $isEdit = $kos !== null;
        $escape = PublicController::escape(...);

        require dirname(__DIR__, 2) . '/views/admin/kos/form.php';
    }

    private function indexWithError(string $formError): void
    {
        $kosList = $this->kosRepository->findAll();
        $escape = PublicController::escape(...);

        require dirname(__DIR__, 2) . '/views/admin/kos/index.php';
    }

    /**
     * @return array{nama_kos: string, lokasi: string, alamat: string, deskripsi: string|null, fasilitas: string|null, no_hp_pengelola: string|null, status_publikasi: string}
     */
    private function readInput(): array
    {
        $deskripsi = trim((string) ($_POST['deskripsi'] ?? ''));
        $fasilitas = trim((string) ($_POST['fasilitas'] ?? ''));
        $noHp = trim((string) ($_POST['no_hp_pengelola'] ?? ''));

        return [
            'nama_kos' => trim((string) ($_POST['nama_kos'] ?? '')),
            'lokasi' => trim((string) ($_POST['lokasi'] ?? '')),
            'alamat' => trim((string) ($_POST['alamat'] ?? '')),
            'deskripsi' => $deskripsi === '' ? null : $deskripsi,
            'fasilitas' => $fasilitas === '' ? null : $fasilitas,
            'no_hp_pengelola' => $noHp === '' ? null : $noHp,
            'status_publikasi' => trim((string) ($_POST['status_publikasi'] ?? 'draft')),
        ];
    }

    /**
     * @param array{nama_kos: string, lokasi: string, alamat: string, deskripsi: string|null, fasilitas: string|null, no_hp_pengelola: string|null, status_publikasi: string} $input
     */
    private function makeKos(array $input, ?int $id = null): Kos
    {
        return new Kos(
            $id,
            $input['nama_kos'],
            $input['alamat'],
            $input['lokasi'],
            $input['deskripsi'],
            $input['fasilitas'],
            $input['no_hp_pengelola'],
            $input['status_publikasi']
        );
    }

    private function readId(mixed $value): ?int
    {
        $id = filter_var($value, FILTER_VALIDATE_INT);

        return $id !== false && $id > 0 ? $id : null;
    }

    private function redirect(string $location): void
    {
        header('Location: ' . base_url($location), true, 303);
        exit;
    }

    private function notFound(): void
    {
        http_response_code(404);
        echo '404 Not Found';
    }
}

