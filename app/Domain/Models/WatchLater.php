<?php
// ============================================================================
// File:    WatchLater.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class WatchLater
{
    public int      $channel_id;
    public int      $video_id;
    public string   $created_at;
    public ?string  $updated_at;
}
