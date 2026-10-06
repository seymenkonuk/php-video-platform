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

    /** @return array<string, mixed> */
    public function toArray(Video $short): array
    {
        return [
            "title" => $short->title,
            "description" => $short->description,
            "viewType" => $short->view_type,
            "commentType" => $short->comment_type,
            "transcript" => $short->transcript,
        ];
    }

    /** @return array<string, mixed> */
    public function toModelArray(EditDTO $short): array
    {
        return [
            "title" => $short->title,
            "description" => $short->description,
            "view_type" => $short->viewType->value,
            "comment_type" => $short->commentType->value,
            "transcript" => $short->transcript,
        ];
    }
}
