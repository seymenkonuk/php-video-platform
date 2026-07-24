<?php
// ============================================================================
// File:    RegisterSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Auth;


use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;

use Config\ValidationConfig;


class RegisterSchema extends Schema
{
    public function body(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "name" => $this->validator->field()
                ->string()
                ->min(ValidationConfig::NAME_MIN_LEN)
                ->max(ValidationConfig::NAME_MAX_LEN)
                ->regex(ValidationConfig::NAME_REGEX_RULE, ValidationConfig::NAME_REGEX_ERROR)
                ->required(),
            "surname" => $this->validator->field()
                ->string()
                ->min(ValidationConfig::SURNAME_MIN_LEN)
                ->max(ValidationConfig::SURNAME_MAX_LEN)
                ->regex(ValidationConfig::SURNAME_REGEX_RULE, ValidationConfig::SURNAME_REGEX_ERROR)
                ->required(),
            "username" => $this->validator->field()
                ->string()
                ->min(ValidationConfig::USERNAME_MIN_LEN)
                ->max(ValidationConfig::USERNAME_MAX_LEN)
                ->regex(ValidationConfig::USERNAME_REGEX_RULE, ValidationConfig::USERNAME_REGEX_ERROR)
                ->required(),
            "email" => $this->validator->field()
                ->email()
                ->required(),
            "password" => $this->validator->field()
                ->password(true)
                ->required(),
            "country" => $this->validator->field()
                ->in(ValidationConfig::ALLOWED_COUNTRIES)
                ->required(),
            "csrfToken" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }

    public function query(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "redirectUri" => $this->validator->field()
                ->path(),
        ]);
    }
}
