<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Auth\RegisterPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$countries = $model->countries;
$loginUri = $model->loginUri;
$registerUri = $model->registerUri;
$errorMessages = $model->errorMessages;
$defaultValues = $model->defaultValues;
$brandName = $model->brandName;
$csrfToken = $model->csrfToken;
$dateYear = $model->dateYear;
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/Auth", (array) new \App\Support\ViewProps\Layouts\AuthViewProp(
    brandName: $brandName,
    title: "Kayıt Ol",
    description: "",
    csrfToken: $csrfToken,
    dateYear: $dateYear,
)) ?>

<!-- CONTENT -->
<?= $this->insert("Forms/Auth/Register", (array) new \App\Support\ViewProps\Forms\Auth\RegisterViewProp(
    loginUri: $loginUri,
    registerUri: $registerUri,
    errorMessages: $errorMessages,
    defaultValues: $defaultValues,
    countries: $countries,
)) ?>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>