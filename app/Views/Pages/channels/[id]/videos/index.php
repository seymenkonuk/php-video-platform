<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Channel\VideosPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$header = $model->header;
$videos = $model->videos;
$pagination = $model->pagination;
$brandName = $model->brandName;
$csrfToken = $model->csrfToken;
$dateYear = $model->dateYear;
$navMenus = $model->navMenus;
$navItems = $model->navItems;
$auth = $model->auth;
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/App", (array) new \App\Support\ViewProps\Layouts\AppViewProp(
    brandName: $brandName,
    title: $header->title,
    description: "",
    csrfToken: $csrfToken,
    search: "",
    activeNav: "",
    navMenus: $navMenus,
    dateYear: $dateYear,
    auth: $auth,
)) ?>

<!-- CONTENT -->
<!--  Kanal Header'ı -->
<section class="grid grid-cols-1 gap-4">
    <?= $this->insert("Components/Channel/Hero", (array) new \App\Support\ViewProps\Components\Channel\HeroViewProp(
        header: $header,
        navItems: $navItems,
        activeNav: "{$header->url}/videos",
    )); ?>
</section>
<!-- Videolar -->
<?php if ($videos->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Common/ResultCount", (array) new \App\Support\ViewProps\Components\Common\ResultCountViewProp(
        name: "video",
        count: $pagination->total,
    )); ?>
    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-5 md:grid-cols-2 2xl:grid-cols-3">
        <?php foreach ($videos as $video): ?>
            <?= $this->insert("Components/Video/Card", (array) new \App\Support\ViewProps\Components\Video\CardViewProp(
                video: $video,
            )); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <?= $this->insert("Components/Common/EmptyState", (array) new \App\Support\ViewProps\Components\Common\EmptyStateViewProp(
        icon: 'bi-people',
        title: 'Henüz içerik yok',
        description: 'Bu kanalda henüz hiç video yok',
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