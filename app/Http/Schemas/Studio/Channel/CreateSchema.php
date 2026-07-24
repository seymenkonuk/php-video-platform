<?php
// ============================================================================
// File:    CreateSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Studio\Channel;


use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;

use App\Support\Helpers\FileValidationHelper;

use Config\ValidationConfig;


class CreateSchema extends Schema
{
    public function body(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "name" => $this->validator->field()
                ->string()
                ->min(ValidationConfig::USERNAME_MIN_LEN)
                ->max(ValidationConfig::USERNAME_MAX_LEN)
                ->regex(ValidationConfig::USERNAME_REGEX_RULE, ValidationConfig::USERNAME_REGEX_ERROR)
                ->required(),
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
            "linkedinUrl" => $this->validator->field()
                ->path(),
            "githubUrl" => $this->validator->field()
                ->path(),
            "instagramUrl" => $this->validator->field()
                ->path(),
            "twitterUrl" => $this->validator->field()
                ->path(),
            "facebookUrl" => $this->validator->field()
                ->path(),
            "csrfToken" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }

    public function files(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "avatar" => FileValidationHelper::config($this->validator)
                ->mimes(ValidationConfig::ALLOWED_AVATAR_MIME_TYPES)
                ->extension(ValidationConfig::ALLOWED_AVATAR_EXTENSIONS)
                ->min(ValidationConfig::AVATAR_MIN_FILE_SIZE)
                ->max(ValidationConfig::AVATAR_MAX_FILE_SIZE)
                ->make(),
            "banner" => FileValidationHelper::config($this->validator)
                ->mimes(ValidationConfig::ALLOWED_BANNER_MIME_TYPES)
                ->extension(ValidationConfig::ALLOWED_BANNER_EXTENSIONS)
                ->min(ValidationConfig::BANNER_MIN_FILE_SIZE)
                ->max(ValidationConfig::BANNER_MAX_FILE_SIZE)
                ->make(),
        ]);
    }
}
