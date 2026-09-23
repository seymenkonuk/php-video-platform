<?php
// ============================================================================
// File:    UploadService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use Seymenkonuk\Framework\Http\Exception\AuthorizationException;
use Seymenkonuk\Framework\Http\Exception\NotFoundException;

use App\Domain\Policies\CategoryPolicy;
use App\Domain\Policies\ChannelPolicy;
use App\Domain\Policies\PlaylistPolicy;
use App\Domain\Policies\VideoPolicy;
use App\Domain\Repositories\Abstract\ICategoryRepository;
use App\Domain\Repositories\Abstract\IChannelRepository;
use App\Domain\Repositories\Abstract\IMusicRepository;
use App\Domain\Repositories\Abstract\IPlaylistRepository;
use App\Domain\Repositories\Abstract\IShortRepository;
use App\Domain\Repositories\Abstract\IVideoRepository;
use App\Domain\Services\Abstract\IUploadService;

use App\Support\DTOs\AuthDTO;
use App\Support\Helpers\PathHelper;


class UploadService implements IUploadService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected PathHelper $pathHelper,
        protected IVideoRepository $videoRepository,
        protected IShortRepository $shortRepository,
        protected IMusicRepository $musicRepository,
        protected ICategoryRepository $categoryRepository,
        protected IPlaylistRepository $playlistRepository,
        protected IChannelRepository $channelRepository,
    ) {}

    // --------------------------------------------------------------------------
    // CHANNEL
    // --------------------------------------------------------------------------

    public function getChannelAvatar(
        string $code,
        ?AuthDTO $auth,
    ): string {
        // Kanal Bilgisini Al
        $channel = $this->channelRepository->findByCode($code);

        // Kanal Yoksa veya Avatar Fotoğrafı Yoksa
        if (!$channel || !$channel->avatar_path) {
            throw new NotFoundException();
        }

        // Görüntüleme Yetkisi Yoksa
        if (!ChannelPolicy::canView($auth, $channel)) {
            throw new AuthorizationException();
        }

        // Dosyanın Tam Yolunu Döndür
        return $this->pathHelper->uploads($channel->avatar_path);
    }

    public function getChannelBanner(
        string $code,
        ?AuthDTO $auth,
    ): string {
        // Kanal Bilgisini Al
        $channel = $this->channelRepository->findByCode($code);

        // Kanal Yoksa veya Banner Fotoğrafı Yoksa
        if (!$channel || !$channel->banner_path) {
            throw new NotFoundException();
        }

        // Görüntüleme Yetkisi Yoksa
        if (!ChannelPolicy::canView($auth, $channel)) {
            throw new AuthorizationException();
        }

        // Dosyanın Tam Yolunu Döndür
        return $this->pathHelper->uploads($channel->banner_path);
    }

    // --------------------------------------------------------------------------
    // CATEGORY
    // --------------------------------------------------------------------------

    public function getCategoryBanner(
        string $code,
        ?AuthDTO $auth,
    ): string {
        // Kategori Bilgisini Al
        $category = $this->categoryRepository->findDetailsByCode($code);

        // Kategori Yoksa veya Banner Fotoğrafı Yoksa
        if (!$category || !$category->banner_path) {
            throw new NotFoundException();
        }

        // Görüntüleme Yetkisi Yoksa
        if (!CategoryPolicy::canView($auth, $category)) {
            throw new AuthorizationException();
        }

        // Dosyanın Tam Yolunu Döndür
        return $this->pathHelper->uploads($category->banner_path);
    }

    // --------------------------------------------------------------------------
    // PLAYLIST
    // --------------------------------------------------------------------------

    public function getPlaylistBanner(
        string $code,
        ?AuthDTO $auth,
    ): string {
        // Oynatma Listesi Bilgisini Al
        $playlist = $this->playlistRepository->findByCode($code);

        // Oynatma Listesi Yoksa veya Banner Fotoğrafı Yoksa
        if (!$playlist || !$playlist->banner_path) {
            throw new NotFoundException();
        }

        // Görüntüleme Yetkisi Yoksa
        if (!PlaylistPolicy::canView($auth, $playlist)) {
            throw new AuthorizationException();
        }

        // Dosyanın Tam Yolunu Döndür
        return $this->pathHelper->uploads($playlist->banner_path);
    }

    // --------------------------------------------------------------------------
    // VIDEO
    // --------------------------------------------------------------------------

    public function getVideoThumbnail(
        string $code,
        ?AuthDTO $auth,
    ): string {
        // Video Bilgisini Al
        $video = $this->videoRepository->findByCode($code);

        // Video Yoksa veya Thumbnail Fotoğrafı Yoksa
        if (!$video || !$video->thumbnail_path) {
            throw new NotFoundException();
        }

        // Görüntüleme Yetkisi Yoksa
        if (!VideoPolicy::canView($auth, $video)) {
            throw new AuthorizationException();
        }

        // Dosyanın Tam Yolunu Döndür
        return $this->pathHelper->uploads($video->thumbnail_path);
    }

    public function getVideoFile(
        string $code,
        ?AuthDTO $auth,
    ): string {
        // Video Bilgisini Al
        $video = $this->videoRepository->findByCode($code);

        // Video Yoksa
        if (!$video) {
            throw new NotFoundException();
        }

        // Görüntüleme Yetkisi Yoksa
        if (!VideoPolicy::canView($auth, $video)) {
            throw new AuthorizationException();
        }

        // Dosyanın Tam Yolunu Döndür
        return $this->pathHelper->uploads($video->file_path);
    }

    // --------------------------------------------------------------------------
    // SHORT
    // --------------------------------------------------------------------------

    public function getShortThumbnail(
        string $code,
        ?AuthDTO $auth,
    ): string {
        // Kısa Video Bilgisini Al
        $short = $this->shortRepository->findByCode($code);

        // Kısa Video Yoksa veya Thumbnail Fotoğrafı Yoksa
        if (!$short || !$short->thumbnail_path) {
            throw new NotFoundException();
        }

        // Görüntüleme Yetkisi Yoksa
        if (!VideoPolicy::canView($auth, $short)) {
            throw new AuthorizationException();
        }

        // Dosyanın Tam Yolunu Döndür
        return $this->pathHelper->uploads($short->thumbnail_path);
    }

    public function getShortFile(
        string $code,
        ?AuthDTO $auth,
    ): string {
        // Kısa Video Bilgisini Al
        $short = $this->shortRepository->findByCode($code);

        // Kısa Video Yoksa
        if (!$short) {
            throw new NotFoundException();
        }

        // Görüntüleme Yetkisi Yoksa
        if (!VideoPolicy::canView($auth, $short)) {
            throw new AuthorizationException();
        }

        // Dosyanın Tam Yolunu Döndür
        return $this->pathHelper->uploads($short->file_path);
    }

    // --------------------------------------------------------------------------
    // MUSIC
    // --------------------------------------------------------------------------

    public function getMusicThumbnail(
        string $code,
        ?AuthDTO $auth,
    ): string {
        // Müzik Bilgisini Al
        $music = $this->musicRepository->findByCode($code);

        // Müzik Yoksa veya Thumbnail Fotoğrafı Yoksa
        if (!$music || !$music->thumbnail_path) {
            throw new NotFoundException();
        }

        // Görüntüleme Yetkisi Yoksa
        if (!VideoPolicy::canView($auth, $music)) {
            throw new AuthorizationException();
        }

        // Dosyanın Tam Yolunu Döndür
        return $this->pathHelper->uploads($music->thumbnail_path);
    }

    public function getMusicFile(
        string $code,
        ?AuthDTO $auth,
    ): string {
        // Müzik Bilgisini Al
        $music = $this->musicRepository->findByCode($code);

        // Müzik Yoksa
        if (!$music) {
            throw new NotFoundException();
        }

        // Görüntüleme Yetkisi Yoksa
        if (!VideoPolicy::canView($auth, $music)) {
            throw new AuthorizationException();
        }

        // Dosyanın Tam Yolunu Döndür
        return $this->pathHelper->uploads($music->file_path);
    }
}
