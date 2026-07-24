<?php
// ============================================================================
// File:    IndexPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Short;


use Generator;

use App\Support\DTOs\Short\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;

use App\Support\ViewContexts\AppViewContext;
use App\Support\ViewModels\AppViewModel;


final readonly class IndexPageViewModel extends AppViewModel
{
    /** @param Generator<int, CardDTO> $shorts  */
    public function __construct(
        AppViewContext $context,
        public Generator $shorts,
        public PaginationDTO $pagination,
    ) {
        parent::__construct($context);
    }
}
