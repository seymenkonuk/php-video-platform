<?php
// ============================================================================
// File:    SubscribeType.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Enums;


enum SubscribeType: int
{
    case SELF_SUBSCRIBE_NOT_ALLOWED = -3;
    case GUEST_SUBSCRIBE_NOT_ALLOWED = -2;
    case NOT_SUBSCRIBED = -1;
    case NORMAL = 0;

    public function icon(): string
    {
        return match ($this) {
            self::SELF_SUBSCRIBE_NOT_ALLOWED => 'bi-bell-slash',
            self::GUEST_SUBSCRIBE_NOT_ALLOWED => 'bi-bell-slash',
            self::NOT_SUBSCRIBED => 'bi-bell',
            self::NORMAL => 'bi-bell-fill',
        };
    }

    public function title(): string
    {
        return match ($this) {
            self::SELF_SUBSCRIBE_NOT_ALLOWED => 'Kendine abone olamazsın',
            self::GUEST_SUBSCRIBE_NOT_ALLOWED => 'Abone olmak için giriş yapmalısın',
            self::NOT_SUBSCRIBED => 'Abone Ol',
            self::NORMAL => 'Abonelikten Çık',
        };
    }

    public function text(): string
    {
        return match ($this) {
            self::SELF_SUBSCRIBE_NOT_ALLOWED => 'Abone Ol',
            self::GUEST_SUBSCRIBE_NOT_ALLOWED => 'Abone Ol',
            self::NOT_SUBSCRIBED => 'Abone Ol',
            self::NORMAL => 'Abonelikten Çık',
        };
    }

    public function disabled(): bool
    {
        return match ($this) {
            self::SELF_SUBSCRIBE_NOT_ALLOWED => true,
            self::GUEST_SUBSCRIBE_NOT_ALLOWED => true,
            self::NOT_SUBSCRIBED => false,
            self::NORMAL => false,
        };
    }
}
