<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Category\IndexPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$categories = $model->categories;
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
    "title" => "Kategoriler",
    "description" => "",
    "csrfToken" => $csrfToken,
    "activeNav" => "/categories",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<!-- Sayfa Başlığı -->
<?= $this->insert("Components/Common/PageHeader", [
    "icon" => "bi-tags",
    "title" => "Kategoriler",
    "description" => "İlgi alanına göre içerikleri keşfet.",
]) ?>
<!-- Kategoriler -->
<?php if ($categories->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Common/ResultCount", [
        "count" => $pagination->total,
        "name" => "kategori",
    ]); ?>
    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-5 md:grid-cols-2 2xl:grid-cols-3">
        <?php foreach ($categories as $category): ?>
            <?= $this->insert("Components/Category/Card", [
                "category" => $category,
            ]); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <?= $this->insert("Components/Common/EmptyState", [
        "icon" => 'bi-tags',
        "title" => 'Henüz kategori yok',
        "description" => 'Bu platformda henüz hiç kategori yok',
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