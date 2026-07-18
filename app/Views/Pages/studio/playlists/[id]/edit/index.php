<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Studio\Playlist\EditPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$deleteUrl = $model->deleteUrl;
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
    "title" => "Oynatma Listesini Düzenle",
    "description" => "",
    "csrfToken" => $csrfToken,
    "activeNav" => "",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<?= $this->insert("Forms/Playlist/Edit", [
    "viewTypes" => $viewTypes,
    "errorMessages" => $errorMessages,
    "defaultValues" => $defaultValues,
]) ?>

<?= $this->insert("Forms/Delete", [
    "url" => $deleteUrl,
    "title" => "Oynatma Listesini Kalıcı Olarak Sil",
    "description" => "Bu işlem sonrasında oynatma listesi geri getirilemez. Oynatma listesinin silinmesini onaylıyor musunuz?",
    "disabled" => false,
]) ?>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>