<?php
// ============================================================================
// File:    HomePageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel\Index;


use App\Support\ViewModels\BaseViewModel;

use App\Support\DTOs\ChannelHeaderDTO;


class HomePageViewModel extends BaseViewModel
{
    public function __construct(
        public ChannelHeaderDTO $header,
    ) {}
}
