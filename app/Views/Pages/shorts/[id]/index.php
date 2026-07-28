<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Short\WatchPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$short = $model->short;
$startTime = $model->startTime;
$nextUrl = $model->nextUrl;
$commentList = $model->commentList;
$playlists = $model->playlists;
$activePlaylist = $model->activePlaylist;
$brandName = $model->brandName;
$csrfToken = $model->csrfToken;
$dateYear = $model->dateYear;
$navMenus = $model->navMenus;
$auth = $model->auth;
?>

<!-- CONSTANTS -->
<?php
$showPlaylistPanel = $activePlaylist !== null;
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/App", (array) new \App\Support\ViewProps\Layouts\AppViewProp(
    brandName: $brandName,
    title: $short->title,
    description: "",
    csrfToken: $csrfToken,
    search: "",
    activeNav: "",
    navMenus: $navMenus,
    dateYear: $dateYear,
    auth: $auth,
)) ?>

<!-- CONTENT -->
<div class="grid min-w-0 items-start gap-6 <?= $showPlaylistPanel ? '2xl:grid-cols-[minmax(0,1fr)_24rem]' : 'grid-cols-1' ?>">
    <div class="min-w-0 space-y-6">
        <!-- Kısa Video -->
        <?= $this->insert("Components/Short/Player", (array) new \App\Support\ViewProps\Components\Short\PlayerViewProp(
            poster: $short->thumbnail,
            source: $short->sourceUrl,
            startTime: $startTime,
            nextUrl: $nextUrl,
        )) ?>
        <!-- Kısa Video Detayları -->
        <?= $this->insert("Components/Short/Details", (array) new \App\Support\ViewProps\Components\Short\DetailsViewProp(
            short: $short,
            playlists: $playlists,
        )) ?>
        <!-- Yorum Listesi -->
        <?= $this->insert("Components/Comment/List", (array) new \App\Support\ViewProps\Components\Comment\ListViewProp(
            commentList: $commentList,
        )) ?>
    </div>
    <!-- Aktif Oynatma Listesi -->
    <?php if ($showPlaylistPanel): ?>
        <?= $this->insert("Components/Playlist/Panel", (array) new \App\Support\ViewProps\Components\Playlist\PanelViewProp(
            activePlaylist: $activePlaylist,
        )) ?>
    <?php endif ?>
</div>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>