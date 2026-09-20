<?php
// ============================================================================
// File:    VideoDetails.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class VideoWithChannel extends Video
{
    public string   $channel_code;
    public string   $channel_title;
    public ?string  $channel_avatar;
}
