<?php
// ============================================================================
// File:    ShortInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Short;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;


#[Prefix("/shorts")]
class ShortInteractionController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Post("/{shortCode}/like")]
    public function Like(string $shortCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{shortCode}/disslike")]
    public function Dislike(string $shortCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{shortCode}/watch-later")]
    public function AddWatchLater(string $shortCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
