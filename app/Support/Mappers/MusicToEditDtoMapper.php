<?php
// ============================================================================
// File:    MusicToEditDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Enums\CommentType;
use App\Domain\Enums\ViewType;
use App\Domain\Models\Video;

use App\Support\DTOs\Music\EditDTO;


readonly class MusicToEditDtoMapper
{
    public function map(Video $music): EditDTO
    {
        return new EditDTO(
            title: $music->title,
            description: $music->description,
            viewType: ViewType::from($music->view_type),
            commentType: CommentType::from($music->comment_type),
            transcript: $music->transcript,
        );
    }

    /** @return array<string, mixed> */
    public function toArray(Video $music): array
    {
        return [
            "title" => $music->title,
            "description" => $music->description,
            "viewType" => $music->view_type,
            "commentType" => $music->comment_type,
            "transcript" => $music->transcript,
        ];
    }

    /** @return array<string, mixed> */
    public function toModelArray(EditDTO $music): array
    {
        return [
            "title" => $music->title,
            "description" => $music->description,
            "view_type" => $music->viewType->value,
            "comment_type" => $music->commentType->value,
            "transcript" => $music->transcript,
        ];
    }
}
