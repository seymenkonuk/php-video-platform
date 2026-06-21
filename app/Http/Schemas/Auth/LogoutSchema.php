<?php
// ============================================================================
// File:    LogoutSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Auth;


use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;


class LogoutSchema extends Schema
{
    public function body(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "csrf_token" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }

    public function query(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "redirect_uri" => $this->validator->field()
                ->path(),
        ]);
    }
}
