<?php
// ============================================================================
// File:    SubscriptionsPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel\Index;


use Generator;

use App\Support\ViewModels\BaseViewModel;

use App\Support\DTOs\ChannelHeaderDTO;
use App\Support\DTOs\PaginationDTO;
use App\Support\DTOs\ChannelCardDTO;


class SubscriptionsPageViewModel extends BaseViewModel
{
    public function __construct(
        public ChannelHeaderDTO $header,
        /** @var Generator<int, ChannelCardDTO> $subscriptions */
        public Generator $subscriptions,
        public PaginationDTO $pagination,
    ) {
        parent::__construct();
    }
}
