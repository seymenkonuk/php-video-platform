<?php
// ============================================================================
// File:    Subscription.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Models;


class Subscription
{
    public int      $subscriber_id;
    public int      $subscribed_id;
    public string   $subscribe_title;
    public int      $type;
    public string   $created_at;
    public ?string  $updated_at;
}
