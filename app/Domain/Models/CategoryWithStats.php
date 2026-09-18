<?php
// ============================================================================
// File:    CategoryWithStats.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class CategoryWithStats extends Category
{
    public int      $video_count;
}
