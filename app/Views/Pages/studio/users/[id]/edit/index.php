<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Studio\User\EditPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$deleteUrl = $model->deleteUrl;
$errorMessages = $model->errorMessages;
$defaultValues = $model->defaultValues;
$countries = $model->countries;
$brandName = $model->brandName;
$csrfToken = $model->csrfToken;
$dateYear = $model->dateYear;
$navMenus = $model->navMenus;
$auth = $model->auth;
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/Studio", [
    "brandName" => $brandName,
    "title" => "Kullanıcıyı Düzenle",
    "description" => "",
    "csrfToken" => $csrfToken,
    "activeNav" => "",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<?= $this->insert("Forms/User/Edit", [
    "countries" => $countries,
    "errorMessages" => $errorMessages,
    "defaultValues" => $defaultValues,
]) ?>

<?= $this->insert("Forms/Delete", [
    "url" => $deleteUrl,
    "title" => "Kullanıcıyı Kalıcı Olarak Sil",
    "description" => "Bu işlem sonrasında kullanıcı geri getirilemez. Kullanıcının silinmesini onaylıyor musunuz?",
    "disabled" => false,
]) ?>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>