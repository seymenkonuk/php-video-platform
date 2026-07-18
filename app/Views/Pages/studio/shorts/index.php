<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Studio\Short\IndexPageViewModel $model  */
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
<?= $this->layout("Layouts/Studio", [
    "brandName" => $brandName,
    "title" => "Yönetim",
    "description" => "",
    "csrfToken" => $csrfToken,
    "activeNav" => "/studio/shorts",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<!-- Oluştur Butonu -->
<section class="grid grid-cols-1">
    <?= $this->insert("Components/Form/LinkButton", [
        "href" => "/studio/shorts/new",
        "icon" => "bi-plus",
        "text" => "Yeni Oluştur",
        "color" => "bg-red-500",
        "hoverColor" => "bg-red-600",
        "textColor" => "text-white",
    ]); ?>
</section>
<!-- Videolar -->
<?php if ($shorts->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Common/ResultCount", [
        "count" => $pagination->total,
        "name" => "kısa video",
    ]); ?>
    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-4">
        <?php foreach ($shorts as $short): ?>
            <?= $this->insert("Components/Short/ListItem", [
                "short" => $short,
            ]); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <?= $this->insert("Components/Common/EmptyState", [
        "icon" => "bi-lightning-charge",
        "title" => 'Henüz kısa video yok',
        "description" => 'Henüz hiç kısa video oluşturmadınız',
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