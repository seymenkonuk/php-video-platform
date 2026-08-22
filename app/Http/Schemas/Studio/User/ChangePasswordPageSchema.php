<?php
// ============================================================================
// File:    ChangePasswordPageSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Studio\User;


use Seymenkonuk\Framework\Http\RequestSchema\ValidatorRequestSchema;

use Seymenkonuk\Validator\Validator\ObjectValidator;


class ChangePasswordPageSchema extends ValidatorRequestSchema
{
    public function params(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "userCode" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }
}
