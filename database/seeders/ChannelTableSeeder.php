<?php
// ============================================================================
// File:    ChannelTableSeeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Database\Seeders;


class ChannelTableSeeder extends Seeder
{
    // --------------------------------------------------------------------------
    // CONSTANTS
    // --------------------------------------------------------------------------

    public const COUNT = UserTableSeeder::COUNT + 80;

    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "channel";
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
            strtotime("2021-12-31 23:59:59"),
            self::COUNT - UserTableSeeder::COUNT,
        );

        // Verileri Oluştur
        foreach ($dates as $i => $date) {
            $this->createUnique(
                mt_rand(1, UserTableSeeder::COUNT),
                "@kanal" . ($i + 1 + UserTableSeeder::COUNT),
                "Kanal " . ($i + 1 + UserTableSeeder::COUNT),
                $date,
            );
        }
    }

    // --------------------------------------------------------------------------
    // DOWN
    // --------------------------------------------------------------------------

    public function Down() {}

    // --------------------------------------------------------------------------
    // DOWN
    // --------------------------------------------------------------------------

    public function createUnique(int $user_id, string $name, string $title, string $created_at)
    {
        $this->create([
            "code" => $this->createUniqueCode(),
            "user_id" => $user_id,
            "name" => $name,
            "title" => $title,
            "created_at" => $created_at,
        ]);
    }
}
