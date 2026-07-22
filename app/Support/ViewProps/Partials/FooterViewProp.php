<?php
// ============================================================================
// File:    FooterViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Partials;


use App\Support\ViewProps\BaseViewProp;


final readonly class FooterViewProp extends BaseViewProp
{
    public function __construct(
        public string $brandName,
        public string $dateYear,
    ) {}
}
