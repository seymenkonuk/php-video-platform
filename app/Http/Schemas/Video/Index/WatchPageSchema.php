<?php
// ============================================================================
// File:    WatchPageSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Video\Index;


use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;

use Config\ValidationConfig;


class WatchPageSchema extends Schema
{
    public function query(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "t" => $this->validator->field()
                ->int(false)
                ->min(0)
                ->default(0),
            "playlist" => $this->validator->field()
                ->string()
                ->min(ValidationConfig::CODE_MIN_LEN)
                ->max(ValidationConfig::CODE_MAX_LEN)
                ->regex(ValidationConfig::CODE_REGEX_RULE, ValidationConfig::CODE_REGEX_ERROR),
            "index" => $this->validator->field()
                ->int(false)
                ->min(0)
                ->default(0),
        ]);
    }

    public function params(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "videoCode" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }
}
