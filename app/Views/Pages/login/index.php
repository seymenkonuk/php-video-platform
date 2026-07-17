<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Auth\LoginPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$loginUri = $model->loginUri;
$registerUri = $model->registerUri;
$errorMessages = $model->errorMessages;
$defaultValues = $model->defaultValues;
$brandName = $model->brandName;
$csrfToken = $model->csrfToken;
$dateYear = $model->dateYear;
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/Auth", [
    "brandName" => $brandName,
    "title" => "Giriş Yap",
    "description" => "",
    "csrfToken" => $csrfToken,
    "dateYear" => $dateYear,
]) ?>

<!-- CONTENT -->
<?= $this->insert("Forms/Auth/Login", [
    "loginUri" => $loginUri,
    "registerUri" => $registerUri,
    "errorMessages" => $errorMessages,
    "defaultValues" => $defaultValues,
]) ?>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>