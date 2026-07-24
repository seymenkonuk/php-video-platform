<?php
// ============================================================================
// File:    LayoutDataProvider.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Providers;


use App\Support\ViewProps\BaseViewProp;
use App\Support\ViewProps\Layouts\AppViewProp;
use App\Support\ViewProps\Layouts\AuthViewProp;
use App\Support\ViewProps\Layouts\DocumentViewProp;
use App\Support\ViewProps\Layouts\OfflineViewProp;
use App\Support\ViewProps\Layouts\StudioViewProp;


final readonly class LayoutDataProvider
{
    public function __construct(
        protected CommonViewDataProvider $commonViewDataProvider,
        protected NavigationProvider $navigationProvider,
        protected AuthProvider $authProvider,
    ) {}

    public function document(
        string $title,
        string $description = "",
    ): DocumentViewProp {
        return new DocumentViewProp(
            brandName: $this->commonViewDataProvider->brandName(),
            title: $title,
            description: $description,
            csrfToken: $this->commonViewDataProvider->csrfToken(),
        );
    }

    public function auth(
        string $title,
        string $description = "",
    ): AuthViewProp {
        return new AuthViewProp(
            brandName: $this->commonViewDataProvider->brandName(),
            title: $title,
            description: $description,
            csrfToken: $this->commonViewDataProvider->csrfToken(),
            dateYear: $this->commonViewDataProvider->dateYear(),
        );
    }

    public function app(
        string $title,
        string $description = "",
        string $search = "",
        string $activeNav = "",
    ): AppViewProp {
        $auth = $this->authProvider->auth();

        return new AppViewProp(
            brandName: $this->commonViewDataProvider->brandName(),
            title: $title,
            description: $description,
            csrfToken: $this->commonViewDataProvider->csrfToken(),
            search: $search,
            activeNav: $activeNav,
            navMenus: $this->navigationProvider->app($auth),
            dateYear: $this->commonViewDataProvider->dateYear(),
            auth: $auth,
        );
    }

    public function studio(
        string $title,
        string $description = "",
        string $search = "",
        string $activeNav = "",
    ): StudioViewProp {
        $auth = $this->authProvider->auth();

        return new StudioViewProp(
            brandName: $this->commonViewDataProvider->brandName(),
            title: $title,
            description: $description,
            csrfToken: $this->commonViewDataProvider->csrfToken(),
            search: $search,
            activeNav: $activeNav,
            navMenus: $this->navigationProvider->app($auth),
            dateYear: $this->commonViewDataProvider->dateYear(),
            auth: $auth,
        );
    }

    public function offline(
        string $title,
        string $description = "",
    ): OfflineViewProp {
        return new OfflineViewProp(
            brandName: $this->commonViewDataProvider->brandName(),
            title: $title,
            description: $description,
            navMenus: $this->navigationProvider->app(null),
            dateYear: $this->commonViewDataProvider->dateYear(),
        );
    }

    public function forLayout(
        string $layout,
        string $title,
        string $description = "",
    ): BaseViewProp {
        return match ($layout) {
            "Layouts/Document" => $this->document($title, $description),
            "Layouts/Auth" => $this->auth($title, $description),
            "Layouts/App" => $this->app($title, $description),
            "Layouts/Studio" => $this->studio($title, $description),
            "Layouts/Offline" => $this->offline($title, $description),
            default => $this->app($title, $description),
        };
    }
}
