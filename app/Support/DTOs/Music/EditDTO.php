<?php
// ============================================================================
// File:    EditDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Music;


use App\Domain\Enums\CommentType;
use App\Domain\Enums\ViewType;


class EditDTO
{
    public function __construct(
        public string       $title,
        public ?string      $description,
        public ViewType     $viewType,
        public CommentType  $commentType,
        public ?string      $transcript,
    ) {}
}
