<?php
// ============================================================================
// File:    LikedToHeaderDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Models\LikedDetails;

use App\Support\DTOs\Library\LikedHeaderDTO;
use App\Support\Helpers\NumberHelper;
use App\Support\Helpers\TimeHelper;


readonly class LikedToHeaderDtoMapper
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected NumberHelper $numberHelper,
        protected TimeHelper $timeHelper,
    ) {}

    // --------------------------------------------------------------------------
    // METHODS
    // --------------------------------------------------------------------------

    public function map(LikedDetails $details): LikedHeaderDTO
    {
        return new LikedHeaderDTO(
            $details->video_count,
            $this->numberHelper->formatNumber($details->video_count),
            $details->total_duration,
            $this->timeHelper->formatDuration($details->total_duration),
        );
    }
}
