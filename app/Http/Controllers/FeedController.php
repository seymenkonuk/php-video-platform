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

use App\Support\DTOs\Library\WatchLaterHeaderDTO;
use App\Support\DTOs\Library\HistoryHeaderDTO;
use App\Support\DTOs\Library\LikedHeaderDTO;
use App\Support\DTOs\UI\PaginationDTO;

use App\Support\ViewModels\Feed\IndexPageViewModel;
use App\Support\ViewModels\Feed\ChannelsPageViewModel;
use App\Support\ViewModels\Feed\SubscriptionsPageViewModel;
use App\Support\ViewModels\Feed\CommentsPageViewModel;
use App\Support\ViewModels\Feed\PlaylistsPageViewModel;
use App\Support\ViewModels\Feed\WatchLaterPageViewModel;
use App\Support\ViewModels\Feed\HistoryPageViewModel;
use App\Support\ViewModels\Feed\LikedPageViewModel;

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
        return $this->response->view("/feed/index", [
            "model" => new IndexPageViewModel(),
        ]);
    }

    #[Get("/channels")]
    #[Schema(ChannelsPageSchema::class)]
    public function ChannelsPage(): Response
    {
        return $this->response->view("/feed/channels/index", [
            "model" => new ChannelsPageViewModel((function () {
                yield from [];
            })(), new PaginationDTO(1, 1, 0, 0, 0))
        ]);
    }

    #[Get("/subscriptions")]
    #[Schema(SubscriptionsPageSchema::class)]
    public function SubscriptionsPage(): Response
    {
        return $this->response->view("/feed/subscriptions/index", [
            "model" => new SubscriptionsPageViewModel((function () {
                yield from [];
            })(), new PaginationDTO(1, 1, 0, 0, 0))
        ]);
    }

    #[Get("/comments")]
    #[Schema(CommentsPageSchema::class)]
    public function CommentsPage(): Response
    {
        return $this->response->view("/feed/comments/index", [
            "model" => new CommentsPageViewModel((function () {
                yield from [];
            })(), new PaginationDTO(1, 1, 0, 0, 0))
        ]);
    }

    #[Get("/playlists")]
    #[Schema(PlaylistsPageSchema::class)]
    public function PlaylistsPage(): Response
    {
        return $this->response->view("/feed/playlists/index", [
            "model" => new PlaylistsPageViewModel((function () {
                yield from [];
            })(), new PaginationDTO(1, 1, 0, 0, 0))
        ]);
    }

    #[Get("/watch-later")]
    #[Schema(WatchLaterPageSchema::class)]
    public function WatchLaterPage(): Response
    {
        return $this->response->view("/feed/watch-later/index", [
            "model" => new WatchLaterPageViewModel(
                new WatchLaterHeaderDTO(0, "0", 0, "0sn"),
                (function () {
                    yield from [];
                })(),
                new PaginationDTO(1, 1, 0, 0, 0),
            )
        ]);
    }

    #[Get("/history")]
    #[Schema(HistoryPageSchema::class)]
    public function HistoryPage(): Response
    {
        return $this->response->view("/feed/history/index", [
            "model" => new HistoryPageViewModel(
                new HistoryHeaderDTO(0, "0", 0, "0sn"),
                (function () {
                    yield from [];
                })(),
                new PaginationDTO(1, 1, 0, 0, 0),
            )
        ]);
    }

    #[Get("/liked")]
    #[Schema(LikedPageSchema::class)]
    public function LikedPage(): Response
    {
        return $this->response->view("/feed/liked/index", [
            "model" => new LikedPageViewModel(
                new LikedHeaderDTO(0, "0", 0, "0sn"),
                (function () {
                    yield from [];
                })(),
                new PaginationDTO(1, 1, 0, 0, 0),
            )
        ]);
    }
}
