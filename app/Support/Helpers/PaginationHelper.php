<?php
// ============================================================================
// File:    PaginationHelper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Helpers;


use Closure;

use App\Domain\Exception\NotFound\PageOutOfRangeException;
use App\Support\DTOs\UI\PaginationDTO;


class PaginationHelper
{
    /**
     * Sayfalama bilgilerini oluşturur ve belirtilen sayfanın verilerini
     * getirmek için callback'i offset ve limit değerleriyle çalıştırır.
     *
     * @template T
     *
     * @param int $page getirilecek sayfa numarası.
     * @param int $totalItems toplam öğe sayısı.
     * @param int $perPage sayfa başına getirilecek öğe sayısı.
     * @param Closure(int, int): T $callback verileri getirecek callback.
     *
     * @return array{pagination: PaginationDTO, data: T} sayfalama bilgileri ve getirilen veriler.
     */
    public static function create(
        int $page,
        int $totalItems,
        int $perPage,
        Closure $callback,
    ): array {
        // Toplam Sayfa Sayısını Hesapla
        $lastPage = max(1, (int) ceil($totalItems / $perPage));

        // Geçersiz Sayfa Numarası
        if ($page < 1 || $page > $lastPage) {
            throw new PageOutOfRangeException();
        }

        // Offset ve Limit Değerlerini Belirle
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;

        // Veriyi Getir
        $data = $callback($offset, $limit);

        // Gelen Veri Sayısını Hesapla
        $count = $page === $lastPage
            ? $totalItems - $offset
            : $perPage;

        // Sonucu Döndür
        return [
            "pagination" => new PaginationDTO(
                $page,
                $lastPage,
                $perPage,
                $count,
                $totalItems,
            ),
            "data" => $data,
        ];
    }
}
