<?php
// ============================================================================
// File:    CreateDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Playlist;


use App\Domain\Enums\ViewType;


readonly class CreateDTO
{
    public function __construct(
        public string       $title,
        public ?string      $description,
        public ViewType     $viewType,
        public ?string      $bannerPath,
    ) {}
}
