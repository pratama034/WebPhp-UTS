<?php

declare(strict_types=1);

namespace KosManager\Controllers;

use KosManager\Repositories\KosRepository;

final class KosController
{
    public function __construct(private readonly KosRepository $kosRepository)
    {
    }

    public function index(): void
    {
        $filters = $this->readFilters();
        $filterError = $filters['error'];
        $kosList = $filterError === null ? $this->kosRepository->searchPublished($filters) : [];
        $hasFilters = $filters['keyword'] !== ''
            || $filters['min_price'] !== null
            || $filters['max_price'] !== null
            || $filters['available'];
        $escape = PublicController::escape(...);
        http_response_code($filterError === null ? 200 : 422);

        require dirname(__DIR__, 2) . '/views/public/kos.php';
    }

    public function detail(): void
    {
        $id = $this->readId($_GET['id'] ?? null);

        if ($id === null) {
            $this->notFound();
            return;
        }

        $kos = $this->kosRepository->findPublishedById($id);

        if ($kos === null) {
            $this->notFound();
            return;
        }

        $rooms = $this->kosRepository->findRoomsByKosId($id);
        $selectedRoom = null;
        $escape = PublicController::escape(...);

        require dirname(__DIR__, 2) . '/views/public/detail.php';
    }

    public function roomDetail(): void
    {
        $roomId = $this->readId($_GET['id'] ?? null);

        if ($roomId === null) {
            $this->notFound();
            return;
        }

        $selectedRoom = $this->kosRepository->findPublishedRoomById($roomId);

        if ($selectedRoom === null) {
            $this->notFound();
            return;
        }

        $kos = $this->kosRepository->findPublishedById((int) $selectedRoom['kos_id']);

        if ($kos === null) {
            $this->notFound();
            return;
        }

        $rooms = $this->kosRepository->findRoomsByKosId((int) $kos['id']);
        $escape = PublicController::escape(...);

        require dirname(__DIR__, 2) . '/views/public/detail.php';
    }

    public function adminIndex(): void
    {
        (new AdminKosController($this->kosRepository))->index();
    }

    public function create(): void
    {
        (new AdminKosController($this->kosRepository))->create();
    }

    public function store(): void
    {
        (new AdminKosController($this->kosRepository))->store();
    }

    public function edit(): void
    {
        (new AdminKosController($this->kosRepository))->edit();
    }

    public function update(): void
    {
        (new AdminKosController($this->kosRepository))->update();
    }

    public function destroy(): void
    {
        (new AdminKosController($this->kosRepository))->destroy();
    }

    /**
     * @return array{keyword: string, min_price: float|null, max_price: float|null, available: bool, error: string|null}
     */
    private function readFilters(): array
    {
        $keywordInput = $_GET['q'] ?? '';
        $keyword = is_string($keywordInput) ? trim($keywordInput) : '';
        $keywordError = is_string($keywordInput) ? null : 'Kata kunci pencarian tidak valid.';
        [$minPrice, $minError] = $this->readPrice($_GET['min_price'] ?? null);
        [$maxPrice, $maxError] = $this->readPrice($_GET['max_price'] ?? null);
        $error = $keywordError ?? $minError ?? $maxError;

        if ($minPrice !== null && $maxPrice !== null && $minPrice > $maxPrice) {
            $error = 'Harga minimum tidak boleh lebih besar dari harga maksimum.';
        }

        $availabilityInput = $_GET['availability'] ?? 'all';
        $availability = is_string($availabilityInput) ? $availabilityInput : '';

        if (!in_array($availability, ['all', 'vacant-only'], true)) {
            $error ??= 'Filter ketersediaan tidak valid.';
        }

        return [
            'keyword' => $keyword,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'available' => $availability === 'vacant-only',
            'error' => $error,
        ];
    }

    /**
     * @return array{float|null, string|null}
     */
    private function readPrice(mixed $value): array
    {
        if ($value === null || (is_string($value) && trim($value) === '')) {
            return [null, null];
        }

        if (!is_string($value) || !is_numeric($value) || (float) $value < 0) {
            return [null, 'Harga harus berupa angka nol atau lebih.'];
        }

        return [(float) $value, null];
    }

    private function readId(mixed $value): ?int
    {
        $id = filter_var($value, FILTER_VALIDATE_INT);

        return $id !== false && $id > 0 ? $id : null;
    }

    private function notFound(): void
    {
        http_response_code(404);
        echo '404 Not Found';
    }
}
