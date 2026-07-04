<?php
// ============================================================================
// File:    UserTableSeeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Database\Seeders;


class UserTableSeeder extends Seeder
{
    // --------------------------------------------------------------------------
    // CONSTANTS
    // --------------------------------------------------------------------------

    public const COUNT = 20;

    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "user";
    protected string $primaryKey = "code";
    protected string $model = "";

    // --------------------------------------------------------------------------
    // UP
    // --------------------------------------------------------------------------

    public function Up()
    {
        // Rastgele Tarih Üret
        $dates = $this->generateRandomDates(
            strtotime("2020-01-01 00:00:00"),
            strtotime("2020-12-31 23:59:59"),
            self::COUNT,
        );

        // İlk Kanallarını Üretebilmek için
        $channelSeeder = new ChannelTableSeeder($this->database);

        // Verileri Oluştur
        foreach ($dates as $i => $date) {
            $code = $this->createUniqueCode();
            $username = "User" . ($i + 1);
            // Kullanıcıları Oluştur
            $this->create([
                "code" => $code,
                "username" => $username,
                "email" => strtolower($username) . "@emrotube.local",
                "name" => "İsim " . ($i + 1),
                "surname" => "Soyisim " . ($i + 1),
                "country" => "Türkiye",
                "password_hash" => password_hash($username, PASSWORD_DEFAULT),
                "created_at" => $date,
            ]);
            // İlk Kanallarını Oluştur
            $channelSeeder->createUnique(
                ($i + 1),
                "@kanal" . ($i + 1),
                "Kanal " . ($i + 1),
                $date,
            );
            // Kullanıcının Aktif Kanalını Güncelle
            $this->update($code, [
                "active_channel_id" => ($i + 1),
            ]);
        }
    }

    // --------------------------------------------------------------------------
    // DOWN
    // --------------------------------------------------------------------------

    public function Down() {}
}
