<?php
// ============================================================================
// File:    MusicToInteractionDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Models\VideoDetails;

use App\Support\DTOs\Music\InteractionDTO;
use App\Support\Helpers\NumberHelper;


readonly class MusicToInteractionDtoMapper
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected NumberHelper $numberHelper,
    ) {}

    // --------------------------------------------------------------------------
    // METHODS
    // --------------------------------------------------------------------------

    public function map(VideoDetails $video): InteractionDTO
    {
        return new InteractionDTO(
            $video->liked,
            $video->like_count,
            $this->numberHelper->formatNumber($video->like_count),
            $video->disliked,
            $video->dislike_count,
            $this->numberHelper->formatNumber($video->dislike_count),
        );
    }
}
