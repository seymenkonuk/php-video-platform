<?php
// ============================================================================
// File:    UploadController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use Config\DefaultImageConfig;

use App\Http\Schemas\Upload\GetChannelAvatarSchema;
use App\Http\Schemas\Upload\GetChannelBannerSchema;
use App\Http\Schemas\Upload\GetCategoryBannerSchema;
use App\Http\Schemas\Upload\GetPlaylistBannerSchema;
use App\Http\Schemas\Upload\GetVideoFileSchema;
use App\Http\Schemas\Upload\GetVideoThumbnailSchema;
use App\Http\Schemas\Upload\GetVideoCaptionSchema;
use App\Http\Schemas\Upload\GetShortFileSchema;
use App\Http\Schemas\Upload\GetShortThumbnailSchema;
use App\Http\Schemas\Upload\GetShortCaptionSchema;
use App\Http\Schemas\Upload\GetMusicFileSchema;
use App\Http\Schemas\Upload\GetMusicThumbnailSchema;
use App\Http\Schemas\Upload\GetMusicCaptionSchema;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;


#[Prefix("/uploads")]
class UploadController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Get("/channels/{channelCode}/avatars/{fileName}")]
    #[Schema(GetChannelAvatarSchema::class)]
    public function GetChannelAvatar(string $channelCode, string $fileName): Response
    {
        return $this->response->file(__DIR__ . "/../../../public" . DefaultImageConfig::DEFAULT_CHANNEL_AVATAR);
    }

    #[Get("/channels/{channelCode}/banners/{fileName}")]
    #[Schema(GetChannelBannerSchema::class)]
    public function GetChannelBanner(string $channelCode, string $fileName): Response
    {
        return $this->response->file(__DIR__ . "/../../../public" . DefaultImageConfig::DEFAULT_CHANNEL_BANNER);
    }

    #[Get("/categories/{categoryCode}/banners/{fileName}")]
    #[Schema(GetCategoryBannerSchema::class)]
    public function GetCategoryBanner(string $categoryCode, string $fileName): Response
    {
        return $this->response->file(__DIR__ . "/../../../public" . DefaultImageConfig::DEFAULT_CATEGORY_BANNER);
    }

    #[Get("/playlists/{playlistCode}/banners/{fileName}")]
    #[Schema(GetPlaylistBannerSchema::class)]
    public function GetPlaylistBanner(string $playlistCode, string $fileName): Response
    {
        return $this->response->file(__DIR__ . "/../../../public" . DefaultImageConfig::DEFAULT_PLAYLIST_BANNER);
    }

    #[Get("/videos/{videoCode}/{fileName}")]
    #[Schema(GetVideoFileSchema::class)]
    public function GetVideoFile(string $videoCode, string $fileName): Response
    {
        return $this->response->file("");
    }

    #[Get("/videos/{videoCode}/thumbnails/{fileName}")]
    #[Schema(GetVideoThumbnailSchema::class)]
    public function GetVideoThumbnail(string $videoCode, string $fileName): Response
    {
        return $this->response->file(__DIR__ . "/../../../public" . DefaultImageConfig::DEFAULT_VIDEO_THUMBNAIL);
    }

    #[Get("/videos/{videoCode}/captions/{fileName}")]
    #[Schema(GetVideoCaptionSchema::class)]
    public function GetVideoCaption(string $videoCode, string $fileName): Response
    {
        return $this->response->file("");
    }

    #[Get("/shorts/{shortCode}/{fileName}")]
    #[Schema(GetShortFileSchema::class)]
    public function GetShortFile(string $shortCode, string $fileName): Response
    {
        return $this->response->file("");
    }

    #[Get("/shorts/{shortCode}/thumbnails/{fileName}")]
    #[Schema(GetShortThumbnailSchema::class)]
    public function GetShortThumbnail(string $shortCode, string $fileName): Response
    {
        return $this->response->file(__DIR__ . "/../../../public" . DefaultImageConfig::DEFAULT_SHORT_THUMBNAIL);
    }

    #[Get("/shorts/{shortCode}/captions/{fileName}")]
    #[Schema(GetShortCaptionSchema::class)]
    public function GetShortCaption(string $shortCode, string $fileName): Response
    {
        return $this->response->file("");
    }

    #[Get("/musics/{musicCode}/{fileName}")]
    #[Schema(GetMusicFileSchema::class)]
    public function GetMusicFile(string $musicCode, string $fileName): Response
    {
        return $this->response->file("");
    }

    #[Get("/musics/{musicCode}/thumbnails/{fileName}")]
    #[Schema(GetMusicThumbnailSchema::class)]
    public function GetMusicThumbnail(string $musicCode, string $fileName): Response
    {
        return $this->response->file(__DIR__ . "/../../../public" . DefaultImageConfig::DEFAULT_MUSIC_THUMBNAIL);
    }

    #[Get("/musics/{musicCode}/captions/{fileName}")]
    #[Schema(GetMusicCaptionSchema::class)]
    public function GetMusicCaption(string $musicCode, string $fileName): Response
    {
        return $this->response->file("");
    }
}
