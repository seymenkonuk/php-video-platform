<?php
// ============================================================================
// File:    container.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================


use Seymenkonuk\Framework\Application;
use Seymenkonuk\Framework\Auth\IAuthService as IFrameworkAuthService;
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

use App\Domain\Repositories\Abstract\ICategoryRepository;
use App\Domain\Repositories\Abstract\IChannelRepository;
use App\Domain\Repositories\Abstract\IMusicRepository;
use App\Domain\Repositories\Abstract\IPlaylistRepository;
use App\Domain\Repositories\Abstract\IShortRepository;
use App\Domain\Repositories\Abstract\IUserRepository;
use App\Domain\Repositories\Abstract\IVideoRepository;
use App\Domain\Repositories\Sql\CategoryRepository;
use App\Domain\Repositories\Sql\ChannelRepository;
use App\Domain\Repositories\Sql\MusicRepository;
use App\Domain\Repositories\Sql\PlaylistRepository;
use App\Domain\Repositories\Sql\ShortRepository;
use App\Domain\Repositories\Sql\UserRepository;
use App\Domain\Repositories\Sql\VideoRepository;
use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\ICategoryService;
use App\Domain\Services\Abstract\IChannelService;
use App\Domain\Services\Abstract\IFeedService;
use App\Domain\Services\Abstract\IMusicService;
use App\Domain\Services\Abstract\IPlaylistService;
use App\Domain\Services\Abstract\IShortService;
use App\Domain\Services\Abstract\IVideoService;
use App\Domain\Services\Concrete\AuthService;
use App\Domain\Services\Concrete\CategoryService;
use App\Domain\Services\Concrete\ChannelService;
use App\Domain\Services\Concrete\FeedService;
use App\Domain\Services\Concrete\MusicService;
use App\Domain\Services\Concrete\PlaylistService;
use App\Domain\Services\Concrete\ShortService;
use App\Domain\Services\Concrete\VideoService;


return function (Application $app) {
    // Framework ile İlgili Binding'ler
    $app->withBindings([
        IFrameworkAuthService::class => IAuthService::class,
        ICache::class => RedisCache::class,
        ICsrfTokenManager::class => SessionCsrfTokenManager::class,
        IFlash::class => SessionFlash::class,
        ISession::class => PhpSession::class,
        ISqlConnection::class => MysqlConnection::class,
        ITemplateEngine::class => PlatesTemplateEngine::class,
    ]);
    // Servis Binding'leri
    $app->withBindings([
        IAuthService::class => AuthService::class,
        ICategoryService::class => CategoryService::class,
        IChannelService::class => ChannelService::class,
        IFeedService::class => FeedService::class,
        IMusicService::class => MusicService::class,
        IPlaylistService::class => PlaylistService::class,
        IShortService::class => ShortService::class,
        IVideoService::class => VideoService::class,
    ]);
    // Repository Binding'leri
    $app->withBindings([
        ICategoryRepository::class => CategoryRepository::class,
        IChannelRepository::class => ChannelRepository::class,
        IMusicRepository::class => MusicRepository::class,
        IPlaylistRepository::class => PlaylistRepository::class,
        IShortRepository::class => ShortRepository::class,
        IUserRepository::class => UserRepository::class,
        IVideoRepository::class => VideoRepository::class,
    ]);
    // Singleton'lar
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
