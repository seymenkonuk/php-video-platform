<?php
// ============================================================================
// File:    CommentInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Comment;


use Seymenkonuk\Framework\Attribute\Middleware;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Http\Middlewares\ComponentResponseMiddleware;
use App\Http\Schemas\Comment\Interaction\DislikeSchema;
use App\Http\Schemas\Comment\Interaction\LikeSchema;


#[Prefix("/comments")]
class CommentInteractionController extends Controller
{
    #[Post("/{commentCode}/like")]
    #[Schema(LikeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Like(IResponse $response): IResponse
    {
        return $response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{commentCode}/dislike")]
    #[Schema(DislikeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Dislike(IResponse $response): IResponse
    {
        return $response->html("<p>VideoPlatform</p>");
    }
}
