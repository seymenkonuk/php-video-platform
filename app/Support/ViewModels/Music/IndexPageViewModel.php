<?php
// ============================================================================
// File:    IndexPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Music;


use Generator;

use App\Support\DTOs\Music\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;

use App\Support\ViewContexts\AppViewContext;
use App\Support\ViewModels\AppViewModel;


final readonly class IndexPageViewModel extends AppViewModel
{
    /** @param Generator<int, CardDTO> $musics  */
    public function __construct(
        AppViewContext $context,
        public Generator $musics,
        public PaginationDTO $pagination,
    ) {
        parent::__construct($context);
    }
}
