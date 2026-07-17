<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Video\IndexPageViewModel $model  */
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
<?= $this->layout("Layouts/App", [
    "brandName" => $brandName,
    "title" => "Videolar",
    "description" => "",
    "csrfToken" => $csrfToken,
    "activeNav" => "/videos",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<!-- Sayfa Başlığı -->
<?= $this->insert("Components/Common/PageHeader", [
    "icon" => "bi-play-btn",
    "title" => "Videolar",
    "description" => "Platformdaki en yeni ve popüler videoları keşfet.",
]) ?>
<!-- Videolar -->
<?php if ($videos->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Common/ResultCount", [
        "count" => $pagination->total,
        "name" => "video",
    ]); ?>
    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-5 md:grid-cols-2 2xl:grid-cols-3">
        <?php foreach ($videos as $video): ?>
            <?= $this->insert("Components/Video/Card", [
                "video" => $video,
            ]); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <?= $this->insert("Components/Common/EmptyState", [
        "icon" => 'bi-play-btn',
        "title" => 'Henüz içerik yok',
        "description" => 'Bu platformda henüz hiç video yok',
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