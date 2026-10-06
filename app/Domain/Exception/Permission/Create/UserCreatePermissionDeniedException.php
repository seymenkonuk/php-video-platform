<?php
// ============================================================================
// File:    UserCreatePermissionDeniedException.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Exception\Permission\Create;


use Throwable;

use Seymenkonuk\Framework\Http\Exception\AuthorizationException;


class UserCreatePermissionDeniedException extends AuthorizationException
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct(
            title: "Oluşturma Yetkiniz Yok",
            description: "Kullanıcı oluşturma yetkiniz bulunmuyor. Bu işlem için gerekli yetkiye sahip olmanız gerekiyor.",
            previous: $previous,
        );
    }
}
