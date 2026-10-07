<?php
// ============================================================================
// File:    EditDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Channel;


class EditDTO
{
    public function __construct(
        public string   $title,
        public ?string  $description,
        public ?string  $instagramUrl,
        public ?string  $twitterUrl,
        public ?string  $facebookUrl,
        public ?string  $linkedinUrl,
        public ?string  $githubUrl,
    ) {}
}
