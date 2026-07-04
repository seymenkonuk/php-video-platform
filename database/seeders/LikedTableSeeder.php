<?php
// ============================================================================
// File:    LikedTableSeeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Database\Seeders;


class LikedTableSeeder extends Seeder
{
    // --------------------------------------------------------------------------
    // CONSTANTS
    // --------------------------------------------------------------------------

    public const COUNT = UserTableSeeder::COUNT * VideoTableSeeder::COUNT;

    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "liked";
    protected string $primaryKey = "id";
    protected string $model = "";

    // --------------------------------------------------------------------------
    // UP
    // --------------------------------------------------------------------------

    public function Up()
    {
        // İlişkileri Rastgele Oluştur
        $likes = $this->generateRandomRelations(VideoTableSeeder::COUNT, ChannelTableSeeder::COUNT);

        // Rastgele Tarih Üret
        $dates = $this->generateRandomDates(
            strtotime("2026-01-01 00:00:00"),
            time(),
            count($likes),
        );

        // Verileri Oluştur
        foreach ($dates as $i => $date) {
            $this->create([
                "video_id" => $likes[$i][0],
                "channel_id" => $likes[$i][1],
                "type" => mt_rand(0, 1),
                "created_at" => $date,
            ]);
        }
    }

    // --------------------------------------------------------------------------
    // DOWN
    // --------------------------------------------------------------------------

    public function Down() {}
}
