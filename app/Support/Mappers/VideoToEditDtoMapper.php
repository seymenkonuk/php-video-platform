<?php
// ============================================================================
// File:    VideoToEditDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Enums\CommentType;
use App\Domain\Enums\ViewType;
use App\Domain\Models\Video;

use App\Support\DTOs\Video\EditDTO;


readonly class VideoToEditDtoMapper
{
    public function map(Video $video): EditDTO
    {
        return new EditDTO(
            title: $video->title,
            description: $video->description,
            viewType: ViewType::from($video->view_type),
            commentType: CommentType::from($video->comment_type),
            transcript: $video->transcript,
        );
    }
}
