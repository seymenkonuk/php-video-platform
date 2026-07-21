<?php
// ============================================================================
// File:    TimeHelper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Helpers;


use DateTime;


class TimeHelper
{
    /**
     * Verilen tarih ile şu an arasındaki süreyi insan tarafından okunabilir bir biçimde döndürür.
     * Örneğin "1 saat önce", "3 ay önce", "2 dakika önce" gibi göreceli zaman ifadeleri üretir.
     * @param DateTime|string $date
     * @return string
     */
    public function timeAgo(DateTime|string $date): string
    {
        // Gelen parametreyi DateTime'a dönüştür
        if (is_string($date)) {
            $date = new DateTime($date);
        }

        // Geçen süreyi hesapla
        $now = new DateTime();
        $diff = $now->diff($date);

        // Farkı döndür
        if ($diff->y > 0) return $diff->y . ' yıl önce';
        if ($diff->m > 0) return $diff->m . ' ay önce';
        if ($diff->d > 0) return $diff->d . ' gün önce';
        if ($diff->h > 0) return $diff->h . ' saat önce';
        if ($diff->i > 0) return $diff->i . ' dakika önce';

        // Fark 1 Dk'den kısaysa döndür
        return 'az önce';
    }

    /**
     * Verilen toplam saniyeyi okunabilir, kısaltılmış bir süre formatına dönüştürür.
     * Örneğin "1s 17dk 43sn" veya "5dk 12sn" gibi çıktı üretir.
     * @param int $seconds
     * @return string
     */
    public function formatDuration(int $seconds): string
    {
        // Geçen süreyi hesapla
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        $parts = [];
        if ($hours > 0) {
            $parts[] = $hours . 's';
        }
        if ($minutes > 0) {
            $parts[] = $minutes . 'dk';
        }
        if ($seconds > 0 || empty($parts)) {
            $parts[] = $seconds . 'sn';
        }

        return implode(' ', $parts);
    }

    /**
     * Verilen toplam saniyeyi "HH:MM:SS" veya gerekirse "MM:SS" formatına dönüştürür.
     * Örneğin 200 saniye için "03:20", 20_400 saniye için "05:40:00" gibi çıktılar üretir.
     * @param int $seconds
     * @return string
     */
    public function formatTimer(int $seconds): string
    {
        // Geçen süreyi hesapla
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        // Bir saatten fazlaysa HH:MM:SS formatında döndür
        if ($hours > 0) {
            return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }

        // Bir saatten azsa MM:SS formatında döndür
        return sprintf('%02d:%02d', $minutes, $seconds);
    }
}
