<?php
// ============================================================================
// File:    SubscriptionsPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel;


use Generator;

use App\Support\DTOs\Channel\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;

use App\Support\ViewContexts\ChannelViewContext;
use App\Support\ViewModels\ChannelViewModel;


final readonly class SubscriptionsPageViewModel extends ChannelViewModel
{
    /** @param Generator<int, CardDTO> $subscriptions */
    public function __construct(
        ChannelViewContext $context,
        public Generator $subscriptions,
        public PaginationDTO $pagination,
    ) {
        parent::__construct($context);
    }
}
