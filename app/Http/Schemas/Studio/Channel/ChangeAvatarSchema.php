<?php
// ============================================================================
// File:    ChangeAvatarSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Studio\Channel;


use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;

use Config\ValidationConfig;


class ChangeAvatarSchema extends Schema
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

    public function files(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "avatar" => $this->validator->field()
                ->file()
                ->mimes(ValidationConfig::ALLOWED_AVATAR_MIME_TYPES)
                ->extensions(ValidationConfig::ALLOWED_AVATAR_EXTENSIONS)
                ->min(ValidationConfig::AVATAR_MIN_FILE_SIZE)
                ->max(ValidationConfig::AVATAR_MAX_FILE_SIZE)
                ->required(),
        ]);
    }
}
