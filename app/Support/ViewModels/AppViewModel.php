<?php
// ============================================================================
// File:    AppViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels;


use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\UI\MenuItemDTO;


class AppViewModel extends BaseViewModel
{
    /** @var array<string, array<MenuItemDTO>> $navMenus */
    public array $navMenus;
    public ?AuthDTO $auth = null;

    public function __construct()
    {
        parent::__construct();
        $this->auth = null;                 // Gerçek Değeri Al
        $this->navMenus = $this->menu();
    }

    /** @return array<string, array<MenuItemDTO>>  */
    private function menu(): array
    {
        return $this->auth === null
            ? $this->guestMenu()
            : $this->authMenu();
    }

    /** @return array<string, array<MenuItemDTO>>  */
    private function authMenu(): array
    {
        return [
            "" => $this->publicMenu(),
            "Sana Özel" => $this->feedMenu(),
            "Yönetim" => $this->studioMenu(),
        ];
    }

    /** @return array<string, array<MenuItemDTO>>  */
    private function guestMenu(): array
    {
        return [
            "" => $this->publicMenu(),
        ];
    }

    /** @return array<MenuItemDTO>  */
    private function publicMenu(): array
    {
        return [
            new MenuItemDTO("/", "Ana Sayfa", "bi-house-door"),
            new MenuItemDTO("/videos", "Videolar", "bi-play-btn"),
            new MenuItemDTO("/shorts", "Shorts", "bi-lightning-charge"),
            new MenuItemDTO("/musics", "Müzikler", "bi-music-note-beamed"),
            new MenuItemDTO("/channels", "Kanallar", "bi-people"),
            new MenuItemDTO("/categories", "Kategoriler", "bi-tags"),
            new MenuItemDTO("/playlists", "Listeler", "bi-collection-play"),
        ];
    }

    /** @return array<MenuItemDTO>  */
    private function feedMenu(): array
    {
        return [
            new MenuItemDTO("/feed", "Tüm İçerikler", "bi-stars"),
            new MenuItemDTO("/feed/channels", "Kanallar", "bi-person-video"),
            new MenuItemDTO("/feed/subscriptions", "Abonelikler", "bi-bell"),
            new MenuItemDTO("/feed/comments", "Yorumların", "bi-chat-left-text"),
            new MenuItemDTO("/feed/playlists", "Listelerin", "bi-collection"),
            new MenuItemDTO("/feed/watch-later", "Daha Sonra İzle", "bi-clock"),
            new MenuItemDTO("/feed/history", "Geçmiş", "bi-clock-history"),
            new MenuItemDTO("/feed/liked", "Beğendiklerin", "bi-hand-thumbs-up"),
        ];
    }

    /** @return array<MenuItemDTO>  */
    private function studioMenu(): array
    {
        return [
            new MenuItemDTO("/studio", "Yönetim", "bi-sliders2"),
        ];
    }
}
