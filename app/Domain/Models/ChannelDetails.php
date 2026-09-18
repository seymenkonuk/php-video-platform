<?php
// ============================================================================
// File:    ChannelDetails.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class ChannelDetails extends ChannelWithStats
{
    public int      $subscribe_type;
    public ?string  $subscribe_title;
}
