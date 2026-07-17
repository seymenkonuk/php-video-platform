<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Channel\DetailsPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$header = $model->header;
$details = $model->details;
$brandName = $model->brandName;
$csrfToken = $model->csrfToken;
$dateYear = $model->dateYear;
$navMenus = $model->navMenus;
$navItems = $model->navItems;
$auth = $model->auth;
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/App", [
    "brandName" => $brandName,
    "title" => $header->title,
    "description" => "",
    "csrfToken" => $csrfToken,
    "activeNav" => "",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<!--  Kanal Header'ı -->
<section class="grid grid-cols-1 gap-4">
    <?= $this->insert("Components/Channel/Hero", [
        "header" => $header,
        "activeNav" => "{$header->url}/details",
        "navItems" => $navItems,
    ]); ?>
</section>
<!-- Kanal Hakkında -->
<section class="grid grid-cols-1 gap-4">
    <?= $this->insert("Components/Channel/About", [
        "details" => $details,
    ]); ?>
</section>
<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>