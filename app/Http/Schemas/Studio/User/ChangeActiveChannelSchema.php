<?php
// ============================================================================
// File:    ChangeActiveChannelSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Studio\User;


use Config\ValidationConfig;

use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;


class ChangeActiveChannelSchema extends Schema
{
    public function body(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "channelCode" => $this->validator->field()
                ->string()
                ->min(ValidationConfig::CODE_MIN_LEN)
                ->max(ValidationConfig::CODE_MAX_LEN)
                ->regex(ValidationConfig::CODE_REGEX_RULE, ValidationConfig::CODE_REGEX_ERROR)
                ->required(),
            "csrfToken" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }

    public function params(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "userCode" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }
}
