<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Studio\User\ChangePasswordPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
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
    title: "Parola Değiştir",
    description: "",
    csrfToken: $csrfToken,
    search: "",
    activeNav: "",
    navMenus: $navMenus,
    dateYear: $dateYear,
    auth: $auth,
)) ?>

<!-- CONTENT -->
<?= $this->insert("Forms/User/ChangePassword", (array) new \App\Support\ViewProps\Forms\User\ChangePasswordViewProp(
    errorMessages: $errorMessages,
    defaultValues: $defaultValues,
)) ?>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>