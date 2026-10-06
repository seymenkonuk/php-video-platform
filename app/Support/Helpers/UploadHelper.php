<?php
// ============================================================================
// File:    UploadHelper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Helpers;


use Seymenkonuk\Framework\Http\UploadedFile\IUploadedFile;


class UploadHelper
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected PathHelper $pathHelper,
    ) {}

    // --------------------------------------------------------------------------
    // METHODS
    // --------------------------------------------------------------------------

    public function move(
        IUploadedFile $file,
        string $uploaderCode,
        string $directory,
        string $fileName,
    ): string {
        // Dosyayı taşı ve göreceli yolu döndür
        $rootPath = date("Y/m/d") . "/{$uploaderCode}/{$directory}";
        $file->move($this->pathHelper->uploads($rootPath), $fileName);
        return $rootPath . "/" . $fileName;
    }
}
