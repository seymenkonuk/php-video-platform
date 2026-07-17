<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Feed\HistoryPageViewModel $model  */
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
<?= $this->layout("Layouts/App", [
    "brandName" => $brandName,
    "title" => "Geçmiş",
    "description" => "",
    "csrfToken" => $csrfToken,
    "activeNav" => "/feed/history",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<!-- Header -->
<section class="grid grid-cols-1 gap-4">
    <?= $this->insert("Components/Feed/Header", [
        "icon" => "bi-clock-history",
        "eyebrow" => "Kütüphane",
        "title" => "İzleme Geçmişi",
        "header" => $header,
    ]); ?>
</section>
<!-- Videolar -->
<?php if ($videos->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Common/ResultCount", [
        "count" => $pagination->total,
        "name" => "video",
    ]); ?>
    <!-- Sonuçlar -->
    <?php $flag = true; ?>
    <?php foreach ($videos as $video): ?>
        <?php if ($video !== null): ?>
            <!-- Video Kartını Göster -->
            <?php if ($video->type === \App\Domain\Enums\VideoType::VIDEO): ?>
                <?= $this->insert("Components/Video/ListItem", [
                    "video" => $video,
                ]); ?>
            <?php elseif ($video->type === \App\Domain\Enums\VideoType::SHORT): ?>
                <?= $this->insert("Components/Short/ListItem", [
                    "short" => $video,
                ]); ?>
            <?php elseif ($video->type === \App\Domain\Enums\VideoType::MUSIC): ?>
                <?= $this->insert("Components/Music/ListItem", [
                    "music" => $video,
                ]); ?>
            <?php endif ?>
            <!-- Flagi Set Et -->
            <?php $flag = true; ?>
        <?php elseif ($flag): ?>
            <!-- Video Gösterilemiyorsa Bildir -->
            <?= $this->insert("Components/Common/SectionDivider", [
                "icon" => "bi-eye-slash",
                "text" => "Kullanılamayan videolar gizlendi",
            ]); ?>
            <!-- Flagi Set Et -->
            <?php $flag = false; ?>
        <?php endif ?>
    <?php endforeach ?>
<?php else: ?>
    <?= $this->insert("Components/Common/EmptyState", [
        "icon" => 'bi-play-btn',
        "title" => 'Henüz içerik yok',
        "description" => 'Geçmişinizde gösterilecek içerik bulunmuyor',
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