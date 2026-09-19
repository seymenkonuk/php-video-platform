<?php
// ============================================================================
// File:    AboutPageDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Channel;


readonly class AboutPageDTO
{
    public function __construct(
        public HeaderDTO    $header,
        public AboutDTO     $about,
    ) {}
}
