<?php
// ============================================================================
// File:    SocialLinkDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\UI;


readonly class SocialLinkDTO
{
    public string $url;

    public function __construct(
        public string $rootUrl,
        public string $name,
        public string $icon,
        public string $path,
    ) {
        $this->url = $this->rootUrl . $this->path;
    }
}
