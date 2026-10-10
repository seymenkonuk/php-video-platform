<?php
// ============================================================================
// File:    ShortService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Enums\LikeType;
use App\Domain\Exception\NotFound\ShortNotFoundException;
use App\Domain\Exception\Private\PrivateShortException;
use App\Domain\Policies\VideoPolicy;
use App\Domain\Repositories\Abstract\IChannelRepository;
use App\Domain\Repositories\Abstract\ILikedRepository;
use App\Domain\Repositories\Abstract\IShortRepository;
use App\Domain\Repositories\Abstract\IWatchLaterRepository;
use App\Domain\Services\Abstract\IShortService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Comment\ListDTO;
use App\Support\DTOs\Short\InteractionDTO;
use App\Support\DTOs\Short\PageDTO;
use App\Support\DTOs\Short\PaginatedDTO;
use App\Support\Helpers\PaginationHelper;
use App\Support\Mappers\ShortToCardDtoMapper;
use App\Support\Mappers\ShortToDetailsDtoMapper;
use App\Support\Mappers\ShortToInteractionDtoMapper;

use Config\PaginationConfig;


class ShortService implements IShortService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IChannelRepository $channelRepository,
        protected IShortRepository $shortRepository,
        protected ILikedRepository $likedRepository,
        protected IWatchLaterRepository $watchLaterRepository,
        protected ShortToCardDtoMapper $shortCardMapper,
        protected ShortToDetailsDtoMapper $shortDetailsMapper,
        protected ShortToInteractionDtoMapper $shortInteractionMapper,
    ) {}

    // --------------------------------------------------------------------------
    // SHORTS
    // --------------------------------------------------------------------------

    public function getShorts(
        int $page,
        int $perPage = PaginationConfig::SHORT_PER_PAGE,
    ): PaginatedDTO {
        // Public Kısa Videoları Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->shortRepository->countPublic(),
            $perPage,
            fn($offset, $limit) => $this->shortRepository->yieldPublic($offset, $limit),
        );

        // DTO'ya Dönüştür
        return new PaginatedDTO(
            shorts: $this->shortCardMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getShortPage(
        string $code,
        ?AuthDTO $auth = null,
    ): PageDTO {
        // Kısa Video Detaylarını Al
        $short = $this->shortRepository->findDetailsByCode($code, $auth?->channel->code);

        // Kısa Video Bulunamadı
        if (!$short) {
            throw new ShortNotFoundException();
        }

        // Kısa Video Görüntüleme Yetkisi Yok
        if (!VideoPolicy::canView($auth, $short)) {
            throw new PrivateShortException();
        }

        // Kısa Videoyu Yükleyen Kanalın Detaylarını Al
        $channel = $this->channelRepository->findDetailsByCode($short->channel_code, $auth?->channel->code);
        assert($channel !== null); // Channel null dönemez

        // DTO'ya Dönüştür
        return new PageDTO(
            short: $this->shortDetailsMapper->map($short, $channel),
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
        // Kısa Video Bilgisini Al
        $short = $this->shortRepository->findByCode($code);

        // Kısa Video Bulunamadı
        if (!$short) {
            throw new ShortNotFoundException();
        }

        // Kısa Video Görüntüleme Yetkisi Yok
        if (!VideoPolicy::canView($auth, $short)) {
            throw new PrivateShortException();
        }

        // Kanal Id'sini Al
        $channelId = $auth->user->active_channel_id;
        assert($channelId !== null); // oturum açmış kanalın aktif kanal bilgisi null olamaz

        // Beğeni Bilgisini Al
        $likeDetails = $this->likedRepository->findDetailsByIds($channelId, $short->id);

        // Daha Önce Tepki Eklendiyse Eski Tepkiyi Kaldır
        if ($likeDetails) {
            $this->likedRepository->deleteByIds($channelId, $short->id);
        }

        // Daha Önce Tepki Eklenmediyse veya Daha Önce Dislike Verildiyse
        // Beğeni Ekle
        if (!$likeDetails || $likeDetails->type === LikeType::DISLIKE->value) {
            $this->likedRepository->create([
                "channel_id" => $channelId,
                "video_id" => $short->id,
                "type" => LikeType::LIKE->value,
            ]);
        }

        // Kısa Video Detaylarını Al
        $details = $this->shortRepository->findDetailsByCode($code, $auth->channel->code);
        assert($details !== null); // mevcut olduğu kontrol edildi, null olamaz

        // DTO'ya Dönüştür
        return $this->shortInteractionMapper->map($details);
    }

    public function toggleDislike(
        string $code,
        AuthDTO $auth,
    ): InteractionDTO {
        // Kısa Video Bilgisini Al
        $short = $this->shortRepository->findByCode($code);

        // Kısa Video Bulunamadı
        if (!$short) {
            throw new ShortNotFoundException();
        }

        // Kısa Video Görüntüleme Yetkisi Yok
        if (!VideoPolicy::canView($auth, $short)) {
            throw new PrivateShortException();
        }

        // Kanal Id'sini Al
        $channelId = $auth->user->active_channel_id;
        assert($channelId !== null); // oturum açmış kanalın aktif kanal bilgisi null olamaz

        // Beğeni Bilgisini Al
        $likeDetails = $this->likedRepository->findDetailsByIds($channelId, $short->id);

        // Daha Önce Tepki Eklendiyse Eski Tepkiyi Kaldır
        if ($likeDetails) {
            $this->likedRepository->deleteByIds($channelId, $short->id);
        }

        // Daha Önce Tepki Eklenmediyse veya Daha Önce Beğeni Verildiyse
        // Dislike Ekle
        if (!$likeDetails || $likeDetails->type === LikeType::LIKE->value) {
            $this->likedRepository->create([
                "channel_id" => $channelId,
                "video_id" => $short->id,
                "type" => LikeType::DISLIKE->value,
            ]);
        }

        // Kısa Video Detaylarını Al
        $details = $this->shortRepository->findDetailsByCode($code, $auth->channel->code);
        assert($details !== null); // mevcut olduğu kontrol edildi, null olamaz

        // DTO'ya Dönüştür
        return $this->shortInteractionMapper->map($details);
    }

    public function toggleWatchLater(
        string $code,
        AuthDTO $auth,
    ): bool {
        // Kısa Video Bilgisini Al
        $short = $this->shortRepository->findByCode($code);

        // Kısa Video Bulunamadı
        if (!$short) {
            throw new ShortNotFoundException();
        }

        // Kısa Video Görüntüleme Yetkisi Yok
        if (!VideoPolicy::canView($auth, $short)) {
            throw new PrivateShortException();
        }

        // Kanal Id'sini Al
        $channelId = $auth->user->active_channel_id;
        assert($channelId !== null); // oturum açmış kanalın aktif kanal bilgisi null olamaz

        // Daha Sonra İzle Bilgisini Al
        $details = $this->watchLaterRepository->findDetailsByIds($channelId, $short->id);

        // Listede Yoksa Ekle
        if (!$details) {
            $this->watchLaterRepository->create([
                "channel_id" => $channelId,
                "video_id" => $short->id,
            ]);
            return true;
        }
        // Listede Varsa Çıkar
        else {
            $this->watchLaterRepository->deleteByIds($channelId, $short->id);
            return false;
        }
    }
}
