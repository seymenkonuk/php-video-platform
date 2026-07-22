<?php
// ============================================================================
// File:    PaginationViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Common;


use App\Support\DTOs\UI\PaginationDTO;

use App\Support\ViewProps\BaseViewProp;


final readonly class PaginationViewProp extends BaseViewProp
{
    public function __construct(
        public PaginationDTO $pagination,
    ) {}
}
