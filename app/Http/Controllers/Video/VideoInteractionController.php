<?php
// ============================================================================
// File:    VideoInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Video;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;


#[Prefix("/videos")]
class VideoInteractionController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Post("/{videoCode}/like")]
    public function Like(string $videoCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{videoCode}/disslike")]
    public function Dislike(string $videoCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{videoCode}/watch-later")]
    public function AddWatchLater(string $videoCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
