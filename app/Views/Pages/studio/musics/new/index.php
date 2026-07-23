<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Studio\Music\CreatePageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$viewTypes = $model->viewTypes;
$commentTypes = $model->commentTypes;
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
    title: "Müzik Oluştur",
    description: "",
    csrfToken: $csrfToken,
    search: "",
    activeNav: "/studio/musics/new",
    navMenus: $navMenus,
    dateYear: $dateYear,
    auth: $auth,
)) ?>

<!-- CONTENT -->
<?= $this->insert("Forms/Music/Create", (array) new \App\Support\ViewProps\Forms\Music\CreateViewProp(
    errorMessages: $errorMessages,
    defaultValues: $defaultValues,
    viewTypes: $viewTypes,
    commentTypes: $commentTypes,
)) ?>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>