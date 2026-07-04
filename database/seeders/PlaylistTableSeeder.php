<?php
// ============================================================================
// File:    PlaylistTableSeeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Database\Seeders;


use App\Domain\Enums\ViewType;


class PlaylistTableSeeder extends Seeder
{
    // --------------------------------------------------------------------------
    // CONSTANTS
    // --------------------------------------------------------------------------

    public const COUNT = 200;

    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "playlist";
    protected string $primaryKey = "code";
    protected string $model = "";

    // --------------------------------------------------------------------------
    // UP
    // --------------------------------------------------------------------------

    public function Up()
    {
        // Rastgele Tarih Üret
        $dates = $this->generateRandomDates(
            strtotime("2022-01-01 00:00:00"),
            strtotime("2022-12-31 23:59:59"),
            self::COUNT,
        );

        // Verileri Oluştur
        foreach ($dates as $i => $date) {
            $this->create([
                "code" => $this->createUniqueCode(),
                "channel_id" => mt_rand(1, ChannelTableSeeder::COUNT),
                "title" => "Liste " . ($i + 1),
                "view_type" => mt_rand(0, count(ViewType::cases()) - 1),
                "created_at" => $date,
            ]);
        }
    }

    // --------------------------------------------------------------------------
    // DOWN
    // --------------------------------------------------------------------------

    public function Down() {}
}
