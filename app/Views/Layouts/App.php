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
/** @var ?array<string, array<\App\Support\DTOs\MenuItemDTO>> $navMenus  */
/** @var string $dateYear  */
/** @var ?\App\Support\DTOs\AuthDTO $auth  */
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
    new \App\Support\DTOs\MenuItemDTO("/", "Ana Sayfa", "bi-house-door"),
    new \App\Support\DTOs\MenuItemDTO("/videos", "Videolar", "bi-play-btn"),
    new \App\Support\DTOs\MenuItemDTO("/shorts", "Shorts", "bi-lightning-charge"),
    new \App\Support\DTOs\MenuItemDTO("/musics", "Müzikler", "bi-music-note-beamed"),
    new \App\Support\DTOs\MenuItemDTO("/channels", "Kanallar", "bi-people"),
    new \App\Support\DTOs\MenuItemDTO("/categories", "Kategoriler", "bi-tags"),
    new \App\Support\DTOs\MenuItemDTO("/playlists", "Listeler", "bi-collection-play"),
];
// Sadece Giriş Yapmışlara Gösterilecek Feed Menüsü
$feedMenu = [
    new \App\Support\DTOs\MenuItemDTO("/feed", "Tüm İçerikler", "bi-stars"),
    new \App\Support\DTOs\MenuItemDTO("/feed/channels", "Kanallar", "bi-person-video"),
    new \App\Support\DTOs\MenuItemDTO("/feed/subscriptions", "Abonelikler", "bi-bell"),
    new \App\Support\DTOs\MenuItemDTO("/feed/comments", "Yorumların", "bi-chat-left-text"),
    new \App\Support\DTOs\MenuItemDTO("/feed/playlists", "Listelerin", "bi-collection"),
    new \App\Support\DTOs\MenuItemDTO("/feed/watch-later", "Daha Sonra İzle", "bi-clock"),
    new \App\Support\DTOs\MenuItemDTO("/feed/history", "Geçmiş", "bi-clock-history"),
    new \App\Support\DTOs\MenuItemDTO("/feed/liked", "Beğendiklerin", "bi-hand-thumbs-up"),
];
// Sadece Giriş Yapmışlara Gösterilecek Studio Menüsü
$studioMenu = [
    new \App\Support\DTOs\MenuItemDTO("/studio", "Yönetim", "bi-sliders2"),
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