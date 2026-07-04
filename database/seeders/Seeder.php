<?php
// ============================================================================
// File:    Seeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Database\Seeders;


use Config\ValidationConfig;

use Seymenkonuk\Framework\Repository;


abstract class Seeder extends Repository
{
    // --------------------------------------------------------------------------
    // METHODS
    // --------------------------------------------------------------------------

    abstract public function Up();
    abstract public function Down();

    // --------------------------------------------------------------------------
    // RANDOM UNIQUE CODE
    // --------------------------------------------------------------------------

    protected function createUniqueCode(): string
    {
        do {
            // CODE_MAX_LEN uzunluğunda HEX üret
            $code = substr(bin2hex(random_bytes(ValidationConfig::CODE_MAX_LEN)), 0, ValidationConfig::CODE_MAX_LEN);
        } while ($this->exists($code));

        return $code;
    }

    // --------------------------------------------------------------------------
    // RANDOM RELATIONS
    // --------------------------------------------------------------------------

    protected function generateRandomRelations(
        int $primaryCount,
        int $relatedCount,
        int $minProbability = 0,
        int $maxProbability = 70,
    ): array {

        $result = [];

        for ($i = 1; $i <= $primaryCount; $i++) {
            // Bu kayıt için ilişki oluşturma olasılığını rastgele belirle.
            $chance = mt_rand($minProbability, $maxProbability);

            // Tüm ilişkili kayıtlar üzerinde gezin.
            for ($j = 1; $j <= $relatedCount; $j++) {
                // Olasılık kontrolü başarılı olursa ilişkiyi listeye ekle.
                if (mt_rand(0, 100) <= $chance) {
                    $result[] = [$i, $j];
                }
            }
        }

        // Karıştır
        shuffle($result);

        // Sonucu Döndür
        return $result;
    }

    // --------------------------------------------------------------------------
    // RANDOM DATES
    // --------------------------------------------------------------------------

    protected function generateRandomDates(
        int $startTimestamp,
        int $endTimestamp,
        int $count,
    ): array {
        // İki tarih aralığında adet kadar sayı üret
        $timestamps = array_map(
            fn() => mt_rand($startTimestamp, $endTimestamp),
            range(1, $count)
        );

        // Sırala
        sort($timestamps);

        // Tarihe Dönüştür (Metin Formatında)
        return array_map(
            fn($timestamp) => date('Y-m-d H:i:s', $timestamp),
            $timestamps
        );
    }
}
