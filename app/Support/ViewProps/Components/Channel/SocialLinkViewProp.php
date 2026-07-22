<?php
// ============================================================================
// File:    SocialLinkViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Channel;


use App\Support\DTOs\UI\SocialLinkDTO;

use App\Support\ViewProps\BaseViewProp;


final readonly class SocialLinkViewProp extends BaseViewProp
{
    public function __construct(
        public SocialLinkDTO $link,
    ) {}
}
