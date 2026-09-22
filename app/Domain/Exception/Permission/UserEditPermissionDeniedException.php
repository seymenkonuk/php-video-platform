<?php
// ============================================================================
// File:    UserEditPermissionDeniedException.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Exception\Permission;


use Throwable;

use Seymenkonuk\Framework\Http\Exception\AuthorizationException;


class UserEditPermissionDeniedException extends AuthorizationException
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct(
            title: "Düzenleme Yetkiniz Yok",
            description: "Bu kullanıcı size ait değil. Sadece kullanıcının kendisi düzenleme işlemi yapabilir.",
            previous: $previous,
        );
    }
}
