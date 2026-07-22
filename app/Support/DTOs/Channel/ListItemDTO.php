<?php
// ============================================================================
// File:    ListItemDTO .php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Channel;


readonly class ListItemDTO
{
    public function __construct(
        public ?int            $order,
        public string          $url,
        public string          $title,
        public string          $avatar,
        public int             $subscriberCount,
        public string          $subscriberCountFormatted,
        public int             $videoCount,
        public string          $videoCountFormatted,
    ) {}
}
