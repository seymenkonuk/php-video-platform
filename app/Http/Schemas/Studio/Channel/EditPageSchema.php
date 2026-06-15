<?php
// ============================================================================
// File:    EditPageSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Studio\Channel;


use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;


class EditPageSchema extends Schema
{
    public function body(): ObjectValidator
    {
        return $this->validator->object()->schema([]);
    }

    public function query(): ObjectValidator
    {
        return $this->validator->object()->schema([]);
    }

    public function params(): ObjectValidator
    {
        return $this->validator->object()->schema([]);
    }

    public function files(): ObjectValidator
    {
        return $this->validator->object()->schema([]);
    }
}
