<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Channel\MusicsPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$header = $model->header;
$musics = $model->musics;
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
        activeNav: "{$header->url}/musics",
    )); ?>
</section>
<!-- Müzikler -->
<?php if ($musics->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Common/ResultCount", (array) new \App\Support\ViewProps\Components\Common\ResultCountViewProp(
        name: "müzik",
        count: $pagination->total,
    )); ?>
    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
        <?php foreach ($musics as $music): ?>
            <?= $this->insert("Components/Music/Card", (array) new \App\Support\ViewProps\Components\Music\CardViewProp(
                music: $music,
            )); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <?= $this->insert("Components/Common/EmptyState", (array) new \App\Support\ViewProps\Components\Common\EmptyStateViewProp(
        icon: 'bi-people',
        title: 'Henüz içerik yok',
        description: 'Bu kanalda henüz hiç müzik yok',
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