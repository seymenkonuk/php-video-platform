<?php
// ============================================================================
// File:    index.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .  "vendor" . DIRECTORY_SEPARATOR . "autoload.php");


use Seymenkonuk\Framework\Application;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Exception\AuthorizationException;
use Seymenkonuk\Framework\Exception\FileNotFoundException;
use Seymenkonuk\Framework\Exception\RouteNotFoundException;
use Seymenkonuk\Framework\Exception\ValidationException;

use App\Support\Factories\ErrorViewModelFactory;

use Routes\RouteConfig;


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
    ->withException(function (ValidationException $exception, Response $response, ErrorViewModelFactory $errorViewModelFactory) {
        return $response->abort(400, [
            "model" => $errorViewModelFactory->badRequest(),
        ]);
    })
    ->withException(function (AuthorizationException $exception, Response $response, ErrorViewModelFactory $errorViewModelFactory) {
        return $response->abort(403, [
            "model" => $errorViewModelFactory->unauthorized(),
        ]);
    })
    ->withException(function (RouteNotFoundException|FileNotFoundException $exception, Response $response, ErrorViewModelFactory $errorViewModelFactory) {
        return $response->abort(404, [
            "model" => $errorViewModelFactory->notFound(),
        ]);
    })
    ->withException(function (Throwable $exception, Response $response, ErrorViewModelFactory $errorViewModelFactory) {
        return $response->abort(500, [
            "model" => $errorViewModelFactory->serverError(),
        ]);
    })
    ->run();
