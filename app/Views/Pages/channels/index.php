<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Channel\IndexPageViewModel $model  */
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
<?= $this->layout("Layouts/App", [
    "brandName" => $brandName,
    "title" => "Kanallar",
    "description" => "",
    "csrfToken" => $csrfToken,
    "activeNav" => "/channels",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<!-- Sayfa Başlığı -->
<?= $this->insert("Components/Common/PageHeader", [
    "icon" => "bi-people",
    "title" => "Kanallar",
    "description" => "Yeni içerik üreticileri ve topluluklar keşfet.",
]) ?>
<!-- Kategoriler -->
<?php if ($channels->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Common/ResultCount", [
        "count" => $pagination->total,
        "name" => "kanal",
    ]); ?>
    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-4">
        <?php foreach ($channels as $channel): ?>
            <?= $this->insert("Components/Channel/Card", [
                "channel" => $channel,
            ]); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <?= $this->insert("Components/Common/EmptyState", [
        "icon" => 'bi-people',
        "title" => 'Henüz kanal yok',
        "description" => 'Bu platformda henüz hiç kanal yok',
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