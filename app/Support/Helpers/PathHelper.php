<?php
// ============================================================================
// File:    PathHelper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Helpers;


class PathHelper
{
    public function storage(?string $filename = null): string
    {
        return $this->path(
            dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . "storage",
            $filename,
        );
    }

    public function cache(?string $filename = null): string
    {
        return $this->path(
            $this->storage() . DIRECTORY_SEPARATOR . "cache",
            $filename,
        );
    }

    public function logs(?string $filename = null): string
    {
        return $this->path(
            $this->storage() . DIRECTORY_SEPARATOR . "logs",
            $filename,
        );
    }

    public function sessions(?string $filename = null): string
    {
        return $this->path(
            $this->storage() . DIRECTORY_SEPARATOR . "sessions",
            $filename,
        );
    }

    public function temp(?string $filename = null): string
    {
        return $this->path(
            $this->storage() . DIRECTORY_SEPARATOR . "temp",
            $filename,
        );
    }

    public function uploads(?string $filename = null): string
    {
        return $this->path(
            $this->storage() . DIRECTORY_SEPARATOR . "uploads",
            $filename,
        );
    }

    public function app(?string $filename = null): string
    {
        return $this->path(
            $this->storage() . DIRECTORY_SEPARATOR . "app",
            $filename,
        );
    }

    public function public(?string $filename = null): string
    {
        return $this->path(
            $this->app() . DIRECTORY_SEPARATOR . "public",
            $filename,
        );
    }

    public function private(?string $filename = null): string
    {
        return $this->path(
            $this->app() . DIRECTORY_SEPARATOR . "private",
            $filename,
        );
    }

    private function path(string $directory, ?string $filename = null): string
    {
        if ($filename !== null) {
            return $directory . DIRECTORY_SEPARATOR . $filename;
        }
        return $directory;
    }
}
