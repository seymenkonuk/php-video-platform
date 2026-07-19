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

use App\Support\DTOs\Channel\AboutDTO;
use App\Support\DTOs\Channel\HeaderDTO;
use App\Support\DTOs\UI\PaginationDTO;
use App\Support\DTOs\UI\SocialLinkDTO;

use App\Support\ViewModels\Channel\IndexPageViewModel;
use App\Support\ViewModels\Channel\HomePageViewModel;
use App\Support\ViewModels\Channel\VideosPageViewModel;
use App\Support\ViewModels\Channel\ShortsPageViewModel;
use App\Support\ViewModels\Channel\MusicsPageViewModel;
use App\Support\ViewModels\Channel\PlaylistsPageViewModel;
use App\Support\ViewModels\Channel\SubscriptionsPageViewModel;
use App\Support\ViewModels\Channel\AboutPageViewModel;

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
        return $this->response->view("/channels/index", [
            "model" => new IndexPageViewModel((function () {
                yield from [];
            })(), new PaginationDTO(1, 1, 0, 0, 0))
        ]);
    }

    #[Get("/{channelCode}")]
    #[Schema(HomePageSchema::class)]
    public function HomePage(string $channelCode): Response
    {
        return $this->response->view("/channels/[id]/index", [
            "model" => new HomePageViewModel(
                new HeaderDTO(
                    "/channels/1",
                    "Kanal İsmi",
                    "/uploads/channels/1/avatars/1",
                    "/uploads/channels/1/banners/1",
                    new \App\Support\DTOs\Channel\SubscriptionDTO(\App\Domain\Enums\SubscribeType::NORMAL, ""),
                    0,
                    "0",
                    0,
                    "0"
                ),
            )
        ]);
    }

    #[Get("/{channelCode}/videos")]
    #[Schema(VideosPageSchema::class)]
    public function VideosPage(string $channelCode): Response
    {
        return $this->response->view("/channels/[id]/videos/index", [
            "model" => new VideosPageViewModel(
                new HeaderDTO(
                    "/channels/1",
                    "Kanal İsmi",
                    "/uploads/channels/1/avatars/1",
                    "/uploads/channels/1/banners/1",
                    new \App\Support\DTOs\Channel\SubscriptionDTO(\App\Domain\Enums\SubscribeType::NORMAL, ""),
                    0,
                    "0",
                    0,
                    "0"
                ),
                (function () {
                    yield from [];
                })(),
                new PaginationDTO(1, 1, 0, 0, 0),
            )
        ]);
    }

    #[Get("/{channelCode}/shorts")]
    #[Schema(ShortsPageSchema::class)]
    public function ShortsPage(string $channelCode): Response
    {
        return $this->response->view("/channels/[id]/shorts/index", [
            "model" => new ShortsPageViewModel(
                new HeaderDTO(
                    "/channels/1",
                    "Kanal İsmi",
                    "/uploads/channels/1/avatars/1",
                    "/uploads/channels/1/banners/1",
                    new \App\Support\DTOs\Channel\SubscriptionDTO(\App\Domain\Enums\SubscribeType::NORMAL, ""),
                    0,
                    "0",
                    0,
                    "0"
                ),
                (function () {
                    yield from [];
                })(),
                new PaginationDTO(1, 1, 0, 0, 0),
            )
        ]);
    }

    #[Get("/{channelCode}/musics")]
    #[Schema(MusicsPageSchema::class)]
    public function MusicsPage(string $channelCode): Response
    {
        return $this->response->view("/channels/[id]/musics/index", [
            "model" => new MusicsPageViewModel(
                new HeaderDTO(
                    "/channels/1",
                    "Kanal İsmi",
                    "/uploads/channels/1/avatars/1",
                    "/uploads/channels/1/banners/1",
                    new \App\Support\DTOs\Channel\SubscriptionDTO(\App\Domain\Enums\SubscribeType::NORMAL, ""),
                    0,
                    "0",
                    0,
                    "0"
                ),
                (function () {
                    yield from [];
                })(),
                new PaginationDTO(1, 1, 0, 0, 0),
            )
        ]);
    }

    #[Get("/{channelCode}/playlists")]
    #[Schema(PlaylistsPageSchema::class)]
    public function PlaylistsPage(string $channelCode): Response
    {
        return $this->response->view("/channels/[id]/playlists/index", [
            "model" => new PlaylistsPageViewModel(
                new HeaderDTO(
                    "/channels/1",
                    "Kanal İsmi",
                    "/uploads/channels/1/avatars/1",
                    "/uploads/channels/1/banners/1",
                    new \App\Support\DTOs\Channel\SubscriptionDTO(\App\Domain\Enums\SubscribeType::NORMAL, ""),
                    0,
                    "0",
                    0,
                    "0"
                ),
                (function () {
                    yield from [];
                })(),
                new PaginationDTO(1, 1, 0, 0, 0),
            )
        ]);
    }

    #[Get("/{channelCode}/subscriptions")]
    #[Schema(SubscriptionsPageSchema::class)]
    public function SubscriptionsPage(string $channelCode): Response
    {
        return $this->response->view("/channels/[id]/subscriptions/index", [
            "model" => new SubscriptionsPageViewModel(
                new HeaderDTO(
                    "/channels/1",
                    "Kanal İsmi",
                    "/uploads/channels/1/avatars/1",
                    "/uploads/channels/1/banners/1",
                    new \App\Support\DTOs\Channel\SubscriptionDTO(\App\Domain\Enums\SubscribeType::NORMAL, ""),
                    0,
                    "0",
                    0,
                    "0"
                ),
                (function () {
                    yield from [];
                })(),
                new PaginationDTO(1, 1, 0, 0, 0),
            )
        ]);
    }

    #[Get("/{channelCode}/about")]
    #[Schema(DetailsPageSchema::class)]
    public function AboutPage(string $channelCode): Response
    {
        return $this->response->view("/channels/[id]/about/index", [
            "model" => new AboutPageViewModel(
                new HeaderDTO(
                    "/channels/1",
                    "Kanal İsmi",
                    "/uploads/channels/1/avatars/1",
                    "/uploads/channels/1/banners/1",
                    new \App\Support\DTOs\Channel\SubscriptionDTO(\App\Domain\Enums\SubscribeType::NORMAL, ""),
                    0,
                    "0",
                    0,
                    "0"
                ),
                new AboutDTO("", [
                    new SocialLinkDTO("GitHub", "bi-github", "https://github.com/seymenkonuk"),
                    new SocialLinkDTO("LinkedIn", "bi-linkedin", "https://www.linkedin.com/in/recepseymenkonuk"),
                ], 0, "0", 0, "0", 0, "0", "2022", "şimdi"),
            )
        ]);
    }
}
