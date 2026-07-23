<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Studio\Playlist\CreatePageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$viewTypes = $model->viewTypes;
$errorMessages = $model->errorMessages;
$defaultValues = $model->defaultValues;
$brandName = $model->brandName;
$csrfToken = $model->csrfToken;
$dateYear = $model->dateYear;
$navMenus = $model->navMenus;
$auth = $model->auth;
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/Studio", (array) new \App\Support\ViewProps\Layouts\StudioViewProp(
    brandName: $brandName,
    title: "Oynatma Listesi Oluştur",
    description: "",
    csrfToken: $csrfToken,
    search: "",
    activeNav: "/studio/playlists/new",
    navMenus: $navMenus,
    dateYear: $dateYear,
    auth: $auth,
)) ?>

<!-- CONTENT -->
<?= $this->insert("Forms/Playlist/Create", (array) new \App\Support\ViewProps\Forms\Playlist\CreateViewProp(
    errorMessages: $errorMessages,
    defaultValues: $defaultValues,
    viewTypes: $viewTypes,
)) ?>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>