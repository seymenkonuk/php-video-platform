<?php
// ============================================================================
// File:    HomePageSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Playlist\Index;


use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;


class HomePageSchema extends Schema
{
    public function query(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "page" => $this->validator->field()
                ->int(false)
                ->min(1)
                ->default(1),
        ]);
    }

    public function params(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "playlistCode" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }
}
