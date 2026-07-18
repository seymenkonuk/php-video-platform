<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Studio\Short\CreatePageViewModel $model  */
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
<?= $this->layout("Layouts/Studio", [
    "brandName" => $brandName,
    "title" => "Kısa Video Oluştur",
    "description" => "",
    "csrfToken" => $csrfToken,
    "activeNav" => "/studio/shorts/new",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<?= $this->insert("Forms/Short/Create", [
    "commentTypes" => $commentTypes,
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