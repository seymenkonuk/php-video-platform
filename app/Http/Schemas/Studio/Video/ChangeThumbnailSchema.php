<?php
// ============================================================================
// File:    ChangeThumbnailSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Studio\Video;


use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;

use App\Support\Helpers\FileValidationHelper;

use Config\ValidationConfig;


class ChangeThumbnailSchema extends Schema
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
            "videoCode" => $this->validator->field()
                ->string()
                ->required(),
        ]);
    }

    public function files(): ObjectValidator
    {
        return $this->validator->object()->schema([
            "thumbnail" => FileValidationHelper::config($this->validator)
                ->mimes(ValidationConfig::ALLOWED_THUMBNAIL_MIME_TYPES)
                ->extension(ValidationConfig::ALLOWED_THUMBNAIL_EXTENSIONS)
                ->min(ValidationConfig::THUMBNAIL_MIN_FILE_SIZE)
                ->max(ValidationConfig::THUMBNAIL_MAX_FILE_SIZE)
                ->make()
                ->required(),
        ]);
    }
}
