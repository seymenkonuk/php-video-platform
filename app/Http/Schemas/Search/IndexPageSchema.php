<?php
// ============================================================================
// File:    IndexPageSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Search;


use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;

use Config\ValidationConfig;


class IndexPageSchema extends Schema
{
    public function query(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "q" => $this->validator->field()
                ->string(),
            "category" => $this->validator->field()
                ->string(),
            "channel" => $this->validator->field()
                ->string(),
            "type" => $this->validator->field()
                ->in(ValidationConfig::CONTENT_TYPE_FILTERS),
            "duration" => $this->validator->field()
                ->in(ValidationConfig::DURATION_FILTERS),
            "sort" => $this->validator->field()
                ->in(ValidationConfig::SORT_FILTERS),
            "date" => $this->validator->field()
                ->in(ValidationConfig::DATE_FILTERS),
            "page" => $this->validator->field()
                ->int(false)
                ->min(1)
                ->default(1),
        ]);
    }
}
