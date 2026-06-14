<?php
// ============================================================================
// File:    FeedController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;


#[Prefix("/feed")]
class FeedController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Get("/")]
    public function IndexPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/channels")]
    public function ChannelsPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/subscriptions")]
    public function SubscriptionsPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/comments")]
    public function CommentsPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/playlists")]
    public function PlaylistsPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/watch-later")]
    public function WatchLaterPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/history")]
    public function HistoryPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/liked")]
    public function LikedPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
