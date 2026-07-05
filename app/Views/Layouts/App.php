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
$activeNav ??= "";
$navMenus ??= null;
$auth ??= null;

?>

<!-- CONSTANTS -->
<?php
// Herkese Gösterilecek Menü
$publicMenu = [
    ["href" => "/", "text" => "Ana Sayfa", "icon" => "bi-house-door"],
    ["href" => "/videos", "text" => "Videolar", "icon" => "bi-play-btn"],
    ["href" => "/shorts", "text" => "Shorts", "icon" => "bi-lightning-charge"],
    ["href" => "/musics", "text" => "Müzikler", "icon" => "bi-music-note-beamed"],
    ["href" => "/channels", "text" => "Kanallar", "icon" => "bi-people"],
    ["href" => "/categories", "text" => "Kategoriler", "icon" => "bi-tags"],
    ["href" => "/playlists", "text" => "Listeler", "icon" => "bi-collection-play"],
];
// Sadece Giriş Yapmışlara Gösterilecek Feed Menüsü
$feedMenu = [
    ["href" => "/feed", "text" => "Tüm İçerikler", "icon" => "bi-stars"],
    ["href" => "/feed/channels", "text" => "Kanallar", "icon" => "bi-person-video"],
    ["href" => "/feed/subscriptions", "text" => "Abonelikler", "icon" => "bi-bell"],
    ["href" => "/feed/comments", "text" => "Yorumların", "icon" => "bi-chat-left-text"],
    ["href" => "/feed/playlists", "text" => "Listelerin", "icon" => "bi-collection"],
    ["href" => "/feed/watch-later", "text" => "Daha Sonra İzle", "icon" => "bi-clock"],
    ["href" => "/feed/history", "text" => "Geçmiş", "icon" => "bi-clock-history"],
    ["href" => "/feed/liked", "text" => "Beğendiklerin", "icon" => "bi-hand-thumbs-up"],
];
// Sadece Giriş Yapmışlara Gösterilecek Studio Menüsü
$studioMenu = [
    ["href" => "/studio", "text" => "Yönetim", "icon" => "bi-sliders2"],
];
// Boşsa Auth Bilgisine Göre 
$navMenus ??= ($auth !== null) ? [
    "" => $publicMenu,
    "Sana Özel" => $feedMenu,
    "Yönetim" => $studioMenu,
] : [
    "" => $publicMenu,
];

?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/Document", [
    "brandName" => $brandName,
    "title" => $title,
    "description" => $description,
    "csrfToken" => $csrfToken,
]) ?>

<!-- CONTENT -->
<!-- Header -->
<?= $this->insert("Partials/Header", [
    "brandName" => $brandName,
    "search" => $search,
    "auth" => $auth,
]) ?>
<!-- Sidebar -->
<?= $this->insert("Partials/Sidebar", [
    "brandName" => $brandName,
    "activeNav" => $activeNav,
    "navMenus" => $navMenus,
    "auth" => $auth,
]) ?>

<div class="flex min-h-screen flex-col xl:pl-72">
    <main class="mx-auto flex w-full max-w-[1600px] flex-1 flex-col gap-6 px-4 pb-10 pt-36 sm:px-6 md:pt-24 xl:px-8">
        <!-- Content -->
        <?= $this->section('content') ?>
    </main>
    <!-- Footer -->
    <?= $this->insert("Partials/Footer", [
        "brandName" => $brandName,
        "dateYear" => $dateYear,
    ]) ?>
</div>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->section("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->section("styles") ?>
<?= $this->stop() ?>