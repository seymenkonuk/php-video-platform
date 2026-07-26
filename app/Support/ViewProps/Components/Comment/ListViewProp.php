<?php
// ============================================================================
// File:    ListViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Comment;


use Generator;

use App\Support\DTOs\Comment\ItemDTO;

use App\Support\ViewProps\BaseViewProp;


final readonly class ListViewProp extends BaseViewProp
{
    /** @param Generator<ItemDTO> $comments */
    public function __construct(
        public string $data,
        public bool $enabled,
        public bool $loggedIn,
        public bool $allowed,
        public Generator $comments,
        public int $count,
        public string $countFormatted,
    ) {}
}
