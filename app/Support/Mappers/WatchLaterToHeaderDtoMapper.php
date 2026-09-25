<?php
// ============================================================================
// File:    WatchLaterToHeaderDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Models\WatchLaterDetails;

use App\Support\DTOs\Library\WatchLaterHeaderDTO;
use App\Support\Helpers\NumberHelper;
use App\Support\Helpers\TimeHelper;


readonly class WatchLaterToHeaderDtoMapper
{
    public function __construct(
        protected NumberHelper $numberHelper,
        protected TimeHelper $timeHelper,
    ) {}

    public function map(WatchLaterDetails $details): WatchLaterHeaderDTO
    {
        return new WatchLaterHeaderDTO(
            $details->video_count,
            $this->numberHelper->formatNumber($details->video_count),
            $details->total_duration,
            $this->timeHelper->formatDuration($details->total_duration),
        );
    }
}
