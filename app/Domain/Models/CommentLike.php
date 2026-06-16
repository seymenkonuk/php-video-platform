<?php
// ============================================================================
// File:    CommentLike.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class CommentLike
{
    public int      $comment_id;
    public int      $channel_id;
    public int      $type;
    public string   $created_at;
    public ?string  $updated_at;
}
