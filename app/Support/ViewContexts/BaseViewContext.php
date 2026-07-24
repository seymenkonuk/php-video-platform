<?php
// ============================================================================
// File:    BaseViewContext.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewContexts;


final readonly class BaseViewContext
{
    public function __construct(
        public string $brandName,
        public string $csrfToken,
        public string $dateYear,
    ) {}
}
