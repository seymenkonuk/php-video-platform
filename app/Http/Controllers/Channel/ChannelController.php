<?php
// ============================================================================
// File:    ChannelController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Channel;


use App\Http\Schemas\Channel\Index\IndexPageSchema;
use App\Http\Schemas\Channel\Index\HomePageSchema;
use App\Http\Schemas\Channel\Index\VideosPageSchema;
use App\Http\Schemas\Channel\Index\ShortsPageSchema;
use App\Http\Schemas\Channel\Index\MusicsPageSchema;
use App\Http\Schemas\Channel\Index\PlaylistsPageSchema;
use App\Http\Schemas\Channel\Index\SubscriptionsPageSchema;
use App\Http\Schemas\Channel\Index\DetailsPageSchema;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;


#[Prefix("/channels")]
class ChannelController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/{channelCode}")]
    #[Schema(HomePageSchema::class)]
    public function HomePage(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/{channelCode}/videos")]
    #[Schema(VideosPageSchema::class)]
    public function VideosPage(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/{channelCode}/shorts")]
    #[Schema(ShortsPageSchema::class)]
    public function ShortsPage(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/{channelCode}/musics")]
    #[Schema(MusicsPageSchema::class)]
    public function MusicsPage(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/{channelCode}/playlists")]
    #[Schema(PlaylistsPageSchema::class)]
    public function PlaylistsPage(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/{channelCode}/subscriptions")]
    #[Schema(SubscriptionsPageSchema::class)]
    public function SubscriptionsPage(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/{channelCode}/details")]
    #[Schema(DetailsPageSchema::class)]
    public function DetailsPage(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
