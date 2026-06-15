<?php
// ============================================================================
// File:    ChannelInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Channel;


use App\Http\Schemas\Channel\Interaction\SubscribeSchema;
use App\Http\Schemas\Channel\Interaction\UnsubscribeSchema;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;


#[Prefix("/channels")]
class ChannelInteractionController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Post("/{channelCode}/subscribe")]
    #[Schema(SubscribeSchema::class)]
    public function Subscribe(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{channelCode}/unsubscribe")]
    #[Schema(UnsubscribeSchema::class)]
    public function Unsubscribe(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
