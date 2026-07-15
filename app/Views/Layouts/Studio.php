<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $brandName  */
/** @var string $title  */
/** @var ?string $description  */
/** @var ?string $csrfToken  */
/** @var ?string $search  */
/** @var ?string $activeNav  */
/** @var ?array<string, array<\App\Support\DTOs\UI\MenuItemDTO>> $navMenus  */
/** @var string $dateYear  */
/** @var ?\App\Support\DTOs\AuthDTO $auth  */
?>

<!-- DEFAULT VALUE -->
<?php
$description ??= "";
$csrfToken ??= "";
$search ??= "";
$activeNav ??= "/studio";
$navMenus ??= null;
$auth ??= null;
?>

<!-- CONSTANTS -->
<?php
// Herkese Gösterilecek Menü
$navMenus ??= [
    "" => [
        new \App\Support\DTOs\UI\MenuItemDTO("/studio", "Genel Bakış", "bi-grid"),
    ],
    "İçerik yönetimi" => [
        new \App\Support\DTOs\UI\MenuItemDTO("/studio/channels", "Kanallar", "bi-people"),
        new \App\Support\DTOs\UI\MenuItemDTO("/studio/videos", "Videolar", "bi-play-btn"),
        new \App\Support\DTOs\UI\MenuItemDTO("/studio/shorts", "Shorts", "bi-lightning-charge"),
        new \App\Support\DTOs\UI\MenuItemDTO("/studio/musics", "Müzikler", "bi-music-note-beamed"),
        new \App\Support\DTOs\UI\MenuItemDTO("/studio/playlists", "Oynatma Listeleri", "bi-collection-play"),
    ],
    "Platform" => [
        new \App\Support\DTOs\UI\MenuItemDTO("/", "Siteye Dön", "bi-arrow-left"),
    ],
];
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/App", [
    "brandName" => $brandName,
    "title" => $title,
    "description" => $description,
    "csrfToken" => $csrfToken,
    "search" => $search,
    "activeNav" => $activeNav,
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<?= $this->section('content') ?>


<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->section("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->section("styles") ?>
<?= $this->stop() ?>