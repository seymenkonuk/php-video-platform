<?php
// ============================================================================
// File:    Comment.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class Comment
{
    public int      $id;
    public string   $code;
    public int      $video_id;
    public int      $reply_id;
    public int      $commenter_id;
    public string   $message;
    public string   $created_at;
    public ?string  $updated_at;
}
