<?php
// ============================================================================
// File:    HistoryToHeaderDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Models\HistoryDetails;

use App\Support\DTOs\Library\HistoryHeaderDTO;
use App\Support\Helpers\NumberHelper;
use App\Support\Helpers\TimeHelper;


readonly class HistoryToHeaderDtoMapper
{
    public function __construct(
        protected NumberHelper $numberHelper,
        protected TimeHelper $timeHelper,
    ) {}

    public function map(HistoryDetails $details): HistoryHeaderDTO
    {
        return new HistoryHeaderDTO(
            $details->video_count,
            $this->numberHelper->formatNumber($details->video_count),
            $details->total_duration,
            $this->timeHelper->formatDuration($details->total_duration),
        );
    }
}
