<?php
// ============================================================================
// File:    AddWatchLaterSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Music\Interaction;


use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;


class AddWatchLaterSchema extends Schema
{
    public function body(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "csrfToken" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }

    public function params(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "musicCode" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }
}
