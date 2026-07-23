<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Feed\SubscriptionsPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$videos = $model->videos;
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
    title: "Aboneliklerin",
    description: "",
    csrfToken: $csrfToken,
    search: "",
    activeNav: "/feed/subscriptions",
    navMenus: $navMenus,
    dateYear: $dateYear,
    auth: $auth,
)) ?>

<!-- CONTENT -->
<!-- Sayfa Başlığı -->
<?= $this->insert("Components/Common/PageHeader", (array) new \App\Support\ViewProps\Components\Common\PageHeaderViewProp(
    icon: "bi-bell",
    title: "Abonelikler",
    description: "Takip ettiğin kanalların en yeni içerikleri.",
)) ?>
<!-- Videolar -->
<?php if ($videos->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Common/ResultCount", (array) new \App\Support\ViewProps\Components\Common\ResultCountViewProp(
        name: "video",
        count: $pagination->total,
    )); ?>
    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-4">
        <?php foreach ($videos as $video): ?>
            <!-- Video Kartını Göster -->
            <?php if ($video->type === \App\Domain\Enums\VideoType::VIDEO): ?>
                <?= $this->insert("Components/Video/ListItem", (array) new \App\Support\ViewProps\Components\Video\ListItemViewProp(
                    video: $video,
                )); ?>
            <?php elseif ($video->type === \App\Domain\Enums\VideoType::SHORT): ?>
                <?= $this->insert("Components/Short/ListItem", (array) new \App\Support\ViewProps\Components\Short\ListItemViewProp(
                    short: $video,
                )); ?>
            <?php elseif ($video->type === \App\Domain\Enums\VideoType::MUSIC): ?>
                <?= $this->insert("Components/Music/ListItem", (array) new \App\Support\ViewProps\Components\Music\ListItemViewProp(
                    music: $video,
                )); ?>
            <?php endif ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <?= $this->insert("Components/Common/EmptyState", (array) new \App\Support\ViewProps\Components\Common\EmptyStateViewProp(
        icon: 'bi-people',
        title: 'Henüz içerik yok',
        description: 'Takip ettiğiniz kanallar henüz içerik paylaşmadı',
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