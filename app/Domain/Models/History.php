<?php
// ============================================================================
// File:    History.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class History
{
    public int      $id;
    public int      $channel_id;
    public int      $video_id;
    public ?int     $watch_time;
    public string   $created_at;
}
