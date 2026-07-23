<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Studio\Short\EditPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$deleteUrl = $model->deleteUrl;
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
    title: "Kısa Videoyu Düzenle",
    description: "",
    csrfToken: $csrfToken,
    search: "",
    activeNav: "",
    navMenus: $navMenus,
    dateYear: $dateYear,
    auth: $auth,
)) ?>

<!-- CONTENT -->
<?= $this->insert("Forms/Short/Edit", (array) new \App\Support\ViewProps\Forms\Short\EditViewProp(
    errorMessages: $errorMessages,
    defaultValues: $defaultValues,
    viewTypes: $viewTypes,
    commentTypes: $commentTypes,
    captions: [],
)) ?>

<?= $this->insert("Forms/Delete", (array) new \App\Support\ViewProps\Forms\DeleteViewProp(
    url: $deleteUrl,
    title: "Kısa Videoyu Kalıcı Olarak Sil",
    description: "Bu işlem sonrasında kısa video geri getirilemez. Kısa videonun silinmesini onaylıyor musunuz?",
    disabled: false,
)) ?>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>