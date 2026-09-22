<?php
// ============================================================================
// File:    PlaylistNotFoundException.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Exception\NotFound;


use Throwable;

use Seymenkonuk\Framework\Http\Exception\NotFoundException;


class PlaylistNotFoundException extends NotFoundException
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct(
            title: "Oynatma Listesi Bulunamadı",
            description: "Aradığınız oynatma listesi mevcut değil. Silinmiş, kaldırılmış ya da bağlantı hatalı olabilir.",
            previous: $previous,
        );
    }
}
