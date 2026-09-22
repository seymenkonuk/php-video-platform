<?php
// ============================================================================
// File:    MusicController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Music;


use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\IMusicService;

use App\Http\Schemas\Music\Index\IndexPageSchema;
use App\Http\Schemas\Music\Index\WatchPageSchema;

use App\Support\Factories\ViewContextFactory;
use App\Support\ViewModels\Music\IndexPageViewModel;
use App\Support\ViewModels\Music\WatchPageViewModel;


#[Prefix("/musics")]
class MusicController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected IAuthService $authService,
        protected IMusicService $musicService,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $page = $request->query("page", 1);

        // Servisi çağır
        $result = $this->musicService->getMusics($page);

        // View model döndür
        return $response->view("/musics/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->app(),
                musics: $result->musics,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/{musicCode}")]
    #[Schema(WatchPageSchema::class)]
    public function WatchPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("musicCode", "");
        $startTime = $request->query("t", 0);
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->musicService->getMusicPage($code, $auth);

        // View model döndür
        return $response->view("/musics/[id]/index", [
            "model" => new WatchPageViewModel(
                context: $this->viewContextFactory->app(),
                music: $result->music,
                startTime: $startTime,
                nextUrl: null,
                commentList: $result->commentList,
                playlists: (function () {
                    yield from [];
                })(),
                activePlaylist: null,
            )
        ]);
    }
}
