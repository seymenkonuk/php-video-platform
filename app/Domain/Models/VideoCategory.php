<?php
// ============================================================================
// File:    VideoCategory.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class VideoCategory
{
    public int      $video_id;
    public int      $category_id;
    public string   $created_at;
}
