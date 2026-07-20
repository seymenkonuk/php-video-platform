<?php
// ============================================================================
// File:    MusicInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Music;


use App\Http\Middlewares\ComponentResponseMiddleware;

use App\Http\Schemas\Music\Interaction\LikeSchema;
use App\Http\Schemas\Music\Interaction\DislikeSchema;
use App\Http\Schemas\Music\Interaction\AddWatchLaterSchema;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Middleware;
use Seymenkonuk\Framework\Attribute\Route\Post;


#[Prefix("/musics")]
class MusicInteractionController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Post("/{musicCode}/like")]
    #[Schema(LikeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Like(string $musicCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{musicCode}/dislike")]
    #[Schema(DislikeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Dislike(string $musicCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{musicCode}/watch-later")]
    #[Schema(AddWatchLaterSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function AddWatchLater(string $musicCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
