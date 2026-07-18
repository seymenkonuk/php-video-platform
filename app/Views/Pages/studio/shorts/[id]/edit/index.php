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
<?= $this->layout("Layouts/Studio", [
    "brandName" => $brandName,
    "title" => "Kısa Videoyu Düzenle",
    "description" => "",
    "csrfToken" => $csrfToken,
    "activeNav" => "",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<?= $this->insert("Forms/Short/Edit", [
    "commentTypes" => $commentTypes,
    "viewTypes" => $viewTypes,
    "errorMessages" => $errorMessages,
    "defaultValues" => $defaultValues,
]) ?>

<?= $this->insert("Forms/Delete", [
    "url" => $deleteUrl,
    "title" => "Kısa Videoyu Kalıcı Olarak Sil",
    "description" => "Bu işlem sonrasında kısa video geri getirilemez. Kısa videonun silinmesini onaylıyor musunuz?",
    "disabled" => false,
]) ?>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>