<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Feed\ChannelsPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$channels = $model->channels;
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
    title: "Abone Oldukların",
    description: "",
    csrfToken: $csrfToken,
    search: "",
    activeNav: "/feed/channels",
    navMenus: $navMenus,
    dateYear: $dateYear,
    auth: $auth,
)) ?>

<!-- CONTENT -->
<!-- Sayfa Başlığı -->
<?= $this->insert("Components/Common/PageHeader", (array) new \App\Support\ViewProps\Components\Common\PageHeaderViewProp(
    icon: "bi-person-video3",
    title: "Kanalların",
    description: "Takip ettiğin kanallar.",
)) ?>
<!-- Kategoriler -->
<?php if ($channels->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Common/ResultCount", (array) new \App\Support\ViewProps\Components\Common\ResultCountViewProp(
        name: "kanal",
        count: $pagination->total,
    )); ?>
    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-4">
        <?php foreach ($channels as $channel): ?>
            <?= $this->insert("Components/Channel/Card", (array) new \App\Support\ViewProps\Components\Channel\CardViewProp(
                channel: $channel,
            )); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <?= $this->insert("Components/Common/EmptyState", (array) new \App\Support\ViewProps\Components\Common\EmptyStateViewProp(
        icon: 'bi-play-btn',
        title: 'Henüz içerik yok',
        description: 'Henüz kimseye abone olmadınız',
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