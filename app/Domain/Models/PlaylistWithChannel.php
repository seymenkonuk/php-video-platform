<?php
// ============================================================================
// File:    PlaylistWithChannel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class PlaylistWithChannel extends Playlist
{
    public int      $video_count;
    public string   $channel_code;
    public string   $channel_title;
    public ?string  $channel_avatar;
}
