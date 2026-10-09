<?php
// ============================================================================
// File:    VideoInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Video;


use Seymenkonuk\Framework\Attribute\Auth\Authenticated;
use Seymenkonuk\Framework\Attribute\Middleware;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\IVideoService;

use App\Http\Middlewares\ComponentResponseMiddleware;
use App\Http\Schemas\Video\Interaction\AddWatchLaterSchema;
use App\Http\Schemas\Video\Interaction\DislikeSchema;
use App\Http\Schemas\Video\Interaction\LikeSchema;

use App\Support\ViewProps\Components\Interaction\VideoReactionViewProp;
use App\Support\ViewProps\Components\Interaction\WatchLaterViewProp;


#[Prefix("/videos")]
#[Authenticated]
class VideoInteractionController extends Controller
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IAuthService $authService,
        protected IVideoService $videoService,
    ) {}

    // --------------------------------------------------------------------------
    // ACTIONS
    // --------------------------------------------------------------------------

    #[Post("/{videoCode}/like")]
    #[Schema(LikeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Like(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("videoCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $video = $this->videoService->toggleLike($code, $auth);

        // Component döndür
        return $response->component("/Interaction/VideoReaction", (array) new VideoReactionViewProp(
            likeUrl: "/videos/{$code}/like",
            liked: $video->liked,
            likeCount: $video->likeCount,
            likeCountFormatted: $video->likeCountFormatted,
            dislikeUrl: "/videos/{$code}/dislike",
            disliked: $video->disliked,
            dislikeCount: $video->dislikeCount,
            dislikeCountFormatted: $video->dislikeCountFormatted,
        ));
    }

    #[Post("/{videoCode}/dislike")]
    #[Schema(DislikeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Dislike(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("videoCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $video = $this->videoService->toggleLike($code, $auth);

        // Component döndür
        return $response->component("/Interaction/VideoReaction", (array) new VideoReactionViewProp(
            likeUrl: "/videos/{$code}/like",
            liked: $video->liked,
            likeCount: $video->likeCount,
            likeCountFormatted: $video->likeCountFormatted,
            dislikeUrl: "/videos/{$code}/dislike",
            disliked: $video->disliked,
            dislikeCount: $video->dislikeCount,
            dislikeCountFormatted: $video->dislikeCountFormatted,
        ));
    }

    #[Post("/{videoCode}/watch-later")]
    #[Schema(AddWatchLaterSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function AddWatchLater(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("videoCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $inWatchLater = $this->videoService->toggleWatchLater($code, $auth);

        // Component döndür
        return $response->component("/Interaction/WatchLater", (array) new WatchLaterViewProp(
            url: "/videos/{$code}/watch-later",
            inWatchLater: $inWatchLater,
        ));
    }
}
