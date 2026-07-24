<?php
// ============================================================================
// File:    PlaylistController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Playlist;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;

use App\Domain\Enums\ViewType;

use App\Http\Schemas\Playlist\Index\IndexPageSchema;
use App\Http\Schemas\Playlist\Index\HomePageSchema;

use App\Support\DTOs\Channel\ChannelDTO;
use App\Support\DTOs\Playlist\HeaderDTO;
use App\Support\DTOs\UI\PaginationDTO;

use App\Support\Factories\ViewContextFactory;

use App\Support\ViewModels\Playlist\IndexPageViewModel;
use App\Support\ViewModels\Playlist\HomePageViewModel;


#[Prefix("/playlists")]
class PlaylistController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected Response $response,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(): Response
    {
        return $this->response->view("/playlists/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->app(),
                playlists: (function () {
                    yield from [];
                })(),
                pagination: new PaginationDTO(1, 1, 0, 0, 0),
            )
        ]);
    }

    #[Get("/{playlistCode}")]
    #[Schema(HomePageSchema::class)]
    public function HomePage(string $playlistCode): Response
    {
        return $this->response->view("/playlists/[id]/index", [
            "model" => new HomePageViewModel(
                context: $this->viewContextFactory->app(),
                header: new HeaderDTO(
                    title: "Başlık",
                    description: "Açıklama",
                    banner: "/uploads/playlists/1/banners/1",
                    channel: new ChannelDTO("/channels/1", "1", "Kanal İsmi", "/uploads/channels/1/avatars/1"),
                    videoCount: 0,
                    videoCountFormatted: "0",
                    totalDuration: 0,
                    totalDurationFormatted: "0sn",
                    viewType: ViewType::PUBLIC,
                ),
                videos: (function () {
                    yield from [];
                })(),
                pagination: new PaginationDTO(1, 1, 0, 0, 0),
            )
        ]);
    }
}
