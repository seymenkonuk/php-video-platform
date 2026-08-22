<?php
// ============================================================================
// File:    MusicInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Music;


use Seymenkonuk\Framework\Attribute\Middleware;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Http\Middlewares\ComponentResponseMiddleware;
use App\Http\Schemas\Music\Interaction\AddWatchLaterSchema;
use App\Http\Schemas\Music\Interaction\DislikeSchema;
use App\Http\Schemas\Music\Interaction\LikeSchema;


#[Prefix("/musics")]
class MusicInteractionController extends Controller
{
    #[Post("/{musicCode}/like")]
    #[Schema(LikeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Like(IResponse $response): IResponse
    {
        return $response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{musicCode}/dislike")]
    #[Schema(DislikeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Dislike(IResponse $response): IResponse
    {
        return $response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{musicCode}/watch-later")]
    #[Schema(AddWatchLaterSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function AddWatchLater(IResponse $response): IResponse
    {
        return $response->html("<p>VideoPlatform</p>");
    }
}
