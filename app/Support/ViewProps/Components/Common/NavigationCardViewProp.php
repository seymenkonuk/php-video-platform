<?php
// ============================================================================
// File:    NavigationCardViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Common;


use App\Support\ViewProps\BaseViewProp;


final readonly class NavigationCardViewProp extends BaseViewProp
{
    public function __construct(
        public string $href,
        public string $icon,
        public string $title,
        public string $description,
        public string $actionLabel,
    ) {}
}
