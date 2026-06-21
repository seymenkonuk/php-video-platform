<?php
// ============================================================================
// File:    MusicsPageSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Channel\Index;


use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;


class MusicsPageSchema extends Schema
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
            "channelCode" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }
}
