<?php
// ============================================================================
// File:    Video.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class Video
{
    public int      $id;
    public string   $code;
    public string   $title;
    public string   $description;
    public int      $uploader_id;
    public int      $video_type;
    public int      $view_type;
    public int      $comment_type;
    public string   $file_path;
    public ?string  $thumbnail_path;
    public ?string  $transcript;
    public int      $duration;
    public string   $created_at;
    public ?string  $updated_at;
}
