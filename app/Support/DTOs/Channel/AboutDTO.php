<?php
// ============================================================================
// File:    AboutDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Channel;


use App\Support\DTOs\UI\SocialLinkDTO;


readonly class AboutDTO
{
    public function __construct(
        public ?string $description,
        /** @var array<SocialLinkDTO> $links */
        public array   $links,
        public int     $subscriberCount,
        public string  $subscriberCountFormatted,
        public int     $videoCount,
        public string  $videoCountFormatted,
        public int     $viewCount,
        public string  $viewCountFormatted,
        public string  $joinDate,
        public string  $joinDateFormatted,
    ) {}
}
