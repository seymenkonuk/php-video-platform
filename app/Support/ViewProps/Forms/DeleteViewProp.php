<?php
// ============================================================================
// File:    DeleteViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Forms;


use App\Support\ViewProps\BaseViewProp;


final readonly class DeleteViewProp extends BaseViewProp
{
    public function __construct(
        public string $url,
        public string $title,
        public string $description,
        public bool $disabled,
    ) {}
}
