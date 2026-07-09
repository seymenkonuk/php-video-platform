<?php
// ============================================================================
// File:    NumberHelper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Helpers;


class NumberHelper
{
    /**
     * Verilen sayıyı belirtilen ondalık basamağına göre kısaltılmış sayı formatına dönüştürür.
     * Örneğin: 1_300_000 → "1.3Mn", 4_645_000_000 → "4.645Mlr".
     * @param int      $number   Formatlanacak sayı.
     * @param int      $decimals Kullanılacak ondalık basamak sayısı.
     * @return string  Kısaltılmış ve formatlanmış sayı ifadesi.
     */
    public static function formatNumber(int $number, int $decimals = 1): string
    {
        if ($number >= 1000000000) {
            return self::truncate($number / 1000000000, $decimals) . 'Mlr';
        }
        if ($number >= 1000000) {
            return self::truncate($number / 1000000, $decimals) . 'Mn';
        }
        if ($number >= 1000) {
            return self::truncate($number / 1000, $decimals) . 'B';
        }

        return (string)$number;
    }

    /**
     * Verilen sayının virgülden sonraki kısmını, yuvarlama yapmadan 
     * belirtilen basamak sayısına göre keserek (kırparak) döndürür.
     * 
     * Örneğin: 3.1459, 2 -> 3.14 | 12.8999, 2 -> 12.89
     * 
     * @param float $number   İşlem yapılacak ondalık sayı.
     * @param int   $decimals Virgülden sonra tutulacak basamak sayısı (Varsayılan: 2).
     * @return float          Ondalık kısmı yuvarlanmadan kesilmiş sayı.
     */
    public static function truncate(float $number, int $decimals = 2): float
    {
        $multiplier = pow(10, $decimals);
        return floor($number * $multiplier) / $multiplier;
    }
}
