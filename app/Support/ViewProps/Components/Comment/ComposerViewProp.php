<?php
// ============================================================================
// File:    ComposerViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Comment;


use App\Support\ViewProps\BaseViewProp;


final readonly class ComposerViewProp extends BaseViewProp
{
    public function __construct(
        public string $data,
        public bool $enabled,
        public bool $loggedIn,
        public bool $allowed,
    ) {}
}
