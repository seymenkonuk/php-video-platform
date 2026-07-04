<?php
// ============================================================================
// File:    main.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .  "vendor" . DIRECTORY_SEPARATOR . "autoload.php");

use Database\Seeders\CategoryTableSeeder;
use Database\Seeders\UserTableSeeder;
use Database\Seeders\ChannelTableSeeder;
use Database\Seeders\PlaylistTableSeeder;
use Database\Seeders\VideoTableSeeder;
use Database\Seeders\SubscriptionTableSeeder;
use Database\Seeders\LikedTableSeeder;
use Database\Seeders\VideoCategoryTableSeeder;
use Database\Seeders\PlaylistVideoTableSeeder;
use Database\Seeders\HistoryTableSeeder;
use Database\Seeders\WatchLaterTableSeeder;

use Seymenkonuk\Framework\Database;

// Database'e Bağlan
$database = new Database();
$database->connect(
    getenv("DB_HOST"),
    getenv("DB_PORT"),
    getenv("DB_DATABASE"),
    getenv("DB_CHARSET"),
    getenv("DB_USERNAME"),
    getenv("DB_PASSWORD"),
);

// Kategorileri Oluştur
echo "\n1. Kategoriler Oluşturuluyor...";
$categoryTableSeeder = new CategoryTableSeeder($database);
$categoryTableSeeder->Up();

// Kullanıcıları ve İlk Kanallarını Oluştur
echo "\n2. Kullanıcılar Oluşturuluyor...";
$userTableSeeder = new UserTableSeeder($database);
$userTableSeeder->Up();

// Kanalları Oluştur
echo "\n3. Kanallar Oluşturuluyor...";
$channelTableSeeder = new ChannelTableSeeder($database);
$channelTableSeeder->Up();

// Oynatma Listelerini Oluştur
echo "\n4. Oynatma Listeleri Oluşturuluyor...";
$playlistTableSeeder = new PlaylistTableSeeder($database);
$playlistTableSeeder->Up();

// Videoları Oluştur
echo "\n5. Videolar Oluşturuluyor...";
$videoTableSeeder = new VideoTableSeeder($database);
$videoTableSeeder->Up();

// Kanallar Birbirine Abone Olsun (Rastgele)
echo "\n6. Abonelikler Oluşturuluyor...";
$subscriptionTableSeeder = new SubscriptionTableSeeder($database);
$subscriptionTableSeeder->Up();

// Videolara Beğeni Ekle (Rastgele)
echo "\n7. Videolar Beğenilenlere Ekleniyor...";
$likedTableSeeder = new LikedTableSeeder($database);
$likedTableSeeder->Up();

// Videoları Kategorilere Ekle (Rastgele)
echo "\n8. Videolar Kategorilere Ekleniyor...";
$videoCategoryTableSeeder = new VideoCategoryTableSeeder($database);
$videoCategoryTableSeeder->Up();

// Videoları Oynatma Listelerine Ekle (Rastgele)
echo "\n9. Videolar Oynatma Listelerine Ekleniyor...";
$playlistVideoTableSeeder = new PlaylistVideoTableSeeder($database);
$playlistVideoTableSeeder->Up();

// Videoları Geçmişe Ekle (Rastgele)
echo "\n10. Videolar Geçmişe Ekleniyor...";
$historyTableSeeder = new HistoryTableSeeder($database);
$historyTableSeeder->Up();

// Videoları Daha Sonra İzle Listesine Ekle (Rastgele)
echo "\n11. Videolar Daha Sonra İzleye Ekleniyor...";
$watchLaterTableSeeder = new WatchLaterTableSeeder($database);
$watchLaterTableSeeder->Up();
