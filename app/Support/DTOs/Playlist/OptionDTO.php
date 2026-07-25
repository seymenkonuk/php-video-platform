<?php
// ============================================================================
// File:    OptionDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Playlist;


use App\Domain\Enums\ViewType;


readonly class OptionDTO
{
    public function __construct(
        public string       $url,
        public string       $title,
        public int          $videoCount,
        public string       $videoCountFormatted,
        public ViewType     $viewType,
        public bool         $checked,
        public ?int         $itemId,
    ) {}
}
