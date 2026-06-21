<?php
// ============================================================================
// File:    CommentController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Comment;


use App\Http\Schemas\Comment\Index\CreateSchema;
use App\Http\Schemas\Comment\Index\EditSchema;
use App\Http\Schemas\Comment\Index\DeleteSchema;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;


#[Prefix("/comments")]
class CommentController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Post("/")]
    #[Schema(CreateSchema::class)]
    public function Create(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{commentCode}/edit")]
    #[Schema(EditSchema::class)]
    public function Edit(string $commentCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{commentCode}/delete")]
    #[Schema(DeleteSchema::class)]
    public function Delete(string $commentCode): Response
    {
        return $this->response->redirect("/");
    }
}
