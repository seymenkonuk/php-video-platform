<?php
// ============================================================================
// File:    SubscriptionDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Channel;


use App\Domain\Enums\SubscribeType;


readonly class SubscriptionDTO
{
    public function __construct(
        public SubscribeType    $type,
        public ?string          $title,
    ) {}
}
