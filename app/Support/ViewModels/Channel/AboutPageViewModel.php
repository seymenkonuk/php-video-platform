<?php
// ============================================================================
// File:    AboutPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel;


use App\Support\ViewModels\ChannelViewModel;

use App\Support\DTOs\Channel\AboutDTO;
use App\Support\DTOs\Channel\HeaderDTO;


class AboutPageViewModel extends ChannelViewModel
{
    public function __construct(
        public HeaderDTO $header,
        public AboutDTO $about,
    ) {
        parent::__construct($header);
    }
}
