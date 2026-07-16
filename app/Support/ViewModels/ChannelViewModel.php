<?php
// ============================================================================
// File:    ChannelViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels;


use App\Support\DTOs\UI\MenuItemDTO;

use App\Support\DTOs\Channel\HeaderDTO;


class ChannelViewModel extends AppViewModel
{
    /** @var array<MenuItemDTO> $navItems */
    public array $navItems;
    public HeaderDTO $header;

    public function __construct(HeaderDTO $header)
    {
        parent::__construct();
        $this->header = $header;
        $this->navItems = $this->menu();
    }

    /** @return array<MenuItemDTO>  */
    private function menu(): array
    {
        return [
            new MenuItemDTO($this->header->url, "Anasayfa", ""),
            new MenuItemDTO($this->header->url . "/videos", "Videolar", ""),
            new MenuItemDTO($this->header->url . "/shorts", "Kısa Videolar", ""),
            new MenuItemDTO($this->header->url . "/musics", "Müzikler", ""),
            new MenuItemDTO($this->header->url . "/playlists", "Oynatma Listeleri", ""),
            new MenuItemDTO($this->header->url . "/subscriptions", "Abonelikler", ""),
            new MenuItemDTO($this->header->url . "/details", "Hakkında", ""),
        ];
    }
}
