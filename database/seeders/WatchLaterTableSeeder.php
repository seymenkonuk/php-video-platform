<?php
// ============================================================================
// File:    WatchLaterTableSeeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Database\Seeders;


class WatchLaterTableSeeder extends Seeder
{
    // --------------------------------------------------------------------------
    // CONSTANTS
    // --------------------------------------------------------------------------

    public const COUNT = UserTableSeeder::COUNT * VideoTableSeeder::COUNT;

    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "watch_later";
    protected string $primaryKey = "id";
    protected string $model = "";

    // --------------------------------------------------------------------------
    // UP
    // --------------------------------------------------------------------------

    public function Up()
    {
        // İlişkileri Rastgele Oluştur
        $lists = $this->generateRandomRelations(VideoTableSeeder::COUNT, ChannelTableSeeder::COUNT);

        // Rastgele Tarih Üret
        $dates = $this->generateRandomDates(
            strtotime("2026-01-01 00:00:00"),
            time(),
            count($lists),
        );

        // Verileri Oluştur
        foreach ($dates as $i => $date) {
            $this->create([
                "video_id" => $lists[$i][0],
                "channel_id" => $lists[$i][1],
                "created_at" => $date,
            ]);
        }
    }

    // --------------------------------------------------------------------------
    // DOWN
    // --------------------------------------------------------------------------

    public function Down() {}
}
