<?php
// ============================================================================
// File:    VideoController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Video;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;
use Seymenkonuk\Framework\Request;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;

use App\Http\Schemas\Video\Index\IndexPageSchema;
use App\Http\Schemas\Video\Index\WatchPageSchema;

use App\Support\DTOs\UI\PaginationDTO;

use App\Support\Factories\ViewContextFactory;

use App\Support\ViewModels\Video\IndexPageViewModel;
use App\Support\ViewModels\Video\WatchPageViewModel;

#[Prefix("/videos")]
class VideoController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected Request $request,
        protected Response $response,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(): Response
    {
        return $this->response->view("/videos/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->app(),
                videos: (function () {
                    yield from [];
                })(),
                pagination: new PaginationDTO(1, 1, 0, 0, 0),
            )
        ]);
    }

    #[Get("/{videoCode}")]
    #[Schema(WatchPageSchema::class)]
    public function WatchPage(string $videoCode): Response
    {
        /** @var int $startTime */
        $startTime = $this->request->query("t", 0);

        return $this->response->view("/videos/[id]/index", [
            "model" => new WatchPageViewModel(
                context: $this->viewContextFactory->app(),
                video: new \App\Support\DTOs\Video\DetailsDTO(
                    url: "/videos/1",
                    code: "1",
                    title: "Video Başlığı",
                    description: "Örnek Video Açıklaması",
                    thumbnail: "/uploads/videos/1/thumbnails/1",
                    sourceUrl: "https://samplefile.com/samples/download/video/mp4/mp4_15s_sample_file_868KB.mp4",
                    channel: new \App\Support\DTOs\Channel\DetailsDTO(
                        url: "/channels/1",
                        title: "Kanal İsmi",
                        avatar: "/uploads/channels/1/avatars/1",
                        banner: "/uploads/channels/1/banners/1",
                        subscription: new \App\Support\DTOs\Channel\SubscriptionDTO(
                            type: \App\Domain\Enums\SubscribeType::NORMAL,
                            title: "Arkadaş",
                        ),
                        subscriberCount: 1234,
                        subscriberCountFormatted: "1.2B",
                        videoCount: 345,
                        videoCountFormatted: "345",
                    ),
                    viewCount: 1234567,
                    viewCountFormatted: "1.2M",
                    date: "2022",
                    dateFormatted: "4 yıl önce",
                    liked: true,
                    likeCount: 12345,
                    likeCountFormatted: "12.3B",
                    disliked: false,
                    dislikeCount: 123,
                    dislikeCountFormatted: "123",
                    inWatchLater: true,
                ),
                startTime: $startTime,
                nextUrl: "/deneme",
                commentList: new \App\Support\DTOs\Comment\ListDTO(
                    data: "",
                    enabled: true,
                    loggedIn: true,
                    allowed: true,
                    comments: (function () {
                        yield from [];
                    })(),
                    count: 0,
                    countFormatted: "0",
                ),
                playlists: (function () {
                    yield from [];
                })(),
                activePlaylist: null,
            )
        ]);
    }
}
