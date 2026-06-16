<?php
// ============================================================================
// File:    Playlist.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class Playlist
{
    public int      $id;
    public string   $code;
    public int      $channel_id;
    public string   $title;
    public string   $description;
    public ?string  $banner_path;
    public int      $view_type;
    public string   $created_at;
    public ?string  $updated_at;
}
