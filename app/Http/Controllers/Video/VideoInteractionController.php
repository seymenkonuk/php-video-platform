<?php
// ============================================================================
// File:    VideoInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Video;


use App\Http\Middlewares\ComponentResponseMiddleware;

use App\Http\Schemas\Video\Interaction\LikeSchema;
use App\Http\Schemas\Video\Interaction\DislikeSchema;
use App\Http\Schemas\Video\Interaction\AddWatchLaterSchema;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Middleware;
use Seymenkonuk\Framework\Attribute\Route\Post;


#[Prefix("/videos")]
class VideoInteractionController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Post("/{videoCode}/like")]
    #[Schema(LikeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Like(string $videoCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{videoCode}/dislike")]
    #[Schema(DislikeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Dislike(string $videoCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{videoCode}/watch-later")]
    #[Schema(AddWatchLaterSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function AddWatchLater(string $videoCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
