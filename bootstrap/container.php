<?php
// ============================================================================
// File:    container.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================


use Seymenkonuk\Framework\Application;
use Seymenkonuk\Framework\Auth\IAuthService;
use Seymenkonuk\Framework\Cache\ICache;
use Seymenkonuk\Framework\Cache\RedisCache;
use Seymenkonuk\Framework\CsrfToken\ICsrfTokenManager;
use Seymenkonuk\Framework\CsrfToken\SessionCsrfTokenManager;
use Seymenkonuk\Framework\Database\Connection\ISqlConnection;
use Seymenkonuk\Framework\Database\Connection\MysqlConnection;
use Seymenkonuk\Framework\Flash\IFlash;
use Seymenkonuk\Framework\Flash\SessionFlash;
use Seymenkonuk\Framework\Session\ISession;
use Seymenkonuk\Framework\Session\PhpSession;
use Seymenkonuk\Framework\TemplateEngine\ITemplateEngine;
use Seymenkonuk\Framework\TemplateEngine\PlatesTemplateEngine;

use Seymenkonuk\Validator\Localization\FileLoader;
use Seymenkonuk\Validator\Localization\Translator;
use Seymenkonuk\Validator\Validator\Validator;

use App\Domain\Services\AuthService;


return function (Application $app) {
    $app->withBindings([
        IAuthService::class => AuthService::class,
        ICache::class => RedisCache::class,
        ICsrfTokenManager::class => SessionCsrfTokenManager::class,
        IFlash::class => SessionFlash::class,
        ISession::class => PhpSession::class,
        ISqlConnection::class => MysqlConnection::class,
        ITemplateEngine::class => PlatesTemplateEngine::class,
    ]);

    $app->withSingletons([
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
            return new PlatesTemplateEngine(dirname(__DIR__) . "/app/Views");
        },
        Validator::class => function () {
            return new Validator(new Translator(
                new FileLoader(),
                "tr",
            ));
        }
    ]);
};
