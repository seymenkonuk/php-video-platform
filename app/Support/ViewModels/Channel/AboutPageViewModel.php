<?php
// ============================================================================
// File:    AboutPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel;


use App\Support\DTOs\Channel\AboutDTO;

use App\Support\ViewContexts\ChannelViewContext;
use App\Support\ViewModels\ChannelViewModel;


final readonly class AboutPageViewModel extends ChannelViewModel
{
    public function __construct(
        ChannelViewContext $context,
        public AboutDTO $about,
    ) {
        parent::__construct($context);
    }
}
