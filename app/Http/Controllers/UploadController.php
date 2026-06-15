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

    #[Get("/channels/avatars/{filename}")]
    #[Schema(GetChannelAvatarSchema::class)]
    public function GetChannelAvatar(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/channels/banners/{filename}")]
    #[Schema(GetChannelBannerSchema::class)]
    public function GetChannelBanner(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/categories/banners/{filename}")]
    #[Schema(GetCategoryBannerSchema::class)]
    public function GetCategoryBanner(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/playlists/banners/{filename}")]
    #[Schema(GetPlaylistBannerSchema::class)]
    public function GetPlaylistBanner(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/videos/{filename}")]
    #[Schema(GetVideoFileSchema::class)]
    public function GetVideoFile(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/videos/thumbnails/{filename}")]
    #[Schema(GetVideoThumbnailSchema::class)]
    public function GetVideoThumbnail(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/videos/captions/{filename}")]
    #[Schema(GetVideoCaptionSchema::class)]
    public function GetVideoCaption(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/shorts/{filename}")]
    #[Schema(GetShortFileSchema::class)]
    public function GetShortFile(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/shorts/thumbnails/{filename}")]
    #[Schema(GetShortThumbnailSchema::class)]
    public function GetShortThumbnail(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/shorts/captions/{filename}")]
    #[Schema(GetShortCaptionSchema::class)]
    public function GetShortCaption(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/musics/{filename}")]
    #[Schema(GetMusicFileSchema::class)]
    public function GetMusicFile(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/musics/thumbnails/{filename}")]
    #[Schema(GetMusicThumbnailSchema::class)]
    public function GetMusicThumbnail(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/musics/captions/{filename}")]
    #[Schema(GetMusicCaptionSchema::class)]
    public function GetMusicCaption(string $filename): Response
    {
        return $this->response->file("");
    }
}
