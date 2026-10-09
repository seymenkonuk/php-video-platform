<?php
// ============================================================================
// File:    ChannelInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Channel;


use Seymenkonuk\Framework\Attribute\Auth\Authenticated;
use Seymenkonuk\Framework\Attribute\Middleware;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\IChannelService;

use App\Http\Middlewares\ComponentResponseMiddleware;
use App\Http\Schemas\Channel\Interaction\SubscribeSchema;
use App\Http\Schemas\Channel\Interaction\UnsubscribeSchema;

use App\Support\ViewProps\Components\Interaction\SubscribeViewProp;


#[Prefix("/channels")]
#[Authenticated]
class ChannelInteractionController extends Controller
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IAuthService $authService,
        protected IChannelService $channelService,
    ) {}

    // --------------------------------------------------------------------------
    // ACTIONS
    // --------------------------------------------------------------------------

    #[Post("/{channelCode}/subscribe")]
    #[Schema(SubscribeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Subscribe(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("channelCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $subscription = $this->channelService->subscribe($code, $auth);

        // Component döndür
        return $response->component("/Interaction/Subscribe", (array) new SubscribeViewProp(
            channelUrl: "/channels/{$code}",
            subscription: $subscription,
        ));
    }

    #[Post("/{channelCode}/unsubscribe")]
    #[Schema(UnsubscribeSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Unsubscribe(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("channelCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $subscription = $this->channelService->unsubscribe($code, $auth);

        // Component döndür
        return $response->component("/Interaction/Subscribe", (array) new SubscribeViewProp(
            channelUrl: "/channels/{$code}",
            subscription: $subscription,
        ));
    }
}
