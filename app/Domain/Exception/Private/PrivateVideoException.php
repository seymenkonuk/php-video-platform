<?php
// ============================================================================
// File:    PrivateVideoException.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Exception\Private;


use Throwable;

use Seymenkonuk\Framework\Http\Exception\AuthorizationException;


class PrivateVideoException extends AuthorizationException
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct(
            title: "Video Gizli",
            description: "Bu video yalnızca belirli kişilerle paylaşılmış. Erişim izniniz olmayabilir.",
            previous: $previous,
        );
    }
}
