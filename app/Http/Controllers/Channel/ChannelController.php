<?php
// ============================================================================
// File:    ChannelController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Channel;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;


#[Prefix("/channels")]
class ChannelController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Get("/")]
    public function IndexPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/{channelCode}")]
    public function HomePage(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/{channelCode}/videos")]
    public function VideosPage(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/{channelCode}/shorts")]
    public function ShortsPage(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/{channelCode}/musics")]
    public function MusicsPage(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/{channelCode}/playlists")]
    public function PlaylistsPage(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/{channelCode}/subscriptions")]
    public function SubscriptionsPage(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/{channelCode}/details")]
    public function DetailsPage(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
