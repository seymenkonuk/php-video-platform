<?php
// ============================================================================
// File:    MusicRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Sql;


use App\Domain\Enums\VideoType;
use App\Domain\Repositories\Abstract\IMusicRepository;


class MusicRepository extends VideoRepository implements IMusicRepository
{
    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected int $type = VideoType::MUSIC->value;
}
