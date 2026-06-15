<?php
// ============================================================================
// File:    ShortInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Short;


use App\Http\Schemas\Short\Interaction\LikeSchema;
use App\Http\Schemas\Short\Interaction\DislikeSchema;
use App\Http\Schemas\Short\Interaction\AddWatchLaterSchema;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;


#[Prefix("/shorts")]
class ShortInteractionController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Post("/{shortCode}/like")]
    #[Schema(LikeSchema::class)]
    public function Like(string $shortCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{shortCode}/dislike")]
    #[Schema(DislikeSchema::class)]
    public function Dislike(string $shortCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{shortCode}/watch-later")]
    #[Schema(AddWatchLaterSchema::class)]
    public function AddWatchLater(string $shortCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
