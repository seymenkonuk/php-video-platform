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
    public function storage(): string
    {
        return dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . "storage";
    }

    public function cache(): string
    {
        return $this->storage() . DIRECTORY_SEPARATOR . "cache";
    }

    public function logs(): string
    {
        return $this->storage() . DIRECTORY_SEPARATOR . "logs";
    }

    public function sessions(): string
    {
        return $this->storage() . DIRECTORY_SEPARATOR . "sessions";
    }

    public function temp(): string
    {
        return $this->storage() . DIRECTORY_SEPARATOR . "temp";
    }

    public function uploads(): string
    {
        return $this->storage() . DIRECTORY_SEPARATOR . "uploads";
    }

    public function app(): string
    {
        return $this->storage() . DIRECTORY_SEPARATOR . "app";
    }

    public function public(): string
    {
        return $this->app() . DIRECTORY_SEPARATOR . "public";
    }

    public function private(): string
    {
        return $this->app() . DIRECTORY_SEPARATOR . "private";
    }
}
