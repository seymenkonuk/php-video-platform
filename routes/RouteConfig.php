<?php
// ============================================================================
// File:    index.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Routes;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OfflineController;
use App\Http\Controllers\PingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UploadController;

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Playlist\PlaylistController;
use App\Http\Controllers\Playlist\PlaylistInteractionController;
use App\Http\Controllers\Channel\ChannelController;
use App\Http\Controllers\Channel\ChannelInteractionController;
use App\Http\Controllers\Video\VideoController;
use App\Http\Controllers\Video\VideoInteractionController;
use App\Http\Controllers\Short\ShortController;
use App\Http\Controllers\Short\ShortInteractionController;
use App\Http\Controllers\Music\MusicController;
use App\Http\Controllers\Music\MusicInteractionController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Comment\CommentInteractionController;

use App\Http\Controllers\Studio\DashboardController as StudioDashboardController;
use App\Http\Controllers\Studio\UserController as StudioUserController;
use App\Http\Controllers\Studio\ChannelController as StudioChannelController;
use App\Http\Controllers\Studio\PlaylistController as StudioPlaylistController;
use App\Http\Controllers\Studio\VideoController as StudioVideoController;
use App\Http\Controllers\Studio\ShortController as StudioShortController;
use App\Http\Controllers\Studio\MusicController as StudioMusicController;

use Seymenkonuk\Framework\Router;


class RouteConfig
{
    public function register(Router $router)
    {
        $router->registerController(AuthController::class);
        $router->registerController(FeedController::class);
        $router->registerController(HomeController::class);
        $router->registerController(NotificationController::class);
        $router->registerController(OfflineController::class);
        $router->registerController(PingController::class);
        $router->registerController(SearchController::class);
        $router->registerController(UploadController::class);
        // 
        $router->registerController(CategoryController::class);
        $router->registerController(PlaylistController::class);
        $router->registerController(PlaylistInteractionController::class);
        $router->registerController(ChannelController::class);
        $router->registerController(ChannelInteractionController::class);
        $router->registerController(VideoController::class);
        $router->registerController(VideoInteractionController::class);
        $router->registerController(ShortController::class);
        $router->registerController(ShortInteractionController::class);
        $router->registerController(MusicController::class);
        $router->registerController(MusicInteractionController::class);
        $router->registerController(CommentController::class);
        $router->registerController(CommentInteractionController::class);
        // Studio
        $router->registerController(StudioDashboardController::class);
        $router->registerController(StudioUserController::class);
        $router->registerController(StudioChannelController::class);
        $router->registerController(StudioPlaylistController::class);
        $router->registerController(StudioVideoController::class);
        $router->registerController(StudioShortController::class);
        $router->registerController(StudioMusicController::class);
    }
}
