<?php
// ============================================================================
// File:    VideoCaption.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class VideoCaption
{
    public string   $code;
    public int      $video_id;
    public string   $language_code;
    public string   $language_name;
    public string   $file_path;
    public string   $created_at;
    public ?string  $updated_at;
}
