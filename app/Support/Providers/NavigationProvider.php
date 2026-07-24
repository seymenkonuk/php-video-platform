<?php
// ============================================================================
// File:    NavigationProvider.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Providers;


use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Channel\HeaderDTO;
use App\Support\DTOs\UI\MenuItemDTO;


final class NavigationProvider
{
    /** @return array<string, array<MenuItemDTO>> */
    public function app(?AuthDTO $auth): array
    {
        if ($auth === null) {
            return [
                "" => $this->public(),
            ];
        }

        return [
            "" => $this->public(),
            "Sana Özel" => $this->feed(),
            "Yönetim" => [
                new MenuItemDTO("/studio", "Yönetim", "bi-sliders2"),
            ],
        ];
    }

    /** @return array<string, array<MenuItemDTO>> */
    public function studio(?AuthDTO $auth): array
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

    /** @return array<MenuItemDTO> */
    public function channel(HeaderDTO $header): array
    {
        return [
            new MenuItemDTO($header->url, "Anasayfa", ""),
            new MenuItemDTO($header->url . "/videos", "Videolar", ""),
            new MenuItemDTO($header->url . "/shorts", "Kısa Videolar", ""),
            new MenuItemDTO($header->url . "/musics", "Müzikler", ""),
            new MenuItemDTO($header->url . "/playlists", "Oynatma Listeleri", ""),
            new MenuItemDTO($header->url . "/subscriptions", "Abonelikler", ""),
            new MenuItemDTO($header->url . "/about", "Hakkında", ""),
        ];
    }

    /** @return array<MenuItemDTO> */
    private function public(): array
    {
        return [
            new MenuItemDTO("/", "Anasayfa", "bi-house-door"),
            new MenuItemDTO("/videos", "Videolar", "bi-play-btn"),
            new MenuItemDTO("/shorts", "Kısa Videolar", "bi-lightning-charge"),
            new MenuItemDTO("/musics", "Müzikler", "bi-music-note-beamed"),
            new MenuItemDTO("/channels", "Kanallar", "bi-people"),
            new MenuItemDTO("/categories", "Kategoriler", "bi-tags"),
            new MenuItemDTO("/playlists", "Listeler", "bi-collection-play"),
        ];
    }

    /** @return array<MenuItemDTO> */
    private function feed(): array
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
}
