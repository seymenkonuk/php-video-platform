<?php
// ============================================================================
// File:    ShortToEditDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Enums\CommentType;
use App\Domain\Enums\ViewType;
use App\Domain\Models\Video;

use App\Support\DTOs\Short\EditDTO;


readonly class ShortToEditDtoMapper
{
    public function map(Video $short): EditDTO
    {
        return new EditDTO(
            title: $short->title,
            description: $short->description,
            viewType: ViewType::from($short->view_type),
            commentType: CommentType::from($short->comment_type),
            transcript: $short->transcript,
        );
    }
}
