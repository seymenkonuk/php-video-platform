<?php
// ============================================================================
// File:    FeedController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use App\Http\Schemas\Feed\IndexPageSchema;
use App\Http\Schemas\Feed\ChannelsPageSchema;
use App\Http\Schemas\Feed\SubscriptionsPageSchema;
use App\Http\Schemas\Feed\CommentsPageSchema;
use App\Http\Schemas\Feed\PlaylistsPageSchema;
use App\Http\Schemas\Feed\WatchLaterPageSchema;
use App\Http\Schemas\Feed\HistoryPageSchema;
use App\Http\Schemas\Feed\LikedPageSchema;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;


#[Prefix("/feed")]
class FeedController extends Controller
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

    #[Get("/channels")]
    #[Schema(ChannelsPageSchema::class)]
    public function ChannelsPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/subscriptions")]
    #[Schema(SubscriptionsPageSchema::class)]
    public function SubscriptionsPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/comments")]
    #[Schema(CommentsPageSchema::class)]
    public function CommentsPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/playlists")]
    #[Schema(PlaylistsPageSchema::class)]
    public function PlaylistsPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/watch-later")]
    #[Schema(WatchLaterPageSchema::class)]
    public function WatchLaterPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/history")]
    #[Schema(HistoryPageSchema::class)]
    public function HistoryPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/liked")]
    #[Schema(LikedPageSchema::class)]
    public function LikedPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
