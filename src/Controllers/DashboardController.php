<?php

declare(strict_types=1);

namespace KosManager\Controllers;

use KosManager\Repositories\KamarRepository;
use KosManager\Repositories\PenghuniRepository;

final class DashboardController
{
    public function __construct(
        private readonly KamarRepository $kamarRepository,
        private readonly PenghuniRepository $penghuniRepository
    ) {
    }

    public function index(): void
    {
        AuthController::checkAuth();

        $stats = $this->kamarRepository->getDashboardStats();
        $recentResidents = array_slice($this->penghuniRepository->findAllWithDetails(10), 0, 5);
        $escape = PublicController::escape(...);

        require dirname(__DIR__, 2) . '/views/admin/dashboard/index.php';
    }
}
