<?php
// ============================================================================
// File:    PlaylistVideo.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class PlaylistVideo
{
    public int      $order;
    public int      $video_id;
    public int      $playlist_id;
}
