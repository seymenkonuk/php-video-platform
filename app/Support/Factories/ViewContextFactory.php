<?php
// ============================================================================
// File:    ViewContextFactory.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Factories;


use App\Support\DTOs\Channel\HeaderDTO;

use App\Support\Providers\AuthProvider;
use App\Support\Providers\CommonViewDataProvider;
use App\Support\Providers\NavigationProvider;

use App\Support\ViewContexts\AppViewContext;
use App\Support\ViewContexts\AuthViewContext;
use App\Support\ViewContexts\BaseViewContext;
use App\Support\ViewContexts\ChannelViewContext;
use App\Support\ViewContexts\StudioViewContext;


final readonly class ViewContextFactory
{
    public function __construct(
        public CommonViewDataProvider $commonViewDataProvider,
        public NavigationProvider $navigationProvider,
        public AuthProvider $authProvider,
    ) {}

    public function base(): BaseViewContext
    {
        return new BaseViewContext(
            brandName: $this->commonViewDataProvider->brandName(),
            csrfToken: $this->commonViewDataProvider->csrfToken(),
            dateYear: $this->commonViewDataProvider->dateYear(),
        );
    }

    public function auth(): AuthViewContext
    {
        return new AuthViewContext(
            base: $this->base(),
        );
    }

    public function app(): AppViewContext
    {
        $auth = $this->authProvider->auth();

        return new AppViewContext(
            base: $this->base(),
            navMenus: $this->navigationProvider->app($auth),
            auth: $auth,
        );
    }

    public function studio(): StudioViewContext
    {
        $auth = $this->authProvider->auth();

        return new StudioViewContext(
            base: $this->base(),
            navMenus: $this->navigationProvider->studio($auth),
            auth: $auth,
        );
    }

    public function channel(HeaderDTO $header): ChannelViewContext
    {
        return new ChannelViewContext(
            app: $this->app(),
            header: $header,
            navItems: $this->navigationProvider->channel($header),
        );
    }
}
