<?php
// ============================================================================
// File:    PlaylistController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Playlist;


use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\IPlaylistService;

use App\Http\Schemas\Playlist\Index\HomePageSchema;
use App\Http\Schemas\Playlist\Index\IndexPageSchema;

use App\Support\Factories\ViewContextFactory;
use App\Support\ViewModels\Playlist\HomePageViewModel;
use App\Support\ViewModels\Playlist\IndexPageViewModel;


#[Prefix("/playlists")]
class PlaylistController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected IAuthService $authService,
        protected IPlaylistService $playlistService,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $page = $request->query("page", 1);

        // Servisi çağır
        $result = $this->playlistService->getPlaylists($page);

        // View model döndür
        return $response->view("/playlists/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->app(),
                playlists: $result->playlists,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/{playlistCode}")]
    #[Schema(HomePageSchema::class)]
    public function HomePage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("playlistCode", "");
        $page = $request->query("page", 1);
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->playlistService->getPlaylistPage($code, $page, auth: $auth);

        // View model döndür
        return $response->view("/playlists/[id]/index", [
            "model" => new HomePageViewModel(
                context: $this->viewContextFactory->app(),
                header: $result->header,
                videos: $result->videos,
                pagination: $result->pagination,
            )
        ]);
    }
}
