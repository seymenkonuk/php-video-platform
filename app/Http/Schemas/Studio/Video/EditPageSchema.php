<?php
// ============================================================================
// File:    EditPageSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Studio\Video;


use Seymenkonuk\Framework\Http\RequestSchema\ValidatorRequestSchema;

use Seymenkonuk\Validator\Validator\ObjectValidator;


class EditPageSchema extends ValidatorRequestSchema
{
    public function params(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "videoCode" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }
}
