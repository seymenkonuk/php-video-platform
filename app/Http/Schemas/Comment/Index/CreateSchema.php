<?php
// ============================================================================
// File:    CreateSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Comment\Index;


use Config\ValidationConfig;

use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;


class CreateSchema extends Schema
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
            "message" => $this->validator->field()
                ->string()
                ->min(ValidationConfig::MESSAGE_MIN_LEN)
                ->max(ValidationConfig::MESSAGE_MAX_LEN)
                ->regex(ValidationConfig::MESSAGE_REGEX_RULE, ValidationConfig::MESSAGE_REGEX_ERROR)
                ->required(),
            "reply" => $this->validator->field()
                ->string()
                ->min(ValidationConfig::CODE_MIN_LEN)
                ->max(ValidationConfig::CODE_MAX_LEN)
                ->regex(ValidationConfig::CODE_REGEX_RULE, ValidationConfig::CODE_REGEX_ERROR),
            "csrfToken" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }
}
