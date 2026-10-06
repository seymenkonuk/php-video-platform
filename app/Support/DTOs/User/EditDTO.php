<?php
// ============================================================================
// File:    EditDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\User;


class EditDTO
{
    public function __construct(
        public string   $name,
        public string   $surname,
        public string   $username,
        public string   $email,
        public string   $country,
    ) {}
}
