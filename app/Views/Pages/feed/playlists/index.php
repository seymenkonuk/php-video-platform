<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Feed\PlaylistsPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$playlists = $model->playlists;
$pagination = $model->pagination;
$brandName = $model->brandName;
$csrfToken = $model->csrfToken;
$dateYear = $model->dateYear;
$navMenus = $model->navMenus;
$auth = $model->auth;
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/App", (array) new \App\Support\ViewProps\Layouts\AppViewProp(
    brandName: $brandName,
    title: "Oynatma Listelerin",
    description: "",
    csrfToken: $csrfToken,
    search: "",
    activeNav: "/feed/playlists",
    navMenus: $navMenus,
    dateYear: $dateYear,
    auth: $auth,
)) ?>

<!-- CONTENT -->
<!-- Sayfa Başlığı -->
<?= $this->insert("Components/Common/PageHeader", (array) new \App\Support\ViewProps\Components\Common\PageHeaderViewProp(
    icon: "bi-collection",
    title: "Oynatma Listelerin",
    description: "Oluşturduğun oynatma listeleri.",
)) ?>
<!-- Kategoriler -->
<?php if ($playlists->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Common/ResultCount", (array) new \App\Support\ViewProps\Components\Common\ResultCountViewProp(
        name: "oynatma listesi",
        count: $pagination->total,
    )); ?>
    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-5 md:grid-cols-2 2xl:grid-cols-3">
        <?php foreach ($playlists as $playlist): ?>
            <?= $this->insert("Components/Playlist/Card", (array) new \App\Support\ViewProps\Components\Playlist\CardViewProp(
                playlist: $playlist,
            )); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <?= $this->insert("Components/Common/EmptyState", (array) new \App\Support\ViewProps\Components\Common\EmptyStateViewProp(
        icon: 'bi-collection-play',
        title: 'Henüz oynatma listesi yok',
        description: 'Henüz hiç oynatma listesi oluşturmadınız',
    )) ?>
<?php endif ?>
<!-- Sayfalama -->
<section class="grid grid-cols-1 gap-4">
    <?= $this->insert("Components/Common/Pagination", (array) new \App\Support\ViewProps\Components\Common\PaginationViewProp(
        pagination: $pagination,
    )); ?>
</section>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>