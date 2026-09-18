<?php
// ============================================================================
// File:    ChannelWithStats.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class ChannelWithStats extends Channel
{
    public int      $subscriber_count;
    public int      $video_count;
    public int      $view_count;
}
