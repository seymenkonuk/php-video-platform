<?php
// ============================================================================
// File:    LikedDetails.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


use Seymenkonuk\Framework\Database\Model;


class LikedDetails extends Model
{
    public int     $video_count;
    public int     $total_duration;
}
