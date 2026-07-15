<?php
// ============================================================================
// File:    HeaderDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Category;


readonly class HeaderDTO
{
    public function __construct(
        public string  $title,
        public ?string $description,
        public string  $banner,
        public int     $videoCount,
        public string  $videoCountFormatted,
    ) {}
}
