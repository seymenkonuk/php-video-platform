<?php
// ============================================================================
// File:    ChangePasswordSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Studio\User;


use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;


class ChangePasswordSchema extends Schema
{
    public function body(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "oldPassword" => $this->validator->field()
                ->string()
                ->required(),
            "newPassword" => $this->validator->field()
                ->password(true)
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
