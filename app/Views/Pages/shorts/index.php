<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Short\IndexPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$shorts = $model->shorts;
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
    title: "Kısa Videolar",
    description: "",
    csrfToken: $csrfToken,
    search: "",
    activeNav: "/shorts",
    navMenus: $navMenus,
    dateYear: $dateYear,
    auth: $auth,
)) ?>

<!-- CONTENT -->
<!-- Sayfa Başlığı -->
<?= $this->insert("Components/Common/PageHeader", (array) new \App\Support\ViewProps\Components\Common\PageHeaderViewProp(
    icon: "bi-lightning-charge",
    title: "Shorts",
    description: "Kısa, hızlı ve dikey içerikleri keşfet.",
)) ?>
<!-- Kısa Videolar -->
<?php if ($shorts->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Common/ResultCount", (array) new \App\Support\ViewProps\Components\Common\ResultCountViewProp(
        name: "kısa video",
        count: $pagination->total,
    )); ?>
    <!-- Sonuçlar -->
    <section class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5">
        <?php foreach ($shorts as $short): ?>
            <?= $this->insert("Components/Short/Card", (array) new \App\Support\ViewProps\Components\Short\CardViewProp(
                short: $short,
            )); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <?= $this->insert("Components/Common/EmptyState", (array) new \App\Support\ViewProps\Components\Common\EmptyStateViewProp(
        icon: "bi-lightning-charge",
        title: 'Henüz içerik yok',
        description: 'Bu platformda henüz hiç kısa video yok',
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