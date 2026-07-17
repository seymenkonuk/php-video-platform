<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Playlist\IndexPageViewModel $model  */
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
<?= $this->layout("Layouts/App", [
    "brandName" => $brandName,
    "title" => "Oynatma Listeleri",
    "description" => "",
    "csrfToken" => $csrfToken,
    "activeNav" => "/playlists",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<!-- Sayfa Başlığı -->
<?= $this->insert("Components/Common/PageHeader", [
    "icon" => "bi-collection-play",
    "title" => "Oynatma Listeleri",
    "description" => "Bir araya getirilmiş içerik koleksiyonlarını keşfet.",
]) ?>
<!-- Oynatma Listeleri -->
<?php if ($playlists->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Common/ResultCount", [
        "count" => $pagination->total,
        "name" => "oynatma listesi",
    ]); ?>
    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-5 md:grid-cols-2 2xl:grid-cols-3">
        <?php foreach ($playlists as $playlist): ?>
            <?= $this->insert("Components/Playlist/Card", [
                "playlist" => $playlist,
            ]); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <?= $this->insert("Components/Common/EmptyState", [
        "icon" => 'bi-collection-play',
        "title" => 'Henüz oynatma listesi yok',
        "description" => 'Bu platformda henüz hiç oynatma listesi yok',
    ]) ?>
<?php endif ?>
<!-- Sayfalama -->
<section class="grid grid-cols-1 gap-4">
    <?= $this->insert("Components/Common/Pagination", [
        "pagination" => $pagination,
    ]); ?>
</section>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>