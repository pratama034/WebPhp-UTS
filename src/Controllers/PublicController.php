<?php

declare(strict_types=1);

namespace KosManager\Controllers;

use KosManager\Repositories\KosRepository;
use Throwable;

final class PublicController
{
    public function __construct(private readonly KosRepository $kosRepository)
    {
    }

    public function home(): void
    {
        $publishedKos = $this->kosRepository->searchPublished();
        $availableRoomCount = array_sum(array_map(
            static fn (array $property): int => (int) ($property['kamar_kosong'] ?? 0),
            $publishedKos
        ));
        $featuredKos = $publishedKos;
        $featuredKos = array_slice($featuredKos, 0, 3);
        $escape = self::escape(...);

        require dirname(__DIR__, 2) . '/views/public/home.php';
    }

    public static function escape(mixed $value): string
    {
        return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
