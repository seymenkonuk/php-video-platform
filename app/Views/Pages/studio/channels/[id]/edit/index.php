<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Studio\Channel\EditPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$channelCode = $model->channelCode;
$deleteUrl = $model->deleteUrl;
$changeActiveChannelUrl = $model->changeActiveChannelUrl;
$isActive = $model->isActive;
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
    "title" => "Kanalı Düzenle",
    "description" => "",
    "csrfToken" => $csrfToken,
    "activeNav" => "",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<?= $this->insert("Forms/Channel/ChangeActive", [
    "url" => $changeActiveChannelUrl,
    "title" => "Hesap Değiştir",
    "description" => "Bu işlem sonrasında seçtiğiniz kanala geçiş yapacaksınız.",
    "channelCode" => $channelCode,
    "disabled" => $isActive,
]) ?>

<?= $this->insert("Forms/Channel/Edit", [
    "errorMessages" => $errorMessages,
    "defaultValues" => $defaultValues,
]) ?>

<?= $this->insert("Forms/Delete", [
    "url" => $deleteUrl,
    "title" => "Kanalı Kalıcı Olarak Sil",
    "description" => "Bu işlem sonrasında kanal geri getirilemez. Kanalın silinmesini onaylıyor musunuz?",
    "disabled" => $isActive,
]) ?>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>