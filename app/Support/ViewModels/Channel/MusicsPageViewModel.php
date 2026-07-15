<?php
// ============================================================================
// File:    MusicsPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel;


use Generator;

use App\Support\ViewModels\BaseViewModel;

use App\Support\DTOs\Channel\HeaderDTO;
use App\Support\DTOs\Music\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;


class MusicsPageViewModel extends BaseViewModel
{
    public function __construct(
        public HeaderDTO $header,
        /** @var Generator<int, CardDTO> $musics */
        public Generator $musics,
        public PaginationDTO $pagination,
    ) {
        parent::__construct();
    }
}
