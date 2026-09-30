<?php
// ============================================================================
// File:    VideoDeletePermissionDeniedException.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Exception\Permission\Delete;


use Throwable;

use Seymenkonuk\Framework\Http\Exception\AuthorizationException;


class VideoDeletePermissionDeniedException extends AuthorizationException
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct(
            title: "Silme Yetkiniz Yok",
            description: "Bu video size ait değil. Sadece video sahibi silme işlemi yapabilir.",
            previous: $previous,
        );
    }
}
