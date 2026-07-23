<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Feed\LikedPageViewModel $model  */
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
$auth = $model->auth;
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/App", (array) new \App\Support\ViewProps\Layouts\AppViewProp(
    brandName: $brandName,
    title: "Beğendiklerin",
    description: "",
    csrfToken: $csrfToken,
    search: "",
    activeNav: "/feed/liked",
    navMenus: $navMenus,
    dateYear: $dateYear,
    auth: $auth,
)) ?>

<!-- CONTENT -->
<!-- Header -->
<section class="grid grid-cols-1 gap-4">
    <?= $this->insert("Components/Feed/Header", (array) new \App\Support\ViewProps\Components\Feed\HeaderViewProp(
        icon: "bi-hand-thumbs-up",
        eyebrow: "Kütüphane",
        title: "Beğendiğin Videolar",
        header: $header,
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
    <?php $flag = true; ?>
    <?php foreach ($videos as $video): ?>
        <?php if ($video !== null): ?>
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
            <!-- Flagi Set Et -->
            <?php $flag = true; ?>
        <?php elseif ($flag): ?>
            <!-- Video Gösterilemiyorsa Bildir -->
            <?= $this->insert("Components/Common/SectionDivider", (array) new \App\Support\ViewProps\Components\Common\SectionDividerViewProp(
                text: "Kullanılamayan videolar gizlendi",
                icon: "bi-eye-slash"
            )); ?>
            <!-- Flagi Set Et -->
            <?php $flag = false; ?>
        <?php endif ?>
    <?php endforeach ?>
<?php else: ?>
    <?= $this->insert("Components/Common/EmptyState", (array) new \App\Support\ViewProps\Components\Common\EmptyStateViewProp(
        icon: 'bi-hand-thumbs-up',
        title: 'Henüz içerik yok',
        description: 'Henüz bir içerik beğenmediniz',
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