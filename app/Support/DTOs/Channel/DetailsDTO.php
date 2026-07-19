<?php
// ============================================================================
// File:    DetailsDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Channel;


readonly class DetailsDTO
{
    public function __construct(
        public string          $url,
        public string          $title,
        public string          $avatar,
        public string          $banner,
        public SubscriptionDTO $subscription,
        public int             $subscriberCount,
        public string          $subscriberCountFormatted,
        public int             $videoCount,
        public string          $videoCountFormatted,
    ) {}
}
