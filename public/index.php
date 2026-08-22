<?php
// ============================================================================
// File:    index.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .  "vendor" . DIRECTORY_SEPARATOR . "autoload.php");


use Seymenkonuk\Framework\Application;
use Seymenkonuk\Framework\Auth\IAuthService;
use Seymenkonuk\Framework\Cache\ICache;
use Seymenkonuk\Framework\Cache\RedisCache;
use Seymenkonuk\Framework\CsrfToken\ICsrfTokenManager;
use Seymenkonuk\Framework\CsrfToken\SessionCsrfTokenManager;
use Seymenkonuk\Framework\Database\Connection\ISqlConnection;
use Seymenkonuk\Framework\Database\Connection\MysqlConnection;
use Seymenkonuk\Framework\Exception\FileNotFoundException;
use Seymenkonuk\Framework\Exception\RouteNotFoundException;
use Seymenkonuk\Framework\Exception\ValidationException;
use Seymenkonuk\Framework\Flash\IFlash;
use Seymenkonuk\Framework\Flash\SessionFlash;
use Seymenkonuk\Framework\Http\Exception\AuthorizationException;
use Seymenkonuk\Framework\Http\Request\Request;
use Seymenkonuk\Framework\Http\Response\IResponse;
use Seymenkonuk\Framework\Session\ISession;
use Seymenkonuk\Framework\Session\PhpSession;
use Seymenkonuk\Framework\TemplateEngine\ITemplateEngine;
use Seymenkonuk\Framework\TemplateEngine\PlatesTemplateEngine;

use Seymenkonuk\Validator\Localization\FileLoader;
use Seymenkonuk\Validator\Localization\Translator;
use Seymenkonuk\Validator\Validator\Validator;

use App\Domain\Services\AuthService;
use App\Support\Factories\ErrorViewModelFactory;

use Routes\WebRoutes;


$app = new Application();

$app->withRouting(WebRoutes::class)
    ->withBindings([
        IAuthService::class => AuthService::class,
        ICache::class => RedisCache::class,
        ICsrfTokenManager::class => SessionCsrfTokenManager::class,
        IFlash::class => SessionFlash::class,
        ISession::class => PhpSession::class,
        ISqlConnection::class => MysqlConnection::class,
        ITemplateEngine::class => PlatesTemplateEngine::class,
    ])
    ->withSingletons([
        RedisCache::class => function () {
            return new RedisCache(
                getenv("REDIS_HOST"),
                getenv("REDIS_PORT"),
                getenv("REDIS_PASSWORD"),
            );
        },
        MysqlConnection::class => function () {
            return new MysqlConnection(
                getenv("DB_HOST"),
                getenv("DB_PORT"),
                getenv("DB_DATABASE"),
                getenv("DB_CHARSET"),
                getenv("DB_USERNAME"),
                getenv("DB_PASSWORD"),
            );
        },
        PlatesTemplateEngine::class => function () {
            return new PlatesTemplateEngine(dirname(__DIR__) . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "Views");
        },
        Validator::class => function () {
            return new Validator(new Translator(
                new FileLoader(),
                "tr",
            ));
        }
    ])
    ->withException(function (ValidationException $exception, Request $request, IFlash $flash, IResponse $response, ErrorViewModelFactory $errorViewModelFactory) {
        // POST isteklerinde; 
        // Hataları Flash'a Ekle
        // GET sayfasına yönlendir (PRG: Post Redirect Get)
        if ($request->method() === "POST") {
            $flash->set("errors", $exception->errors());
            $flash->set("values", $request->all());
            $response->redirect($request->path());
        }
        // Tüm İsteklerde Abort 400
        return $response->abort(400, [
            "model" => $errorViewModelFactory->badRequest(),
        ]);
    })
    ->withException(function (AuthorizationException $exception, IResponse $response, ErrorViewModelFactory $errorViewModelFactory) {
        return $response->abort(403, [
            "model" => $errorViewModelFactory->unauthorized(),
        ]);
    })
    ->withException(function (RouteNotFoundException|FileNotFoundException $exception, IResponse $response, ErrorViewModelFactory $errorViewModelFactory) {
        return $response->abort(404, [
            "model" => $errorViewModelFactory->notFound(),
        ]);
    })
    ->withException(function (Throwable $exception, IResponse $response, ErrorViewModelFactory $errorViewModelFactory) {
        return $response->abort(500, [
            "model" => $errorViewModelFactory->serverError(),
        ]);
    })
    ->run(Request::capture());
