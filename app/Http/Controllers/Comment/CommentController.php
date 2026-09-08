<?php
// ============================================================================
// File:    CommentController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Comment;


use Seymenkonuk\Framework\Attribute\Auth\Authenticated;
use Seymenkonuk\Framework\Attribute\Middleware;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Http\Middlewares\ComponentResponseMiddleware;
use App\Http\Schemas\Comment\Index\CreateSchema;
use App\Http\Schemas\Comment\Index\DeleteSchema;
use App\Http\Schemas\Comment\Index\EditSchema;


#[Prefix("/comments")]
#[Authenticated]
class CommentController extends Controller
{
    #[Post("/")]
    #[Middleware(ComponentResponseMiddleware::class)]
    #[Schema(CreateSchema::class)]
    public function Create(IResponse $response): IResponse
    {
        return $response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{commentCode}/edit")]
    #[Middleware(ComponentResponseMiddleware::class)]
    #[Schema(EditSchema::class)]
    public function Edit(IResponse $response): IResponse
    {
        return $response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{commentCode}/delete")]
    #[Middleware(ComponentResponseMiddleware::class)]
    #[Schema(DeleteSchema::class)]
    public function Delete(IResponse $response): IResponse
    {
        return $response->html("<div></div>");
    }
}
