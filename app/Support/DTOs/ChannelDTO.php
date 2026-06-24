<?php
// ============================================================================
// File:    ChannelDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs;


readonly class ChannelDTO
{
    public function __construct(
        public string  $url,
        public string  $title,
        public string  $avatar,
    ) {}
}
