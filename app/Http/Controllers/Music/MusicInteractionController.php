<?php
// ============================================================================
// File:    MusicInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Music;


use Seymenkonuk\Framework\Attribute\Auth\Authenticated;
use Seymenkonuk\Framework\Attribute\Middleware;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\IMusicService;

use App\Http\Middlewares\ComponentResponseMiddleware;
use App\Http\Schemas\Music\Interaction\AddWatchLaterSchema;
use App\Http\Schemas\Music\Interaction\DislikeSchema;
use App\Http\Schemas\Music\Interaction\LikeSchema;

use App\Support\ViewProps\Components\Interaction\VideoReactionViewProp;
use App\Support\ViewProps\Components\Interaction\WatchLaterViewProp;


#[Prefix("/musics")]
#[Authenticated]
class MusicInteractionController extends Controller
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IAuthService $authService,
        protected IMusicService $musicService,
    ) {}

    // --------------------------------------------------------------------------
    // ACTIONS
    // --------------------------------------------------------------------------

    #[Post("/{musicCode}/like")]
    #[Schema(LikeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Like(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("musicCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $music = $this->musicService->toggleLike($code, $auth);

        // Component döndür
        return $response->component("/Interaction/VideoReaction", (array) new VideoReactionViewProp(
            likeUrl: "/musics/{$code}/like",
            liked: $music->liked,
            likeCount: $music->likeCount,
            likeCountFormatted: $music->likeCountFormatted,
            dislikeUrl: "/musics/{$code}/dislike",
            disliked: $music->disliked,
            dislikeCount: $music->dislikeCount,
            dislikeCountFormatted: $music->dislikeCountFormatted,
        ));
    }

    #[Post("/{musicCode}/dislike")]
    #[Schema(DislikeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Dislike(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("musicCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $music = $this->musicService->toggleDislike($code, $auth);

        // Component döndür
        return $response->component("/Interaction/VideoReaction", (array) new VideoReactionViewProp(
            likeUrl: "/musics/{$code}/like",
            liked: $music->liked,
            likeCount: $music->likeCount,
            likeCountFormatted: $music->likeCountFormatted,
            dislikeUrl: "/musics/{$code}/dislike",
            disliked: $music->disliked,
            dislikeCount: $music->dislikeCount,
            dislikeCountFormatted: $music->dislikeCountFormatted,
        ));
    }

    #[Post("/{musicCode}/watch-later")]
    #[Schema(AddWatchLaterSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function AddWatchLater(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("musicCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $inWatchLater = $this->musicService->toggleWatchLater($code, $auth);

        // Component döndür
        return $response->component("/Interaction/WatchLater", (array) new WatchLaterViewProp(
            url: "/musics/{$code}/watch-later",
            inWatchLater: $inWatchLater,
        ));
    }
}
