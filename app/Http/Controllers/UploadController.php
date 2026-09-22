<?php
// ============================================================================
// File:    UploadController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Exception\NotFoundException;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\IUploadService;

use App\Http\Schemas\Upload\GetCategoryBannerSchema;
use App\Http\Schemas\Upload\GetChannelAvatarSchema;
use App\Http\Schemas\Upload\GetChannelBannerSchema;
use App\Http\Schemas\Upload\GetMusicCaptionSchema;
use App\Http\Schemas\Upload\GetMusicFileSchema;
use App\Http\Schemas\Upload\GetMusicThumbnailSchema;
use App\Http\Schemas\Upload\GetPlaylistBannerSchema;
use App\Http\Schemas\Upload\GetShortCaptionSchema;
use App\Http\Schemas\Upload\GetShortFileSchema;
use App\Http\Schemas\Upload\GetShortThumbnailSchema;
use App\Http\Schemas\Upload\GetVideoCaptionSchema;
use App\Http\Schemas\Upload\GetVideoFileSchema;
use App\Http\Schemas\Upload\GetVideoThumbnailSchema;


#[Prefix("/uploads")]
class UploadController extends Controller
{
    public function __construct(
        protected IAuthService $authService,
        protected IUploadService $uploadService,
    ) {}

    #[Get("/channels/{channelCode}/avatar")]
    #[Schema(GetChannelAvatarSchema::class)]
    public function GetChannelAvatar(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("channelCode", "");
        $auth = $this->authService->auth();

        // Servisi çağır
        $filePath = $this->uploadService->getChannelAvatar($code, $auth);

        // View model döndür
        return $response->file($filePath);
    }

    #[Get("/channels/{channelCode}/banner")]
    #[Schema(GetChannelBannerSchema::class)]
    public function GetChannelBanner(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("channelCode", "");
        $auth = $this->authService->auth();

        // Servisi çağır
        $filePath = $this->uploadService->getChannelBanner($code, $auth);

        // View model döndür
        return $response->file($filePath);
    }

    #[Get("/categories/{categoryCode}/banner")]
    #[Schema(GetCategoryBannerSchema::class)]
    public function GetCategoryBanner(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("categoryCode", "");
        $auth = $this->authService->auth();

        // Servisi çağır
        $filePath = $this->uploadService->getCategoryBanner($code, $auth);

        // View model döndür
        return $response->file($filePath);
    }

    #[Get("/playlists/{playlistCode}/banner")]
    #[Schema(GetPlaylistBannerSchema::class)]
    public function GetPlaylistBanner(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("playlistCode", "");
        $auth = $this->authService->auth();

        // Servisi çağır
        $filePath = $this->uploadService->getPlaylistBanner($code, $auth);

        // View model döndür
        return $response->file($filePath);
    }

    #[Get("/videos/{videoCode}/file")]
    #[Schema(GetVideoFileSchema::class)]
    public function GetVideoFile(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("videoCode", "");
        $auth = $this->authService->auth();

        // Servisi çağır
        $filePath = $this->uploadService->getVideoFile($code, $auth);

        // View model döndür
        return $response->file($filePath);
    }

    #[Get("/videos/{videoCode}/thumbnail")]
    #[Schema(GetVideoThumbnailSchema::class)]
    public function GetVideoThumbnail(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("videoCode", "");
        $auth = $this->authService->auth();

        // Servisi çağır
        $filePath = $this->uploadService->getVideoThumbnail($code, $auth);

        // View model döndür
        return $response->file($filePath);
    }

    #[Get("/videos/{videoCode}/captions/{languageCode}")]
    #[Schema(GetVideoCaptionSchema::class)]
    public function GetVideoCaption(): IResponse
    {
        throw new NotFoundException();
    }

    #[Get("/shorts/{shortCode}/file")]
    #[Schema(GetShortFileSchema::class)]
    public function GetShortFile(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("shortCode", "");
        $auth = $this->authService->auth();

        // Servisi çağır
        $filePath = $this->uploadService->getShortFile($code, $auth);

        // View model döndür
        return $response->file($filePath);
    }

    #[Get("/shorts/{shortCode}/thumbnail")]
    #[Schema(GetShortThumbnailSchema::class)]
    public function GetShortThumbnail(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("shortCode", "");
        $auth = $this->authService->auth();

        // Servisi çağır
        $filePath = $this->uploadService->getShortThumbnail($code, $auth);

        // View model döndür
        return $response->file($filePath);
    }

    #[Get("/shorts/{shortCode}/captions/{languageCode}")]
    #[Schema(GetShortCaptionSchema::class)]
    public function GetShortCaption(): IResponse
    {
        throw new NotFoundException();
    }

    #[Get("/musics/{musicCode}/file")]
    #[Schema(GetMusicFileSchema::class)]
    public function GetMusicFile(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("musicCode", "");
        $auth = $this->authService->auth();

        // Servisi çağır
        $filePath = $this->uploadService->getMusicFile($code, $auth);

        // View model döndür
        return $response->file($filePath);
    }

    #[Get("/musics/{musicCode}/thumbnail")]
    #[Schema(GetMusicThumbnailSchema::class)]
    public function GetMusicThumbnail(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("musicCode", "");
        $auth = $this->authService->auth();

        // Servisi çağır
        $filePath = $this->uploadService->getMusicThumbnail($code, $auth);

        // View model döndür
        return $response->file($filePath);
    }

    #[Get("/musics/{musicCode}/captions/{languageCode}")]
    #[Schema(GetMusicCaptionSchema::class)]
    public function GetMusicCaption(): IResponse
    {
        throw new NotFoundException();
    }
}
