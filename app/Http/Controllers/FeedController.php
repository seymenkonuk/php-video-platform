<?php
// ============================================================================
// File:    FeedController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use Seymenkonuk\Framework\Attribute\Auth\Authenticated;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\IFeedService;

use App\Http\Schemas\Feed\ChannelsPageSchema;
use App\Http\Schemas\Feed\CommentsPageSchema;
use App\Http\Schemas\Feed\HistoryPageSchema;
use App\Http\Schemas\Feed\IndexPageSchema;
use App\Http\Schemas\Feed\LikedPageSchema;
use App\Http\Schemas\Feed\PlaylistsPageSchema;
use App\Http\Schemas\Feed\SubscriptionsPageSchema;
use App\Http\Schemas\Feed\WatchLaterPageSchema;

use App\Support\DTOs\AuthDTO;
use App\Support\Factories\ViewContextFactory;
use App\Support\ViewModels\Feed\ChannelsPageViewModel;
use App\Support\ViewModels\Feed\CommentsPageViewModel;
use App\Support\ViewModels\Feed\HistoryPageViewModel;
use App\Support\ViewModels\Feed\IndexPageViewModel;
use App\Support\ViewModels\Feed\LikedPageViewModel;
use App\Support\ViewModels\Feed\PlaylistsPageViewModel;
use App\Support\ViewModels\Feed\SubscriptionsPageViewModel;
use App\Support\ViewModels\Feed\WatchLaterPageViewModel;


#[Prefix("/feed")]
#[Authenticated]
class FeedController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected IAuthService $authService,
        protected IFeedService $feedService,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(IResponse $response): IResponse
    {
        return $response->view("/feed/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->app(),
            ),
        ]);
    }

    #[Get("/channels")]
    #[Schema(ChannelsPageSchema::class)]
    public function ChannelsPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $page = $request->query("page", 1);
        /** @var AuthDTO */
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->feedService->getChannelsPage($auth, $page);

        // View model döndür
        return $response->view("/feed/channels/index", [
            "model" => new ChannelsPageViewModel(
                context: $this->viewContextFactory->app(),
                channels: $result->channels,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/subscriptions")]
    #[Schema(SubscriptionsPageSchema::class)]
    public function SubscriptionsPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $page = $request->query("page", 1);
        /** @var AuthDTO */
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->feedService->getSubscriptionsPage($auth, $page);

        // View model döndür
        return $response->view("/feed/subscriptions/index", [
            "model" => new SubscriptionsPageViewModel(
                context: $this->viewContextFactory->app(),
                videos: $result->videos,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/comments")]
    #[Schema(CommentsPageSchema::class)]
    public function CommentsPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $page = $request->query("page", 1);
        /** @var AuthDTO */
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->feedService->getCommentsPage($auth, $page);

        // View model döndür
        return $response->view("/feed/comments/index", [
            "model" => new CommentsPageViewModel(
                context: $this->viewContextFactory->app(),
                comments: $result->comments,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/playlists")]
    #[Schema(PlaylistsPageSchema::class)]
    public function PlaylistsPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $page = $request->query("page", 1);
        /** @var AuthDTO */
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->feedService->getPlaylistsPage($auth, $page);

        // View model döndür
        return $response->view("/feed/playlists/index", [
            "model" => new PlaylistsPageViewModel(
                context: $this->viewContextFactory->app(),
                playlists: $result->playlists,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/watch-later")]
    #[Schema(WatchLaterPageSchema::class)]
    public function WatchLaterPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $page = $request->query("page", 1);
        /** @var AuthDTO */
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->feedService->getWatchLaterPage($auth, $page);

        // View model döndür
        return $response->view("/feed/watch-later/index", [
            "model" => new WatchLaterPageViewModel(
                context: $this->viewContextFactory->app(),
                header: $result->header,
                videos: $result->videos,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/history")]
    #[Schema(HistoryPageSchema::class)]
    public function HistoryPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $page = $request->query("page", 1);
        /** @var AuthDTO */
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->feedService->getHistoryPage($auth, $page);

        // View model döndür
        return $response->view("/feed/history/index", [
            "model" => new HistoryPageViewModel(
                context: $this->viewContextFactory->app(),
                header: $result->header,
                videos: $result->videos,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/liked")]
    #[Schema(LikedPageSchema::class)]
    public function LikedPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $page = $request->query("page", 1);
        /** @var AuthDTO */
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->feedService->getLikedPage($auth, $page);

        // View model döndür
        return $response->view("/feed/liked/index", [
            "model" => new LikedPageViewModel(
                context: $this->viewContextFactory->app(),
                header: $result->header,
                videos: $result->videos,
                pagination: $result->pagination,
            )
        ]);
    }
}
