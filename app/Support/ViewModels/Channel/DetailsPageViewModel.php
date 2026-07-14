<?php
// ============================================================================
// File:    DetailsPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel;


use App\Support\ViewModels\BaseViewModel;

use App\Support\DTOs\ChannelDetailsDTO;
use App\Support\DTOs\ChannelHeaderDTO;


class DetailsPageViewModel extends BaseViewModel
{
    public function __construct(
        public ChannelHeaderDTO $header,
        public ChannelDetailsDTO $details,
    ) {
        parent::__construct();
    }
}
