<?php
// ============================================================================
// File:    IUploadService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Abstract;


use Seymenkonuk\Framework\Http\Exception\NotFoundException;
use Seymenkonuk\Framework\Http\Exception\AuthorizationException;

use App\Support\DTOs\AuthDTO;


interface IUploadService
{
    // --------------------------------------------------------------------------
    // CHANNEL
    // --------------------------------------------------------------------------

    /**
     * Kanalın avatar fotoğrafının tam path bilgisini getirir.
     * 
     * @param string $code kanal kodu.
     * @param ?AuthDTO $auth kullanıcının kimliği.
     *
     * @throws NotFoundException dosya bulunamazsa.
     * @throws AuthorizationException görüntüleme yetkisi yoksa.
     * 
     * @return string
     */
    public function getChannelAvatar(
        string $code,
        ?AuthDTO $auth,
    ): string;

    /**
     * Kanalın banner fotoğrafının tam path bilgisini getirir.
     * 
     * @param string $code kanal kodu.
     * @param ?AuthDTO $auth kullanıcının kimliği.
     *
     * @throws NotFoundException dosya bulunamazsa.
     * @throws AuthorizationException görüntüleme yetkisi yoksa.
     * 
     * @return string
     */
    public function getChannelBanner(
        string $code,
        ?AuthDTO $auth,
    ): string;
    
    // --------------------------------------------------------------------------
    // CATEGORY
    // --------------------------------------------------------------------------

    /**
     * Kategorinin banner fotoğrafının tam path bilgisini getirir.
     * 
     * @param string $code kategori kodu.
     * @param ?AuthDTO $auth kullanıcının kimliği.
     *
     * @throws NotFoundException dosya bulunamazsa.
     * @throws AuthorizationException görüntüleme yetkisi yoksa.
     * 
     * @return string
     */
    public function getCategoryBanner(
        string $code,
        ?AuthDTO $auth,
    ): string;
    
    // --------------------------------------------------------------------------
    // PLAYLIST
    // --------------------------------------------------------------------------

    /**
     * Oynatma listesinin banner fotoğrafının tam path bilgisini getirir.
     * 
     * @param string $code oynatma listesi kodu.
     * @param ?AuthDTO $auth kullanıcının kimliği.
     *
     * @throws NotFoundException dosya bulunamazsa.
     * @throws AuthorizationException görüntüleme yetkisi yoksa.
     * 
     * @return string
     */
    public function getPlaylistBanner(
        string $code,
        ?AuthDTO $auth,
    ): string;
    
    // --------------------------------------------------------------------------
    // VIDEO
    // --------------------------------------------------------------------------

    /**
     * Videonun thumbnail fotoğrafının tam path bilgisini getirir.
     * 
     * @param string $code video kodu.
     * @param ?AuthDTO $auth kullanıcının kimliği.
     *
     * @throws NotFoundException dosya bulunamazsa.
     * @throws AuthorizationException görüntüleme yetkisi yoksa.
     * 
     * @return string
     */
    public function getVideoThumbnail(
        string $code,
        ?AuthDTO $auth,
    ): string;

    /**
     * Video dosyasının tam path bilgisini getirir.
     * 
     * @param string $code video kodu.
     * @param ?AuthDTO $auth kullanıcının kimliği.
     *
     * @throws NotFoundException dosya bulunamazsa.
     * @throws AuthorizationException görüntüleme yetkisi yoksa.
     * 
     * @return string
     */
    public function getVideoFile(
        string $code,
        ?AuthDTO $auth,
    ): string;
    
    // --------------------------------------------------------------------------
    // SHORT
    // --------------------------------------------------------------------------

    /**
     * Kısa videonun thumbnail fotoğrafının tam path bilgisini getirir.
     * 
     * @param string $code kısa video kodu.
     * @param ?AuthDTO $auth kullanıcının kimliği.
     *
     * @throws NotFoundException dosya bulunamazsa.
     * @throws AuthorizationException görüntüleme yetkisi yoksa.
     * 
     * @return string
     */
    public function getShortThumbnail(
        string $code,
        ?AuthDTO $auth,
    ): string;

    /**
     * Kısa video dosyasının tam path bilgisini getirir.
     * 
     * @param string $code kısa video kodu.
     * @param ?AuthDTO $auth kullanıcının kimliği.
     *
     * @throws NotFoundException dosya bulunamazsa.
     * @throws AuthorizationException görüntüleme yetkisi yoksa.
     * 
     * @return string
     */
    public function getShortFile(
        string $code,
        ?AuthDTO $auth,
    ): string;
    
    // --------------------------------------------------------------------------
    // MUSIC
    // --------------------------------------------------------------------------

    /**
     * Müziğin thumbnail fotoğrafının tam path bilgisini getirir.
     * 
     * @param string $code müzik kodu.
     * @param ?AuthDTO $auth kullanıcının kimliği.
     *
     * @throws NotFoundException dosya bulunamazsa.
     * @throws AuthorizationException görüntüleme yetkisi yoksa.
     * 
     * @return string
     */
    public function getMusicThumbnail(
        string $code,
        ?AuthDTO $auth,
    ): string;

    /**
     * Müzik dosyasının tam path bilgisini getirir.
     * 
     * @param string $code müzik kodu.
     * @param ?AuthDTO $auth kullanıcının kimliği.
     *
     * @throws NotFoundException dosya bulunamazsa.
     * @throws AuthorizationException görüntüleme yetkisi yoksa.
     * 
     * @return string
     */
    public function getMusicFile(
        string $code,
        ?AuthDTO $auth,
    ): string;
}
