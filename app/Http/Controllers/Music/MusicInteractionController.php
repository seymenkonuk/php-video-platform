<?php
// ============================================================================
// File:    MusicInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Music;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;


#[Prefix("/musics")]
class MusicInteractionController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Post("/{musicCode}/like")]
    public function Like(string $musicCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{musicCode}/disslike")]
    public function Dislike(string $musicCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{musicCode}/watch-later")]
    public function AddWatchLater(string $musicCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
