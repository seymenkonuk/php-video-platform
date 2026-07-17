<?php
// ============================================================================
// File:    StudioViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels;


use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\UI\MenuItemDTO;


class StudioViewModel extends BaseViewModel
{
    /** @var array<string, array<MenuItemDTO>> $navMenus */
    public array $navMenus;
    public ?AuthDTO $auth = null;

    public function __construct()
    {
        parent::__construct();
        // Test Amaçlı Bir Auth Değeri Oluştur
        // İleride Auth Servisten Alınacak!
        $user = new \App\Domain\Models\User();
        $user->id = 1;
        $user->code = "1";
        $channel = new \App\Support\DTOs\Channel\ChannelDTO("/channels/1", "1", "Admin", "/uploads/channels/1/avatars/1");
        $this->auth = new AuthDTO($user, $channel);
        // 
        $this->navMenus = $this->menu();
    }

    /** @return array<string, array<MenuItemDTO>>  */
    private function menu(): array
    {
        return [
            "" => [
                new MenuItemDTO("/studio", "Genel Bakış", "bi-grid"),
            ],
            "Yönetim" => [
                new MenuItemDTO("/studio/channels", "Kanallar", "bi-people"),
                new MenuItemDTO("/studio/videos", "Videolar", "bi-play-btn"),
                new MenuItemDTO("/studio/shorts", "Kısa Videolar", "bi-lightning-charge"),
                new MenuItemDTO("/studio/musics", "Müzikler", "bi-music-note-beamed"),
                new MenuItemDTO("/studio/playlists", "Oynatma Listeleri", "bi-collection-play"),
            ],
            "Platform" => [
                new MenuItemDTO("/", "Siteye Dön", "bi-arrow-left"),
            ],
        ];
    }
}
