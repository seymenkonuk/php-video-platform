<?php
// ============================================================================
// File:    IndexPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel;


use Generator;

use App\Support\ViewModels\AppViewModel;

use App\Support\DTOs\Channel\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;


class IndexPageViewModel extends AppViewModel
{
    public function __construct(
        /** @var Generator<int, CardDTO> $channels  */
        public Generator $channels,
        public PaginationDTO $pagination,
    ) {
        parent::__construct();
    }
}
