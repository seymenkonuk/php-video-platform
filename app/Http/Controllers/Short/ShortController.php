<?php
// ============================================================================
// File:    ShortController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Short;


use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\IShortService;

use App\Http\Schemas\Short\Index\IndexPageSchema;
use App\Http\Schemas\Short\Index\WatchPageSchema;

use App\Support\Factories\ViewContextFactory;
use App\Support\ViewModels\Short\IndexPageViewModel;
use App\Support\ViewModels\Short\WatchPageViewModel;


#[Prefix("/shorts")]
class ShortController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected IAuthService $authService,
        protected IShortService $shortService,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $page = $request->query("page", 1);

        // Servisi çağır
        $result = $this->shortService->getShorts($page);

        // View model döndür
        return $response->view("/shorts/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->app(),
                shorts: $result->shorts,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/{shortCode}")]
    #[Schema(WatchPageSchema::class)]
    public function WatchPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("shortCode", "");
        $startTime = $request->query("t", 0);
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->shortService->getShortPage($code, $auth);

        // View model döndür
        return $response->view("/shorts/[id]/index", [
            "model" => new WatchPageViewModel(
                context: $this->viewContextFactory->app(),
                short: $result->short,
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
