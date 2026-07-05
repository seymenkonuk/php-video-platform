<!-- PARAMETERS -->
<?php

use App\Support\DTOs\AuthDTO;

/** @var string $brandName  */
/** @var string $title  */
/** @var ?string $description  */
/** @var ?string $csrfToken  */
/** @var ?string $search  */
/** @var ?string $activeNav  */
/** @var ?array<mixed> $navMenus  */
/** @var string $dateYear  */
/** @var ?AuthDTO $auth  */

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
        ["href" => "/studio", "text" => "Genel Bakış", "icon" => "bi-grid"],
    ],
    "İçerik yönetimi" => [
        ["href" => "/studio/channels", "text" => "Kanallar", "icon" => "bi-people"],
        ["href" => "/studio/videos", "text" => "Videolar", "icon" => "bi-play-btn"],
        ["href" => "/studio/shorts", "text" => "Shorts", "icon" => "bi-lightning-charge"],
        ["href" => "/studio/musics", "text" => "Müzikler", "icon" => "bi-music-note-beamed"],
        ["href" => "/studio/playlists", "text" => "Oynatma Listeleri", "icon" => "bi-collection-play"],
    ],
    "Platform" => [
        ["href" => "/", "text" => "Siteye Dön", "icon" => "bi-arrow-left"],
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