<?php
// ============================================================================
// File:    LibraryHeaderDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Library;


readonly class LibraryHeaderDTO
{
    public function __construct(
        public int     $videoCount,
        public string  $videoCountFormatted,
        public int     $totalDuration,
        public string  $totalDurationFormatted,
    ) {}
}
