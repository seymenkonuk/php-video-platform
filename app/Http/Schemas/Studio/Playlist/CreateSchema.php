<?php
// ============================================================================
// File:    CreateSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Studio\Playlist;


use Config\ValidationConfig;

use App\Support\Helpers\FileValidationHelper;

use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;


class CreateSchema extends Schema
{
    public function body(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "title" => $this->validator->field()
                ->string()
                ->min(ValidationConfig::TITLE_MIN_LEN)
                ->max(ValidationConfig::TITLE_MAX_LEN)
                ->regex(ValidationConfig::TITLE_REGEX_RULE, ValidationConfig::TITLE_REGEX_ERROR)
                ->required(),
            "description" => $this->validator->field()
                ->string()
                ->min(ValidationConfig::DESC_MIN_LEN)
                ->max(ValidationConfig::DESC_MAX_LEN)
                ->regex(ValidationConfig::DESC_REGEX_RULE, ValidationConfig::DESC_REGEX_ERROR),
            "viewType" => $this->validator->field()
                ->in(ValidationConfig::VIEW_TYPES)
                ->required(),
            "csrfToken" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }

    public function params(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "playlistCode" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }

    public function files(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "banner" => FileValidationHelper::config($this->validator)
                ->mimes(ValidationConfig::ALLOWED_BANNER_MIME_TYPES)
                ->extension(ValidationConfig::ALLOWED_BANNER_EXTENSIONS)
                ->min(ValidationConfig::BANNER_MIN_FILE_SIZE)
                ->max(ValidationConfig::BANNER_MAX_FILE_SIZE)
                ->make(),
        ]);
    }
}
