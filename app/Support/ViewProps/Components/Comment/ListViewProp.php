<?php
// ============================================================================
// File:    ListViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Comment;


use App\Support\DTOs\Comment\ListDTO;

use App\Support\ViewProps\BaseViewProp;


final readonly class ListViewProp extends BaseViewProp
{
    public function __construct(
        public ListDTO $commentList,
    ) {}
}
