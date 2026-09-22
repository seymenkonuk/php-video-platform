<?php
// ============================================================================
// File:    ChannelController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Channel;


use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\IChannelService;

use App\Http\Schemas\Channel\Index\DetailsPageSchema;
use App\Http\Schemas\Channel\Index\HomePageSchema;
use App\Http\Schemas\Channel\Index\IndexPageSchema;
use App\Http\Schemas\Channel\Index\MusicsPageSchema;
use App\Http\Schemas\Channel\Index\PlaylistsPageSchema;
use App\Http\Schemas\Channel\Index\ShortsPageSchema;
use App\Http\Schemas\Channel\Index\SubscriptionsPageSchema;
use App\Http\Schemas\Channel\Index\VideosPageSchema;

use App\Support\Factories\ViewContextFactory;
use App\Support\ViewModels\Channel\AboutPageViewModel;
use App\Support\ViewModels\Channel\HomePageViewModel;
use App\Support\ViewModels\Channel\IndexPageViewModel;
use App\Support\ViewModels\Channel\MusicsPageViewModel;
use App\Support\ViewModels\Channel\PlaylistsPageViewModel;
use App\Support\ViewModels\Channel\ShortsPageViewModel;
use App\Support\ViewModels\Channel\SubscriptionsPageViewModel;
use App\Support\ViewModels\Channel\VideosPageViewModel;


#[Prefix("/channels")]
class ChannelController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected IAuthService $authService,
        protected IChannelService $channelService,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $page = $request->query("page", 1);
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->channelService->getChannels($page, auth: $auth);

        // View model döndür
        return $response->view("/channels/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->app(),
                channels: $result->channels,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/{channelCode}")]
    #[Schema(HomePageSchema::class)]
    public function HomePage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("channelCode", "");
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->channelService->getChannelHomePage($code, auth: $auth);

        // View model döndür
        return $response->view("/channels/[id]/index", [
            "model" => new HomePageViewModel(
                context: $this->viewContextFactory->channel($result->header),
            )
        ]);
    }

    #[Get("/{channelCode}/videos")]
    #[Schema(VideosPageSchema::class)]
    public function VideosPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("channelCode", "");
        $page = $request->query("page", 1);
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->channelService->getChannelVideosPage($code, $page, auth: $auth);

        // View model döndür
        return $response->view("/channels/[id]/videos/index", [
            "model" => new VideosPageViewModel(
                context: $this->viewContextFactory->channel($result->header),
                videos: $result->videos,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/{channelCode}/shorts")]
    #[Schema(ShortsPageSchema::class)]
    public function ShortsPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("channelCode", "");
        $page = $request->query("page", 1);
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->channelService->getChannelShortsPage($code, $page, auth: $auth);

        // View model döndür
        return $response->view("/channels/[id]/shorts/index", [
            "model" => new ShortsPageViewModel(
                context: $this->viewContextFactory->channel($result->header),
                shorts: $result->shorts,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/{channelCode}/musics")]
    #[Schema(MusicsPageSchema::class)]
    public function MusicsPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("channelCode", "");
        $page = $request->query("page", 1);
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->channelService->getChannelMusicsPage($code, $page, auth: $auth);

        // View model döndür
        return $response->view("/channels/[id]/musics/index", [
            "model" => new MusicsPageViewModel(
                context: $this->viewContextFactory->channel($result->header),
                musics: $result->musics,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/{channelCode}/playlists")]
    #[Schema(PlaylistsPageSchema::class)]
    public function PlaylistsPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("channelCode", "");
        $page = $request->query("page", 1);
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->channelService->getChannelPlaylistsPage($code, $page, auth: $auth);

        // View model döndür
        return $response->view("/channels/[id]/playlists/index", [
            "model" => new PlaylistsPageViewModel(
                context: $this->viewContextFactory->channel($result->header),
                playlists: $result->playlists,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/{channelCode}/subscriptions")]
    #[Schema(SubscriptionsPageSchema::class)]
    public function SubscriptionsPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("channelCode", "");
        $page = $request->query("page", 1);
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->channelService->getChannelSubscriptionsPage($code, $page, auth: $auth);

        // View model döndür
        return $response->view("/channels/[id]/subscriptions/index", [
            "model" => new SubscriptionsPageViewModel(
                context: $this->viewContextFactory->channel($result->header),
                subscriptions: $result->channels,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/{channelCode}/about")]
    #[Schema(DetailsPageSchema::class)]
    public function AboutPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("channelCode", "");
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->channelService->getChannelAboutPage($code, auth: $auth);

        // View model döndür
        return $response->view("/channels/[id]/about/index", [
            "model" => new AboutPageViewModel(
                context: $this->viewContextFactory->channel($result->header),
                about: $result->about,
            )
        ]);
    }
}
