<?php
// ============================================================================
// File:    VideoDetails.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class VideoDetails extends VideoWithChannel
{
    public int      $like_count;
    public int      $dislike_count;
    public bool     $liked;
    public bool     $disliked;
    public bool     $in_watch_later;
}
