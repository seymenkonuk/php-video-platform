<?php
// ============================================================================
// File:    CommentsPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Feed;


use Generator;

use App\Support\ViewModels\BaseViewModel;

use App\Support\DTOs\Comment\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;


class CommentsPageViewModel extends BaseViewModel
{
    public function __construct(
        /** @var Generator<int, CardDTO> $comments */
        public Generator $comments,
        public PaginationDTO $pagination,
    ) {
        parent::__construct();
    }
}
