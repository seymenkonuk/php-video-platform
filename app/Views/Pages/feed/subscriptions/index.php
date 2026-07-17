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
<?= $this->layout("Layouts/App", [
    "brandName" => $brandName,
    "title" => "Aboneliklerin",
    "description" => "",
    "csrfToken" => $csrfToken,
    "activeNav" => "/feed/subscriptions",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<!-- Sayfa Başlığı -->
<?= $this->insert("Components/Common/PageHeader", [
    "icon" => "bi-bell",
    "title" => "Abonelikler",
    "description" => "Takip ettiğin kanalların en yeni içerikleri.",
]) ?>
<!-- Videolar -->
<?php if ($videos->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Common/ResultCount", [
        "count" => $pagination->total,
        "name" => "video",
    ]); ?>
    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-4">
        <?php foreach ($videos as $video): ?>
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
        <?php endforeach ?>
    </section>
<?php else: ?>
    <?= $this->insert("Components/Common/EmptyState", [
        "icon" => 'bi-people',
        "title" => 'Henüz içerik yok',
        "description" => 'Takip ettiğiniz kanallar henüz içerik paylaşmadı',
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