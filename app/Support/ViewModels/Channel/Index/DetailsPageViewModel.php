<?php
// ============================================================================
// File:    DetailsPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel\Index;


use App\Support\DTOs\ChannelDetailsDTO;
use App\Support\DTOs\ChannelHeaderDTO;


class DetailsPageViewModel
{
    public function __construct(
        public ChannelHeaderDTO $header,
        public ChannelDetailsDTO $details,
    ) {}
}
