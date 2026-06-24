<?php
// ============================================================================
// File:    ChannelCardDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs;


readonly class ChannelCardDTO
{
    public function __construct(
        public string          $url,
        public string          $title,
        public string          $avatar,
        public SubscriptionDTO $subscription,
        public int             $subscriberCount,
        public string          $subscriberCountFormatted,
        public int             $videoCount,
        public string          $videoCountFormatted,
    ) {}
}
