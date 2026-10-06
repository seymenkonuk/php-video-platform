<?php
// ============================================================================
// File:    CreateDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Channel;


readonly class CreateDTO
{
    public function __construct(
        public string   $name,
        public string   $title,
        public ?string  $description,
        public ?string  $instagramUrl,
        public ?string  $twitterUrl,
        public ?string  $facebookUrl,
        public ?string  $linkedinUrl,
        public ?string  $githubUrl,
        public ?string  $avatarPath,
        public ?string  $bannerPath,
    ) {}
}
