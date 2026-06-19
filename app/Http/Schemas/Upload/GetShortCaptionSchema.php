<?php
// ============================================================================
// File:    GetShortCaptionSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Upload;


use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;


class GetShortCaptionSchema extends Schema
{
    public function params(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "short_code" => $this->validator->field()
                ->string()
                ->required(),
            "file_name" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }
}
