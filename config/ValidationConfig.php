<?php
// ============================================================================
// File:    ValidationConfig.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Config;


class ValidationConfig
{
    //
    const ALLOWED_REDIRECT_URI = [
        "/",
        "/register",
        "/login",
    ];

    // Ülkeler
    const ALLOWED_COUNTRIES = [
        "Türkiye",
    ];

    // Dosya İzinleri
    const KB = 1024;
    const MB = 1024 * self::KB;

    const ALLOWED_AVATAR_MIME_TYPES = ["image/png", "image/jpeg"];
    const ALLOWED_AVATAR_EXTENSIONS = [".png", ".jpg", ".jpeg"];
    const INVALID_AVATAR_ERROR = "Yalnızca PNG, JPG ve JPEG dosyalarına izin veriliyor!";
    const AVATAR_MIN_FILE_SIZE = 0;
    const AVATAR_MAX_FILE_SIZE = 16 * self::MB;

    const ALLOWED_BANNER_MIME_TYPES = ["image/png", "image/jpeg", "image/gif"];
    const ALLOWED_BANNER_EXTENSIONS = [".png", ".jpg", ".jpeg", ".gif"];
    const INVALID_BANNER_ERROR = "Yalnızca PNG, JPG, JPEG ve GIF dosyalarına izin veriliyor!";
    const BANNER_MIN_FILE_SIZE = 0;
    const BANNER_MAX_FILE_SIZE = 64 * self::MB;

    const ALLOWED_THUMBNAIL_MIME_TYPES = ["image/png", "image/jpeg"];
    const ALLOWED_THUMBNAIL_EXTENSIONS = [".png", ".jpg", ".jpeg"];
    const INVALID_THUMBNAIL_ERROR = "Yalnızca PNG, JPG ve JPEG dosyalarına izin veriliyor!";
    const THUMBNAIL_MIN_FILE_SIZE = 0;
    const THUMBNAIL_MAX_FILE_SIZE = 32 * self::MB;

    const ALLOWED_CAPTION_MIME_TYPES = ["text/vtt", "text/plain"];
    const ALLOWED_CAPTION_EXTENSIONS = [".vtt", ".srt"];
    const INVALID_CAPTION_ERROR = "Yalnızca VTT ve SRT dosyalarına izin veriliyor!";
    const CAPTION_MIN_FILE_SIZE = 0;
    const CAPTION_MAX_FILE_SIZE = 1 * self::MB;

    const ALLOWED_VIDEO_MIME_TYPES = ["video/mp4"];
    const ALLOWED_VIDEO_EXTENSIONS = [".mp4"];
    const INVALID_VIDEO_ERROR = "Yalnızca MP4 dosyalarına izin veriliyor!";
    const VIDEO_MIN_FILE_SIZE = 0;
    const VIDEO_MAX_FILE_SIZE = 512 * self::MB;

    const ALLOWED_SHORT_MIME_TYPES = ["video/mp4"];
    const ALLOWED_SHORT_EXTENSIONS = [".mp4"];
    const INVALID_SHORT_ERROR = "Yalnızca MP4 dosyalarına izin veriliyor!";
    const SHORT_MIN_FILE_SIZE = 0;
    const SHORT_MAX_FILE_SIZE = 256 * self::MB;

    const ALLOWED_MUSIC_MIME_TYPES = ["audio/mpeg"];
    const ALLOWED_MUSIC_EXTENSIONS = [".mp3"];
    const INVALID_MUSIC_ERROR = "Yalnızca MP3 dosyalarına izin veriliyor!";
    const MUSIC_MIN_FILE_SIZE = 0;
    const MUSIC_MAX_FILE_SIZE = 128 * self::MB;

    // Erişim İzinleri
    const VIEW_TYPES = ["0", "1", "2"];
    const COMMENT_TYPES = ["0", "1"];

    // Arama Filtreleri
    const CONTENT_TYPE_FILTERS = ["video", "music", "short", "channel", "playlist"];
    const DURATION_FILTERS = ["short", "medium", "long"];
    const SORT_FILTERS = ["views", "recent", "rating", "duration"];
    const DATE_FILTERS = ["today", "week", "month", "year"];
}
