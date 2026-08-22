<?php
// ============================================================================
// File:    NotificationController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Http\Schemas\Notification\SubscribeSchema;


#[Prefix("/notifications")]
class NotificationController extends Controller
{
    #[Get("/subscribe")]
    #[Schema(SubscribeSchema::class)]
    public function Subscribe(IResponse $response): IResponse
    {
        return $response->html("<p>VideoPlatform</p>");
    }
}
