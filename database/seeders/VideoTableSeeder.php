<?php
// ============================================================================
// File:    VideoTableSeeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Database\Seeders;


use App\Domain\Enums\CommentType;
use App\Domain\Enums\VideoType;
use App\Domain\Enums\ViewType;


class VideoTableSeeder extends Seeder
{
    // --------------------------------------------------------------------------
    // CONSTANTS
    // --------------------------------------------------------------------------

    public const COUNT = 1000;

    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "video";
    protected string $primaryKey = "code";
    protected string $model = "";

    // --------------------------------------------------------------------------
    // UP
    // --------------------------------------------------------------------------

    public function Up()
    {
        // Rastgele Tarih Üret
        $dates = $this->generateRandomDates(
            strtotime("2021-01-01 00:00:00"),
            strtotime("2025-12-31 23:59:59"),
            self::COUNT,
        );

        // Video Tiplerinin Adetleri
        $videosCount = array_fill(0, count(VideoType::cases()), 1);

        // Verileri Oluştur
        foreach ($dates as $i => $date) {
            $video_type = mt_rand(0, count(VideoType::cases()) - 1);
            $view_type = mt_rand(0, count(ViewType::cases()) - 1);
            $comment_type = mt_rand(0, count(CommentType::cases()) - 1);

            $duration = match ($video_type) {
                VideoType::SHORT->value => mt_rand(10, 100),
                VideoType::MUSIC->value => mt_rand(100, 300),
                default => mt_rand(300, 10000),
            };

            $this->create([
                "code" => $this->createUniqueCode(),
                "title" => VideoType::from($video_type)->label() . " " . $videosCount[$video_type]++,
                "uploader_id" => mt_rand(1, ChannelTableSeeder::COUNT),
                "video_type" => $video_type,
                "view_type" => $view_type,
                "comment_type" => $comment_type,
                "file_path" => "",
                "duration" => $duration,
                "created_at" => $date,
            ]);
        }
    }

    // --------------------------------------------------------------------------
    // DOWN
    // --------------------------------------------------------------------------

    public function Down() {}
}
