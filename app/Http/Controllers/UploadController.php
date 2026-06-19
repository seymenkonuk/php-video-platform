<?php
// ============================================================================
// File:    UploadController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


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

    #[Get("/channels/{channel_code}/avatars/{file_name}")]
    #[Schema(GetChannelAvatarSchema::class)]
    public function GetChannelAvatar(string $channel_code, string $file_name): Response
    {
        return $this->response->file(__DIR__ . "/../../../storage/app/private/deneme.jpg");
    }

    #[Get("/channels/{channel_code}/banners/{file_name}")]
    #[Schema(GetChannelBannerSchema::class)]
    public function GetChannelBanner(string $channel_code, string $file_name): Response
    {
        return $this->response->file("");
    }

    #[Get("/categories/{category_code}/banners/{file_name}")]
    #[Schema(GetCategoryBannerSchema::class)]
    public function GetCategoryBanner(string $category_code, string $file_name): Response
    {
        return $this->response->file("");
    }

    #[Get("/playlists/{playlist_code}/banners/{file_name}")]
    #[Schema(GetPlaylistBannerSchema::class)]
    public function GetPlaylistBanner(string $playlist_code, string $file_name): Response
    {
        return $this->response->file("");
    }

    #[Get("/videos/{video_code}/{file_name}")]
    #[Schema(GetVideoFileSchema::class)]
    public function GetVideoFile(string $video_code, string $file_name): Response
    {
        return $this->response->file("");
    }

    #[Get("/videos/{video_code}/thumbnails/{file_name}")]
    #[Schema(GetVideoThumbnailSchema::class)]
    public function GetVideoThumbnail(string $video_code, string $file_name): Response
    {
        return $this->response->file("");
    }

    #[Get("/videos/{video_code}/captions/{file_name}")]
    #[Schema(GetVideoCaptionSchema::class)]
    public function GetVideoCaption(string $video_code, string $file_name): Response
    {
        return $this->response->file("");
    }

    #[Get("/shorts/{short_code}/{file_name}")]
    #[Schema(GetShortFileSchema::class)]
    public function GetShortFile(string $short_code, string $file_name): Response
    {
        return $this->response->file("");
    }

    #[Get("/shorts/{short_code}/thumbnails/{file_name}")]
    #[Schema(GetShortThumbnailSchema::class)]
    public function GetShortThumbnail(string $short_code, string $file_name): Response
    {
        return $this->response->file("");
    }

    #[Get("/shorts/{short_code}/captions/{file_name}")]
    #[Schema(GetShortCaptionSchema::class)]
    public function GetShortCaption(string $short_code, string $file_name): Response
    {
        return $this->response->file("");
    }

    #[Get("/musics/{music_code}/{file_name}")]
    #[Schema(GetMusicFileSchema::class)]
    public function GetMusicFile(string $music_code, string $file_name): Response
    {
        return $this->response->file("");
    }

    #[Get("/musics/{music_code}/thumbnails/{file_name}")]
    #[Schema(GetMusicThumbnailSchema::class)]
    public function GetMusicThumbnail(string $music_code, string $file_name): Response
    {
        return $this->response->file("");
    }

    #[Get("/musics/{music_code}/captions/{file_name}")]
    #[Schema(GetMusicCaptionSchema::class)]
    public function GetMusicCaption(string $music_code, string $file_name): Response
    {
        return $this->response->file("");
    }
}
