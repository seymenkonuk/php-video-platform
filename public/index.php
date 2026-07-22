<?php
// ============================================================================
// File:    index.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .  "vendor" . DIRECTORY_SEPARATOR . "autoload.php");


use Routes\RouteConfig;

use Seymenkonuk\Framework\Application;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Exception\AuthorizationException;
use Seymenkonuk\Framework\Exception\FileNotFoundException;
use Seymenkonuk\Framework\Exception\RouteNotFoundException;
use Seymenkonuk\Framework\Exception\ValidationException;

use App\Support\ViewModels\ErrorViewModel;


Application::configure(dirname(__DIR__) . DIRECTORY_SEPARATOR . "app")
    ->withRouting(RouteConfig::class)
    ->withDbConfig(
        getenv("DB_HOST"),
        getenv("DB_PORT"),
        getenv("DB_DATABASE"),
        getenv("DB_CHARSET"),
        getenv("DB_USERNAME"),
        getenv("DB_PASSWORD"),
    )
    ->withException(function (ValidationException $exception, Response $response) {
        return $response->abort(400, [
            "model" => new ErrorViewModel("Layouts/App", (array) new \App\Support\ViewProps\Layouts\AppViewProp(
                brandName: getenv("APP_NAME"),
                title: "Geçersiz İstek",
                description: null,
                csrfToken: "",
                search: "",
                activeNav: null,
                navMenus: [],
                dateYear: date("Y"),
                auth: null,
            )),
        ]);
    })
    ->withException(function (AuthorizationException $exception, Response $response) {
        return $response->abort(403, [
            "model" => new ErrorViewModel("Layouts/App", (array) new \App\Support\ViewProps\Layouts\AppViewProp(
                brandName: getenv("APP_NAME"),
                title: "Erişim Reddedildi",
                description: null,
                csrfToken: "",
                search: "",
                activeNav: null,
                navMenus: [],
                dateYear: date("Y"),
                auth: null,
            )),
        ]);
    })
    ->withException(function (RouteNotFoundException|FileNotFoundException $exception, Response $response) {
        return $response->abort(404, [
            "model" => new ErrorViewModel("Layouts/App", (array) new \App\Support\ViewProps\Layouts\AppViewProp(
                brandName: getenv("APP_NAME"),
                title: "Sayfa Bulunamadı",
                description: null,
                csrfToken: "",
                search: "",
                activeNav: null,
                navMenus: [],
                dateYear: date("Y"),
                auth: null,
            )),
        ]);
    })
    ->withException(function (Throwable $exception, Response $response) {
        return $response->abort(500, [
            "model" => new ErrorViewModel("Layouts/App", (array) new \App\Support\ViewProps\Layouts\AppViewProp(
                brandName: getenv("APP_NAME"),
                title: "Sunucu Hatası",
                description: null,
                csrfToken: "",
                search: "",
                activeNav: null,
                navMenus: [],
                dateYear: date("Y"),
                auth: null,
            )),
        ]);
    })
    ->run();
