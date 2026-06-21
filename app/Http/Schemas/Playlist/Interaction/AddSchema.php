<?php
// ============================================================================
// File:    AddSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Playlist\Interaction;


use Config\ValidationConfig;

use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;


class AddSchema extends Schema
{
    public function body(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "media" => $this->validator->field()
                ->string()
                ->min(ValidationConfig::CODE_MIN_LEN)
                ->max(ValidationConfig::CODE_MAX_LEN)
                ->regex(ValidationConfig::CODE_REGEX_RULE, ValidationConfig::CODE_REGEX_ERROR)
                ->required(),
            "csrf_token" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }

    public function params(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "playlist_code" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }
}
