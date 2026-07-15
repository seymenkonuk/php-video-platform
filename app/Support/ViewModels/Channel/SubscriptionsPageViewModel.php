<?php
// ============================================================================
// File:    SubscriptionsPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel;


use Generator;

use App\Support\ViewModels\ChannelViewModel;

use App\Support\DTOs\Channel\HeaderDTO;
use App\Support\DTOs\Channel\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;


class SubscriptionsPageViewModel extends ChannelViewModel
{
    public function __construct(
        public HeaderDTO $header,
        /** @var Generator<int, CardDTO> $subscriptions */
        public Generator $subscriptions,
        public PaginationDTO $pagination,
    ) {
        parent::__construct($header);
    }
}
