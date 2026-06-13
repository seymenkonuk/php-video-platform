<?php
// ============================================================================
// File:    ExampleSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas;


use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;
use Seymenkonuk\Validator\Validator\Validator;


class ExampleSchema extends Schema
{
    public function __construct(
        protected Validator $validator
    ) {
        parent::__construct($validator);
    }

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

    /**
     * @return array{
     *      title: string,
     *      description: string
     * }|null
     */
    public function authorize(): array|null
    {
        return null;
    }
}
