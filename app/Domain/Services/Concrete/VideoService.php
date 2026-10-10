<?php
// ============================================================================
// File:    VideoService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Enums\LikeType;
use App\Domain\Exception\NotFound\VideoNotFoundException;
use App\Domain\Exception\Private\PrivateVideoException;
use App\Domain\Policies\VideoPolicy;
use App\Domain\Repositories\Abstract\IChannelRepository;
use App\Domain\Repositories\Abstract\ILikedRepository;
use App\Domain\Repositories\Abstract\IVideoRepository;
use App\Domain\Repositories\Abstract\IWatchLaterRepository;
use App\Domain\Services\Abstract\IVideoService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Comment\ListDTO;
use App\Support\DTOs\Video\InteractionDTO;
use App\Support\DTOs\Video\PageDTO;
use App\Support\DTOs\Video\PaginatedDTO;
use App\Support\Helpers\PaginationHelper;
use App\Support\Mappers\VideoToCardDtoMapper;
use App\Support\Mappers\VideoToDetailsDtoMapper;
use App\Support\Mappers\VideoToInteractionDtoMapper;

use Config\PaginationConfig;


class VideoService implements IVideoService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IChannelRepository $channelRepository,
        protected IVideoRepository $videoRepository,
        protected ILikedRepository $likedRepository,
        protected IWatchLaterRepository $watchLaterRepository,
        protected VideoToCardDtoMapper $videoCardMapper,
        protected VideoToDetailsDtoMapper $videoDetailsMapper,
        protected VideoToInteractionDtoMapper $videoInteractionMapper,
    ) {}

    // --------------------------------------------------------------------------
    // VIDEOS
    // --------------------------------------------------------------------------

    public function getVideos(
        int $page,
        int $perPage = PaginationConfig::VIDEO_PER_PAGE,
    ): PaginatedDTO {
        // Public Videoları Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->videoRepository->countPublic(),
            $perPage,
            fn($offset, $limit) => $this->videoRepository->yieldPublic($offset, $limit),
        );

        // DTO'ya Dönüştür
        return new PaginatedDTO(
            videos: $this->videoCardMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getVideoPage(
        string $code,
        ?AuthDTO $auth = null,
    ): PageDTO {
        // Video Detaylarını Al
        $video = $this->videoRepository->findDetailsByCode($code, $auth?->channel->code);

        // Video Bulunamadı
        if (!$video) {
            throw new VideoNotFoundException();
        }

        // Video Görüntüleme Yetkisi Yok
        if (!VideoPolicy::canView($auth, $video)) {
            throw new PrivateVideoException();
        }

        // Videoyu Yükleyen Kanalın Detaylarını Al
        $channel = $this->channelRepository->findDetailsByCode($video->channel_code, $auth?->channel->code);
        assert($channel !== null); // Channel null dönemez

        // DTO'ya Dönüştür
        return new PageDTO(
            video: $this->videoDetailsMapper->map($video, $channel),
            commentList: new ListDTO(
                data: "",
                enabled: false,
                loggedIn: $auth !== null,
                allowed: false,
                comments: (function () {
                    yield from [];
                })(),
                count: 0,
                countFormatted: "0",
            ),
        );
    }

    // --------------------------------------------------------------------------
    // INTERACTIONS
    // --------------------------------------------------------------------------

    public function toggleLike(
        string $code,
        AuthDTO $auth,
    ): InteractionDTO {
        // Video Bilgisini Al
        $video = $this->videoRepository->findByCode($code);

        // Video Bulunamadı
        if (!$video) {
            throw new VideoNotFoundException();
        }

        // Video Görüntüleme Yetkisi Yok
        if (!VideoPolicy::canView($auth, $video)) {
            throw new PrivateVideoException();
        }

        // Kanal Id'sini Al
        $channelId = $auth->user->active_channel_id;
        assert($channelId !== null); // oturum açmış kanalın aktif kanal bilgisi null olamaz

        // Beğeni Bilgisini Al
        $likeDetails = $this->likedRepository->findDetailsByIds($channelId, $video->id);

        // Daha Önce Tepki Eklendiyse Eski Tepkiyi Kaldır
        if ($likeDetails) {
            $this->likedRepository->deleteByIds($channelId, $video->id);
        }

        // Daha Önce Tepki Eklenmediyse veya Daha Önce Dislike Verildiyse
        // Beğeni Ekle
        if (!$likeDetails || $likeDetails->type === LikeType::DISLIKE->value) {
            $this->likedRepository->create([
                "channel_id" => $channelId,
                "video_id" => $video->id,
                "type" => LikeType::LIKE->value,
            ]);
        }

        // Video Detaylarını Al
        $details = $this->videoRepository->findDetailsByCode($code, $auth->channel->code);
        assert($details !== null); // mevcut olduğu kontrol edildi, null olamaz

        // DTO'ya Dönüştür
        return $this->videoInteractionMapper->map($details);
    }

    public function toggleDislike(
        string $code,
        AuthDTO $auth,
    ): InteractionDTO {
        // Video Bilgisini Al
        $video = $this->videoRepository->findByCode($code);

        // Video Bulunamadı
        if (!$video) {
            throw new VideoNotFoundException();
        }

        // Video Görüntüleme Yetkisi Yok
        if (!VideoPolicy::canView($auth, $video)) {
            throw new PrivateVideoException();
        }

        // Kanal Id'sini Al
        $channelId = $auth->user->active_channel_id;
        assert($channelId !== null); // oturum açmış kanalın aktif kanal bilgisi null olamaz

        // Beğeni Bilgisini Al
        $likeDetails = $this->likedRepository->findDetailsByIds($channelId, $video->id);

        // Daha Önce Tepki Eklendiyse Eski Tepkiyi Kaldır
        if ($likeDetails) {
            $this->likedRepository->deleteByIds($channelId, $video->id);
        }

        // Daha Önce Tepki Eklenmediyse veya Daha Önce Beğeni Verildiyse
        // Dislike Ekle
        if (!$likeDetails || $likeDetails->type === LikeType::LIKE->value) {
            $this->likedRepository->create([
                "channel_id" => $channelId,
                "video_id" => $video->id,
                "type" => LikeType::DISLIKE->value,
            ]);
        }

        // Video Detaylarını Al
        $details = $this->videoRepository->findDetailsByCode($code, $auth->channel->code);
        assert($details !== null); // mevcut olduğu kontrol edildi, null olamaz

        // DTO'ya Dönüştür
        return $this->videoInteractionMapper->map($details);
    }

    public function toggleWatchLater(
        string $code,
        AuthDTO $auth,
    ): bool {
        // Video Bilgisini Al
        $video = $this->videoRepository->findByCode($code);

        // Video Bulunamadı
        if (!$video) {
            throw new VideoNotFoundException();
        }

        // Video Görüntüleme Yetkisi Yok
        if (!VideoPolicy::canView($auth, $video)) {
            throw new PrivateVideoException();
        }

        // Kanal Id'sini Al
        $channelId = $auth->user->active_channel_id;
        assert($channelId !== null); // oturum açmış kanalın aktif kanal bilgisi null olamaz

        // Daha Sonra İzle Bilgisini Al
        $details = $this->watchLaterRepository->findDetailsByIds($channelId, $video->id);

        // Listede Yoksa Ekle
        if (!$details) {
            $this->watchLaterRepository->create([
                "channel_id" => $channelId,
                "video_id" => $video->id,
            ]);
            return true;
        }
        // Listede Varsa Çıkar
        else {
            $this->watchLaterRepository->deleteByIds($channelId, $video->id);
            return false;
        }
    }
}
