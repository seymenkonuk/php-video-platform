<?php
// ============================================================================
// File:    VideoController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Video;


use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\IVideoService;

use App\Http\Schemas\Video\Index\IndexPageSchema;
use App\Http\Schemas\Video\Index\WatchPageSchema;

use App\Support\Factories\ViewContextFactory;
use App\Support\ViewModels\Video\IndexPageViewModel;
use App\Support\ViewModels\Video\WatchPageViewModel;


#[Prefix("/videos")]
class VideoController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected IAuthService $authService,
        protected IVideoService $videoService,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $page = $request->query("page", 1);

        // Servisi çağır
        $result = $this->videoService->getVideos($page);

        // View model döndür
        return $response->view("/videos/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->app(),
                videos: $result->videos,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/{videoCode}")]
    #[Schema(WatchPageSchema::class)]
    public function WatchPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("videoCode", "");
        $startTime = $request->query("t", 0);
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->videoService->getVideoPage($code, $auth);

        // View model döndür
        return $response->view("/videos/[id]/index", [
            "model" => new WatchPageViewModel(
                context: $this->viewContextFactory->app(),
                video: $result->video,
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
