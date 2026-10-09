<?php
// ============================================================================
// File:    ShortInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Short;


use Seymenkonuk\Framework\Attribute\Auth\Authenticated;
use Seymenkonuk\Framework\Attribute\Middleware;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\IShortService;

use App\Http\Middlewares\ComponentResponseMiddleware;
use App\Http\Schemas\Short\Interaction\AddWatchLaterSchema;
use App\Http\Schemas\Short\Interaction\DislikeSchema;
use App\Http\Schemas\Short\Interaction\LikeSchema;

use App\Support\ViewProps\Components\Interaction\VideoReactionViewProp;
use App\Support\ViewProps\Components\Interaction\WatchLaterViewProp;


#[Prefix("/shorts")]
#[Authenticated]
class ShortInteractionController extends Controller
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IAuthService $authService,
        protected IShortService $shortService,
    ) {}

    // --------------------------------------------------------------------------
    // ACTIONS
    // --------------------------------------------------------------------------

    #[Post("/{shortCode}/like")]
    #[Schema(LikeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Like(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("shortCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $short = $this->shortService->toggleLike($code, $auth);

        // Component döndür
        return $response->component("/Interaction/VideoReaction", (array) new VideoReactionViewProp(
            likeUrl: "/shorts/{$code}/like",
            liked: $short->liked,
            likeCount: $short->likeCount,
            likeCountFormatted: $short->likeCountFormatted,
            dislikeUrl: "/shorts/{$code}/dislike",
            disliked: $short->disliked,
            dislikeCount: $short->dislikeCount,
            dislikeCountFormatted: $short->dislikeCountFormatted,
        ));
    }

    #[Post("/{shortCode}/dislike")]
    #[Schema(DislikeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Dislike(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("shortCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $short = $this->shortService->toggleDislike($code, $auth);

        // Component döndür
        return $response->component("/Interaction/VideoReaction", (array) new VideoReactionViewProp(
            likeUrl: "/shorts/{$code}/like",
            liked: $short->liked,
            likeCount: $short->likeCount,
            likeCountFormatted: $short->likeCountFormatted,
            dislikeUrl: "/shorts/{$code}/dislike",
            disliked: $short->disliked,
            dislikeCount: $short->dislikeCount,
            dislikeCountFormatted: $short->dislikeCountFormatted,
        ));
    }

    #[Post("/{shortCode}/watch-later")]
    #[Schema(AddWatchLaterSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function AddWatchLater(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("shortCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $inWatchLater = $this->shortService->toggleWatchLater($code, $auth);

        // Component döndür
        return $response->component("/Interaction/WatchLater", (array) new WatchLaterViewProp(
            url: "/shorts/{$code}/watch-later",
            inWatchLater: $inWatchLater,
        ));
    }
}
