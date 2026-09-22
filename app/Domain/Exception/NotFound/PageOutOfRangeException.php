<?php
// ============================================================================
// File:    PageOutOfRangeException.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Exception\NotFound;


use Throwable;

use Seymenkonuk\Framework\Http\Exception\NotFoundException;


class PageOutOfRangeException extends NotFoundException
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct(
            title: "Sayfa Bulunamadı",
            description: "İstediğiniz sayfa numarası mevcut değil. Lütfen geçerli bir sayfa numarası girin.",
            previous: $previous,
        );
    }
}
