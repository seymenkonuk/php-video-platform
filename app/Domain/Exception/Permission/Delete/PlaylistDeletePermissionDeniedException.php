<?php
// ============================================================================
// File:    PlaylistDeletePermissionDeniedException.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Exception\Permission\Delete;


use Throwable;

use Seymenkonuk\Framework\Http\Exception\AuthorizationException;


class PlaylistDeletePermissionDeniedException extends AuthorizationException
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct(
            title: "Silme Yetkiniz Yok",
            description: "Bu oynatma listesi size ait değil. Sadece oynatma listesi sahibi silme işlemi yapabilir.",
            previous: $previous,
        );
    }
}
