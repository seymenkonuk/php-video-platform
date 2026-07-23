<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Channel\SubscriptionsPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$header = $model->header;
$subscriptions = $model->subscriptions;
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
        activeNav: "{$header->url}/subscriptions",
    )); ?>
</section>
<!-- Oynatma Listeleri -->
<?php if ($subscriptions->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Common/ResultCount", (array) new \App\Support\ViewProps\Components\Common\ResultCountViewProp(
        name: "kanal",
        count: $pagination->total,
    )); ?>
    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-4">
        <?php foreach ($subscriptions as $channel): ?>
            <?= $this->insert("Components/Channel/Card", (array) new \App\Support\ViewProps\Components\Channel\CardViewProp(
                channel: $channel,
            )); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <?= $this->insert("Components/Common/EmptyState", (array) new \App\Support\ViewProps\Components\Common\EmptyStateViewProp(
        icon: 'bi-people',
        title: 'Henüz içerik yok',
        description: 'Bu kanal henüz kimseye abone değil',
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