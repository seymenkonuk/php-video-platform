<?php
// ============================================================================
// File:    SubscribeSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Channel\Interaction;


use Seymenkonuk\Framework\Http\RequestSchema\ValidatorRequestSchema;

use Seymenkonuk\Validator\Validator\ObjectValidator;


class SubscribeSchema extends ValidatorRequestSchema
{
    public function body(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "csrfToken" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }

    public function params(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "channelCode" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }
}
