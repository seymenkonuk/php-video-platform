<?php
// ============================================================================
// File:    CommentInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Comment;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;


#[Prefix("/comments")]
class CommentInteractionController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Post("/{commentCode}/like")]
    public function Like(string $commentCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{commentCode}/disslike")]
    public function Dislike(string $commentCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
