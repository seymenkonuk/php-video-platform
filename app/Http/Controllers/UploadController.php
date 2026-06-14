<?php
// ============================================================================
// File:    UploadController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;


#[Prefix("/uploads")]
class UploadController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Get("/channels/avatars/{filename")]
    public function GetChannelAvatar(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/channels/banners/{filename")]
    public function GetChannelBanner(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/categories/banners/{filename")]
    public function GetCategoryBanner(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/playlists/banners/{filename")]
    public function GetPlaylistBanner(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/videos/{filename")]
    public function GetVideoFile(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/videos/thumbnails/{filename")]
    public function GetVideoThumbnail(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/videos/captions/{filename")]
    public function GetVideoCaption(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/shorts/{filename")]
    public function GetShortFile(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/shorts/thumbnails/{filename")]
    public function GetShortThumbnail(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/shorts/captions/{filename")]
    public function GetShortCaption(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/musics/{filename")]
    public function GetMusicFile(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/musics/thumbnails/{filename")]
    public function GetMusicThumbnail(string $filename): Response
    {
        return $this->response->file("");
    }

    #[Get("/musics/captions/{filename")]
    public function GetMusicCaption(string $filename): Response
    {
        return $this->response->file("");
    }
}
