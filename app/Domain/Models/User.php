<?php
// ============================================================================
// File:    User.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class User
{
    public int      $id;
    public string   $code;
    public string   $username;
    public string   $email;
    public string   $name;
    public string   $surname;
    public string   $country;
    public string   $password_hash;
    public ?int     $active_channel_id;
    public string   $created_at;
    public ?string  $updated_at;
}
