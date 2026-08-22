<?php
// ============================================================================
// File:    ChannelInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Channel;


use Seymenkonuk\Framework\Attribute\Middleware;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Http\Middlewares\ComponentResponseMiddleware;
use App\Http\Schemas\Channel\Interaction\SubscribeSchema;
use App\Http\Schemas\Channel\Interaction\UnsubscribeSchema;


#[Prefix("/channels")]
class ChannelInteractionController extends Controller
{
    #[Post("/{channelCode}/subscribe")]
    #[Schema(SubscribeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Subscribe(IResponse $response): IResponse
    {
        return $response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{channelCode}/unsubscribe")]
    #[Schema(UnsubscribeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Unsubscribe(IResponse $response): IResponse
    {
        return $response->html("<p>VideoPlatform</p>");
    }
}
