<?php
// ============================================================================
// File:    ChangeBannerSchema.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Schemas\Studio\Playlist;


use Seymenkonuk\Framework\Schema;

use Seymenkonuk\Validator\Validator\ObjectValidator;

use App\Support\Helpers\FileValidationHelper;

use Config\ValidationConfig;


class ChangeBannerSchema extends Schema
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
                ->make()
                ->required(),
        ]);
    }
}
