<?php
// ============================================================================
// File:    Category.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class Category
{
    public int      $id;
    public string   $code;
    public string   $title;
    public string   $description;
    public ?string  $banner_path;
    public string   $created_at;
    public ?string  $updated_at;
}
