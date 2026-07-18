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
<?= $this->layout("Layouts/Studio", [
    "brandName" => $brandName,
    "title" => "Oynatma Listesi Oluştur",
    "description" => "",
    "csrfToken" => $csrfToken,
    "activeNav" => "/studio/playlists/new",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<?= $this->insert("Forms/Playlist/Create", [
    "viewTypes" => $viewTypes,
    "errorMessages" => $errorMessages,
    "defaultValues" => $defaultValues,
]) ?>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>