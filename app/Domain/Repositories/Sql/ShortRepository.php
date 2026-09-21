<?php
// ============================================================================
// File:    ShortRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Sql;


use App\Domain\Enums\VideoType;
use App\Domain\Repositories\Abstract\IShortRepository;


class ShortRepository extends VideoRepository implements IShortRepository
{
    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected int $type = VideoType::SHORT->value;
}
