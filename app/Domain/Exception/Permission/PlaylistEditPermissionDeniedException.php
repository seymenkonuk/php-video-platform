<?php
// ============================================================================
// File:    PlaylistEditPermissionDeniedException.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Exception\Permission;


use Throwable;

use Seymenkonuk\Framework\Http\Exception\AuthorizationException;


class PlaylistEditPermissionDeniedException extends AuthorizationException
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct(
            title: "Düzenleme Yetkiniz Yok",
            description: "Bu oynatma listesi size ait değil. Sadece oynatma listesi sahibi düzenleme işlemi yapabilir.",
            previous: $previous,
        );
    }
}
