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
    public function root(string ...$paths): string
    {
        return $this->path(
            dirname(__DIR__, 3),
            ...$paths,
        );
    }

    public function app(string ...$paths): string
    {
        return $this->path(
            $this->root("app"),
            ...$paths,
        );
    }

    public function bootstrap(string ...$paths): string
    {
        return $this->path(
            $this->root("bootstrap"),
            ...$paths,
        );
    }

    public function config(string ...$paths): string
    {
        return $this->path(
            $this->root("config"),
            ...$paths,
        );
    }

    public function database(string ...$paths): string
    {
        return $this->path(
            $this->root("database"),
            ...$paths,
        );
    }

    public function docker(string ...$paths): string
    {
        return $this->path(
            $this->root("database"),
            ...$paths,
        );
    }

    public function public(string ...$paths): string
    {
        return $this->path(
            $this->root("public"),
            ...$paths,
        );
    }

    public function routes(string ...$paths): string
    {
        return $this->path(
            $this->root("routes"),
            ...$paths,
        );
    }

    public function storage(string ...$paths): string
    {
        return $this->path(
            $this->root("storage"),
            ...$paths,
        );
    }

    public function tests(string ...$paths): string
    {
        return $this->path(
            $this->root("tests"),
            ...$paths,
        );
    }

    public function path(string $root, string ...$paths): string
    {
        if ($paths) {
            return $root . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $paths);
        }
        return $root;
    }
}
