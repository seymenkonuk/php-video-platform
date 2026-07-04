<?php
// ============================================================================
// File:    SubscriptionTableSeeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Database\Seeders;


class SubscriptionTableSeeder extends Seeder
{
    // --------------------------------------------------------------------------
    // CONSTANTS
    // --------------------------------------------------------------------------

    public const COUNT = UserTableSeeder::COUNT * UserTableSeeder::COUNT;

    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "subscription";
    protected string $primaryKey = "id";
    protected string $model = "";

    // --------------------------------------------------------------------------
    // UP
    // --------------------------------------------------------------------------

    public function Up()
    {
        // İlişkileri Rastgele Oluştur
        $subscriptions = $this->generateRandomRelations(ChannelTableSeeder::COUNT, ChannelTableSeeder::COUNT);

        // Rastgele Tarih Üret
        $dates = $this->generateRandomDates(
            strtotime("2022-01-01 00:00:00"),
            time(),
            count($subscriptions),
        );

        // Verileri Oluştur
        foreach ($dates as $i => $date) {
            $this->create([
                "subscriber_id" => $subscriptions[$i][0],
                "subscribed_id" => $subscriptions[$i][1],
                "type" => 0,
                "created_at" => $date,
            ]);
        }
    }

    // --------------------------------------------------------------------------
    // DOWN
    // --------------------------------------------------------------------------

    public function Down() {}
}
