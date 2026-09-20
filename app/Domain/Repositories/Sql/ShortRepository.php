<?php
// ============================================================================
// File:    ShortRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Sql;


use App\Domain\Enums\VideoType;


class ShortRepository extends VideoRepository
{
    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected int $type = VideoType::SHORT->value;
}
