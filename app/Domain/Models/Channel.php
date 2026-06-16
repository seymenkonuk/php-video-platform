<?php
// ============================================================================
// File:    Channel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class Channel
{
    public int      $id;
    public string   $code;
    public int      $user_id;
    public string   $name;
    public string   $title;
    public string   $description;
    public ?string  $avatar_path;
    public ?string  $banner_path;
    public ?string  $instagram_url;
    public ?string  $twitter_url;
    public ?string  $facebook_url;
    public ?string  $linkedin_url;
    public ?string  $github_url;
    public string   $created_at;
    public ?string  $updated_at;
}
