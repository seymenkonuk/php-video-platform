<?php
// ============================================================================
// File:    CategoryTableSeeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Database\Seeders;


class CategoryTableSeeder extends Seeder
{
    // --------------------------------------------------------------------------
    // CONSTANTS
    // --------------------------------------------------------------------------

    public const COUNT = 20;

    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "category";
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

        // Verileri Oluştur
        foreach ($dates as $i => $date) {
            $this->create([
                "code" => $this->createUniqueCode(),
                "title" => "Kategori " . ($i + 1),
                "created_at" => $date,
            ]);
        }
    }

    // --------------------------------------------------------------------------
    // DOWN
    // --------------------------------------------------------------------------

    public function Down() {}
}
