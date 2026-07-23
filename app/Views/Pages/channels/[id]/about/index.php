<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Channel\AboutPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$header = $model->header;
$about = $model->about;
$brandName = $model->brandName;
$csrfToken = $model->csrfToken;
$dateYear = $model->dateYear;
$navMenus = $model->navMenus;
$navItems = $model->navItems;
$auth = $model->auth;
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/App", (array) new \App\Support\ViewProps\Layouts\AppViewProp(
    brandName: $brandName,
    title: $header->title,
    description: "",
    csrfToken: $csrfToken,
    search: "",
    activeNav: "",
    navMenus: $navMenus,
    dateYear: $dateYear,
    auth: $auth,
)) ?>

<!-- CONTENT -->
<!--  Kanal Header'ı -->
<section class="grid grid-cols-1 gap-4">
    <?= $this->insert("Components/Channel/Hero", (array) new \App\Support\ViewProps\Components\Channel\HeroViewProp(
        header: $header,
        navItems: $navItems,
        activeNav: "{$header->url}/about",
    )); ?>
</section>
<!-- Kanal Hakkında -->
<section class="grid grid-cols-1 gap-4">
    <?= $this->insert("Components/Channel/About", (array) new \App\Support\ViewProps\Components\Channel\AboutViewProp(
        about: $about,
    )); ?>
</section>
<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>