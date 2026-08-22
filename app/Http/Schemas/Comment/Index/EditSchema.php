<?php
// ============================================================================
// File:    EditSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Comment\Index;


use Seymenkonuk\Framework\Http\RequestSchema\ValidatorRequestSchema;

use Seymenkonuk\Validator\Validator\ObjectValidator;

use Config\ValidationConfig;


class EditSchema extends ValidatorRequestSchema
{
    public function body(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "message" => $this->validator->field()
                ->string()
                ->min(ValidationConfig::MESSAGE_MIN_LEN)
                ->max(ValidationConfig::MESSAGE_MAX_LEN)
                ->regex(ValidationConfig::MESSAGE_REGEX_RULE, ValidationConfig::MESSAGE_REGEX_ERROR)
                ->required(),
            "csrfToken" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }

    public function params(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "commentCode" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }
}
